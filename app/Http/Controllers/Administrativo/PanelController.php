<?php

namespace App\Http\Controllers\Administrativo;

use App\Http\Controllers\Controller;
use App\Models\User;

class PanelController extends Controller
{
    public function dashboard()
    {
        return view('administrativo.dashboard', [
            'totalUsuarios' => User::count(),
            'totalProfesores' => $this->countByRole('Profesor'),
            'totalAdministradores' => $this->countByRole('Administrador'),
            'totalEstudiantes' => $this->countByRole('Estudiante'),
            'usuariosRecientes' => User::query()->latest('id_users')->limit(6)->get(),
        ]);
    }

    private function countByRole(string $role): int
    {
        return User::query()
            ->where(function ($query) use ($role) {
                $query->whereRaw('TRIM(role) = ?', [$role])
                    ->orWhereRaw('TRIM(nom_rol) = ?', [$role]);
            })
            ->count();
    }
}
