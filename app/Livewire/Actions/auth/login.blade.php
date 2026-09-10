<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.auth-banner')] class extends Component {
    public string $usuario = '';
    public string $password = '';

    public function login(): void
    {
        $this->validate([
            'usuario' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $usernameColumn = Schema::hasColumn('users', 'usuario') ? 'usuario' : 'name';
        $emailColumn = Schema::hasColumn('users', 'correo') ? 'correo' : 'email';
        $user = User::where($usernameColumn, $this->usuario)
            ->orWhere($emailColumn, $this->usuario)
            ->first();

        if (! $user) {
            $this->addError('usuario', 'Las credenciales no coinciden con nuestros registros.');
            return;
        }

        $status = $user->status ?? $user->estado;
        if ($status !== null && $status !== 'Activo') {
            $this->addError('usuario', 'El usuario se encuentra inactivo.');
            return;
        }

        $loginColumn = filter_var($this->usuario, FILTER_VALIDATE_EMAIL)
            ? $emailColumn
            : $usernameColumn;

        $password = $user->getRawOriginal('password');
        $validPassword = false;

        try {
            $validPassword = Hash::check($this->password, $password);
        } catch (RuntimeException) {
            // Permite migrar credenciales antiguas al formato Bcrypt al iniciar sesión.
            $validPassword = password_verify($this->password, $password)
                || hash_equals((string) $password, $this->password);

            if ($validPassword) {
                $user->forceFill(['password' => Hash::make($this->password)])->save();
            }
        }

        if (! $validPassword) {
            $this->addError('usuario', 'Las credenciales no coinciden con nuestros registros.');
            return;
        }

        Auth::login($user);

        request()->session()->regenerate();

        $role = strtolower(trim((string) ($user->role ?? $user->nom_rol)));
        $this->redirect(match ($role) {
            'administrador', 'admin', '1' => '/administrador/dashboard',
            'profesor', '2' => '/profesor/dashboard',
            'estudiante', '3' => '/estudiante/dashboard',
            default => '/',
        }, navigate: true);
    }
}; ?>

<div class="banner-login">
    <form wire:submit="login" class="form-login">
        <h2>INICIAR SESIÓN</h2>

        <div class="entrada">
            <label>Usuario o correo</label>
            <input type="text" wire:model="usuario" required autofocus>
            @error('usuario') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="entrada">
            <label>Contraseña</label>
            <input type="password" wire:model="password" required>
        </div>

        <div class="boton">
            <button type="submit">Ingresar</button>
        </div>
    </form>
</div>