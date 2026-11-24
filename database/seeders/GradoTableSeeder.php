<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GradoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('grado')->delete();
        
        \DB::table('grado')->insert(array (
            0 => 
            array (
                'id_grado' => 1,
                'nombre_grado' => 'Primero A',
            ),
            1 => 
            array (
                'id_grado' => 2,
                'nombre_grado' => 'Primero B',
            ),
            2 => 
            array (
                'id_grado' => 3,
                'nombre_grado' => 'Primero C',
            ),
            3 => 
            array (
                'id_grado' => 4,
                'nombre_grado' => 'Segundo A',
            ),
            4 => 
            array (
                'id_grado' => 5,
                'nombre_grado' => 'Segundo B',
            ),
            5 => 
            array (
                'id_grado' => 6,
                'nombre_grado' => 'Segundo C',
            ),
            6 => 
            array (
                'id_grado' => 7,
                'nombre_grado' => 'Tercero A',
            ),
            7 => 
            array (
                'id_grado' => 8,
                'nombre_grado' => 'Tercero B',
            ),
            8 => 
            array (
                'id_grado' => 9,
                'nombre_grado' => 'Tercero C',
            ),
            9 => 
            array (
                'id_grado' => 10,
                'nombre_grado' => 'Cuarto A',
            ),
            10 => 
            array (
                'id_grado' => 11,
                'nombre_grado' => 'Cuarto B',
            ),
            11 => 
            array (
                'id_grado' => 12,
                'nombre_grado' => 'Cuarto C',
            ),
            12 => 
            array (
                'id_grado' => 13,
                'nombre_grado' => 'Quinto A',
            ),
            13 => 
            array (
                'id_grado' => 14,
                'nombre_grado' => 'Quinto B',
            ),
            14 => 
            array (
                'id_grado' => 15,
                'nombre_grado' => 'Quinto C',
            ),
            15 => 
            array (
                'id_grado' => 16,
                'nombre_grado' => 'Transición A',
            ),
            16 => 
            array (
                'id_grado' => 17,
                'nombre_grado' => 'Transición B',
            ),
            17 => 
            array (
                'id_grado' => 18,
                'nombre_grado' => 'Jardín A',
            ),
            18 => 
            array (
                'id_grado' => 19,
                'nombre_grado' => 'Jardín B',
            ),
            19 => 
            array (
                'id_grado' => 20,
                'nombre_grado' => 'Aceleración Primary',
            ),
        ));
        
        
    }
}