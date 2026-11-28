<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PortalAuthenticator
{
    private const TEST_USERNAMES = ['andres', 'yoiner', 'yojhan'];

    public function authenticate(string $identifier, string $password): ?User
    {
        $identifier = trim($identifier);
        if ($identifier === '' || $password === '') {
            return null;
        }

        $user = $this->findPrivilegedAccount($identifier);
        if ($user === null) {
            $user = $this->findByDocument($identifier);
        }

        if (! $user || ! $this->isActive($user) || ! $this->passwordIsValid($user, $password)) {
            return null;
        }

        return $user;
    }

    private function findPrivilegedAccount(string $identifier): ?User
    {
        $column = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $user = User::query()
            ->whereRaw('LOWER(TRIM('.$column.')) = ?', [mb_strtolower($identifier)])
            ->first();

        if (! $user || (! $this->isAdministrative($user) && ! $this->isTestAccount($user))) {
            return null;
        }

        return $user;
    }

    private function findByDocument(string $documento): ?User
    {
        $usuarios = User::query()
            ->where(function ($query) use ($documento): void {
                $query->whereHas('estudiante', fn ($query) => $query->where('documento_identidad', $documento))
                    ->orWhereHas('profesor', fn ($query) => $query->where('documento_profesor', $documento))
                    ->orWhereHas('solicitudes', fn ($query) => $query
                        ->where('estado', 'aprobado')
                        ->where('estudiante_numero_documento', $documento));
            })
            ->limit(2)
            ->get();

        if ($usuarios->count() !== 1) {
            return null;
        }

        $user = $usuarios->first();

        return $this->isAdministrative($user) ? null : $user;
    }

    private function isAdministrative(User $user): bool
    {
        return in_array(strtolower(trim($user->effective_role)), ['administrador', 'administrativo'], true);
    }

    private function isTestAccount(User $user): bool
    {
        return in_array(mb_strtolower(trim($user->name)), self::TEST_USERNAMES, true);
    }

    private function isActive(User $user): bool
    {
        $status = trim((string) $user->getRawOriginal('status'));
        if ($status === '') {
            $status = trim((string) $user->getRawOriginal('estado'));
        }

        return $status === '' || strtolower($status) === 'activo';
    }

    private function passwordIsValid(User $user, string $password): bool
    {
        $storedPassword = (string) $user->getRawOriginal('password');

        try {
            return Hash::check($password, $storedPassword);
        } catch (\RuntimeException) {
            $valid = password_verify($password, $storedPassword)
                || hash_equals($storedPassword, $password);

            if ($valid) {
                $user->forceFill(['password' => Hash::make($password)])->save();
            }

            return $valid;
        }
    }
}
