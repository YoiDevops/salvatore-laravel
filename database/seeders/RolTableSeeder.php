<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolTableSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['id_rol' => 1, 'nombre_rol' => 'Invitado'],
            ['id_rol' => 2, 'nombre_rol' => 'Administrador'],
            ['id_rol' => 3, 'nombre_rol' => 'Administrativo'],
            ['id_rol' => 4, 'nombre_rol' => 'Profesor'],
            ['id_rol' => 5, 'nombre_rol' => 'Estudiante'],
        ];

        DB::table('rol')->upsert(
            $roles,
            ['id_rol'], // Columna unica de busqueda
            ['nombre_rol'] // Columnas a actualizar si existe
        );
    }
}