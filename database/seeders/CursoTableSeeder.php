<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CursoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('curso')->delete();
        
        \DB::table('curso')->insert(array (
            0 => 
            array (
                'id_curso' => 1,
                'id_sede' => 1,
                'id_grado' => 1,
                'nombre_curso' => '101',
                'cupo_maximo' => '30',
                'jornada' => 'Mañana',
                'ano_lectivo' => '2026',
            ),
            1 => 
            array (
                'id_curso' => 2,
                'id_sede' => 1,
                'id_grado' => 4,
                'nombre_curso' => '201',
                'cupo_maximo' => '30',
                'jornada' => 'Mañana',
                'ano_lectivo' => '2026',
            ),
            2 => 
            array (
                'id_curso' => 3,
                'id_sede' => 2,
                'id_grado' => 7,
                'nombre_curso' => '301',
                'cupo_maximo' => '25',
                'jornada' => 'Mañana',
                'ano_lectivo' => '2026',
            ),
            3 => 
            array (
                'id_curso' => 4,
                'id_sede' => 2,
                'id_grado' => 10,
                'nombre_curso' => '401',
                'cupo_maximo' => '30',
                'jornada' => 'Tarde',
                'ano_lectivo' => '2026',
            ),
            4 => 
            array (
                'id_curso' => 5,
                'id_sede' => 3,
                'id_grado' => 13,
                'nombre_curso' => '501',
                'cupo_maximo' => '30',
                'jornada' => 'Mañana',
                'ano_lectivo' => '2026',
            ),
            5 => 
            array (
                'id_curso' => 6,
                'id_sede' => 3,
                'id_grado' => 2,
                'nombre_curso' => '102',
                'cupo_maximo' => '28',
                'jornada' => 'Tarde',
                'ano_lectivo' => '2026',
            ),
            6 => 
            array (
                'id_curso' => 7,
                'id_sede' => 4,
                'id_grado' => 5,
                'nombre_curso' => '202',
                'cupo_maximo' => '30',
                'jornada' => 'Mañana',
                'ano_lectivo' => '2026',
            ),
            7 => 
            array (
                'id_curso' => 8,
                'id_sede' => 4,
                'id_grado' => 8,
                'nombre_curso' => '302',
                'cupo_maximo' => '25',
                'jornada' => 'Mañana',
                'ano_lectivo' => '2026',
            ),
            8 => 
            array (
                'id_curso' => 9,
                'id_sede' => 5,
                'id_grado' => 11,
                'nombre_curso' => '402',
                'cupo_maximo' => '30',
                'jornada' => 'Tarde',
                'ano_lectivo' => '2026',
            ),
            9 => 
            array (
                'id_curso' => 10,
                'id_sede' => 5,
                'id_grado' => 14,
                'nombre_curso' => '502',
                'cupo_maximo' => '30',
                'jornada' => 'Mañana',
                'ano_lectivo' => '2026',
            ),
            10 => 
            array (
                'id_curso' => 11,
                'id_sede' => 6,
                'id_grado' => 3,
                'nombre_curso' => '103',
                'cupo_maximo' => '25',
                'jornada' => 'Mañana',
                'ano_lectivo' => '2026',
            ),
            11 => 
            array (
                'id_curso' => 12,
                'id_sede' => 6,
                'id_grado' => 6,
                'nombre_curso' => '203',
                'cupo_maximo' => '28',
                'jornada' => 'Tarde',
                'ano_lectivo' => '2026',
            ),
            12 => 
            array (
                'id_curso' => 13,
                'id_sede' => 7,
                'id_grado' => 9,
                'nombre_curso' => '303',
                'cupo_maximo' => '30',
                'jornada' => 'Mañana',
                'ano_lectivo' => '2026',
            ),
            13 => 
            array (
                'id_curso' => 14,
                'id_sede' => 7,
                'id_grado' => 12,
                'nombre_curso' => '403',
                'cupo_maximo' => '30',
                'jornada' => 'Mañana',
                'ano_lectivo' => '2026',
            ),
            14 => 
            array (
                'id_curso' => 15,
                'id_sede' => 8,
                'id_grado' => 15,
                'nombre_curso' => '503',
                'cupo_maximo' => '28',
                'jornada' => 'Tarde',
                'ano_lectivo' => '2026',
            ),
            15 => 
            array (
                'id_curso' => 16,
                'id_sede' => 8,
                'id_grado' => 16,
                'nombre_curso' => 'TR01',
                'cupo_maximo' => '20',
                'jornada' => 'Mañana',
                'ano_lectivo' => '2026',
            ),
            16 => 
            array (
                'id_curso' => 17,
                'id_sede' => 9,
                'id_grado' => 17,
                'nombre_curso' => 'TR02',
                'cupo_maximo' => '20',
                'jornada' => 'Tarde',
                'ano_lectivo' => '2026',
            ),
            17 => 
            array (
                'id_curso' => 18,
                'id_sede' => 9,
                'id_grado' => 18,
                'nombre_curso' => 'JR01',
                'cupo_maximo' => '18',
                'jornada' => 'Mañana',
                'ano_lectivo' => '2026',
            ),
            18 => 
            array (
                'id_curso' => 19,
                'id_sede' => 10,
                'id_grado' => 19,
                'nombre_curso' => 'JR02',
                'cupo_maximo' => '18',
                'jornada' => 'Tarde',
                'ano_lectivo' => '2026',
            ),
            19 => 
            array (
                'id_curso' => 20,
                'id_sede' => 10,
                'id_grado' => 20,
                'nombre_curso' => 'ACL01',
                'cupo_maximo' => '15',
                'jornada' => 'Mañana',
                'ano_lectivo' => '2026',
            ),
        ));
        
        
    }
}