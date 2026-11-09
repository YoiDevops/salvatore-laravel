<?php

namespace App\Http\Controllers\Administrativo;

use App\Http\Controllers\Controller;
use App\Models\User;

class PanelController extends Controller
{
    public function dashboard()
    {
        return view('administrativo.dashboard', [
            'totalUsuarios' => $this->managedAccountsQuery()->count(),
            'totalProfesores' => $this->countByRole('Profesor'),
            'totalEstudiantes' => $this->countByRole('Estudiante'),
            'usuariosRecientes' => $this->managedAccountsQuery()->latest('id_users')->limit(6)->get(),
        ]);
    }

    private function countByRole(string $role): int
    {
        $normalizedRole = strtolower(trim($role));

        return $this->managedAccountsQuery()->where(function ($query) use ($normalizedRole) {
            $query->whereRaw('LOWER(TRIM(COALESCE(role, \'\'))) = ?', [$normalizedRole])
                ->orWhereRaw('LOWER(TRIM(COALESCE(nom_rol, \'\'))) = ?', [$normalizedRole]);
        })->count();
    }

    private function managedAccountsQuery()
    {
        return User::query()->where(function ($query) {
            $query->whereRaw("LOWER(TRIM(COALESCE(role, ''))) IN (?, ?)", ['profesor', 'estudiante'])
                ->orWhereRaw("LOWER(TRIM(COALESCE(nom_rol, ''))) IN (?, ?)", ['profesor', 'estudiante']);
        });
    }
}
