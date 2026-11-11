<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('rol')->delete();

        \DB::table('rol')->insert([
            0 => [
                'id_rol' => 1,
                'nombre_rol' => 'Invitado',
            ],
            1 => [
                'id_rol' => 2,
                'nombre_rol' => 'Administrador',
            ],
            2 => [
                'id_rol' => 3,
                'nombre_rol' => 'Administrativo',
            ],
            3 => [
                'id_rol' => 4,
                'nombre_rol' => 'Profesor',
            ],
            4 => [
                'id_rol' => 5,
                'nombre_rol' => 'Estudiante',
            ],
        ]);

    }
}
