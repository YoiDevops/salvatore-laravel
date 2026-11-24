<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SedeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sede')->delete();
        
        \DB::table('sede')->insert(array (
            0 => 
            array (
                'id_sede' => 1,
                'nit' => '800123456-1',
                'nombre_sede' => 'Sede Principal Primaria',
                'direccion_sede' => 'Calle 10 # 5-20, Bogotá',
                'telefono_sede' => '6015550101',
            ),
            1 => 
            array (
                'id_sede' => 2,
                'nit' => '800123456-1',
                'nombre_sede' => 'Sede Preescolar y Primero',
                'direccion_sede' => 'Calle 12 # 4-10, Bogotá',
                'telefono_sede' => '6015550102',
            ),
            2 => 
            array (
                'id_sede' => 3,
                'nit' => '800123456-1',
                'nombre_sede' => 'Sede Campestre Primaria',
                'direccion_sede' => 'Carrera 15 # 45-12, Soacha',
                'telefono_sede' => '6015550103',
            ),
            3 => 
            array (
                'id_sede' => 4,
                'nit' => '800123456-1',
                'nombre_sede' => 'Sede Norte San José',
                'direccion_sede' => 'Calle 170 # 20-15, Bogotá',
                'telefono_sede' => '6015550104',
            ),
            4 => 
            array (
                'id_sede' => 5,
                'nit' => '800123456-1',
                'nombre_sede' => 'Sede Sur San Mateo',
                'direccion_sede' => 'Carrera 4 # 28-05, Soacha',
                'telefono_sede' => '6015550105',
            ),
            5 => 
            array (
                'id_sede' => 6,
                'nit' => '800123456-1',
                'nombre_sede' => 'Sede Ciudad Verde',
                'direccion_sede' => 'Avenida Tierra Negra # 10-20, Soacha',
                'telefono_sede' => '6015550106',
            ),
            6 => 
            array (
                'id_sede' => 7,
                'nit' => '800123456-1',
                'nombre_sede' => 'Sede Suba Centro',
                'direccion_sede' => 'Calle 145 # 91-05, Bogotá',
                'telefono_sede' => '6015550107',
            ),
            7 => 
            array (
                'id_sede' => 8,
                'nit' => '800123456-1',
                'nombre_sede' => 'Sede Engativá Real',
                'direccion_sede' => 'Carrera 110 # 68-12, Bogotá',
                'telefono_sede' => '6015550108',
            ),
            8 => 
            array (
                'id_sede' => 9,
                'nit' => '800123456-1',
                'nombre_sede' => 'Sede Bosa Central',
                'direccion_sede' => 'Calle 65 Sur # 80-14, Bogotá',
                'telefono_sede' => '6015550109',
            ),
            9 => 
            array (
                'id_sede' => 10,
                'nit' => '800123456-1',
                'nombre_sede' => 'Sede Fontibón La Guchita',
                'direccion_sede' => 'Carrera 100 # 22-08, Bogotá',
                'telefono_sede' => '6015550110',
            ),
            10 => 
            array (
                'id_sede' => 11,
                'nit' => '800123456-1',
                'nombre_sede' => 'Sede Kennedy Central',
                'direccion_sede' => 'Calle 38 Sur # 78-20, Bogotá',
                'telefono_sede' => '6015550111',
            ),
            11 => 
            array (
                'id_sede' => 12,
                'nit' => '800123456-1',
                'nombre_sede' => 'Sede Usaquén Country',
                'direccion_sede' => 'Carrera 7 # 120-15, Bogotá',
                'telefono_sede' => '6015550112',
            ),
            12 => 
            array (
                'id_sede' => 13,
                'nit' => '800123456-1',
                'nombre_sede' => 'Sede Chapinero Infantil',
                'direccion_sede' => 'Calle 60 # 13-40, Bogotá',
                'telefono_sede' => '6015550113',
            ),
            13 => 
            array (
                'id_sede' => 14,
                'nit' => '800123456-1',
                'nombre_sede' => 'Sede Teusaquillo',
                'direccion_sede' => 'Avenida 28 # 35-10, Bogotá',
                'telefono_sede' => '6015550114',
            ),
            14 => 
            array (
                'id_sede' => 15,
                'nit' => '800123456-1',
                'nombre_sede' => 'Sede Puente Aranda',
                'direccion_sede' => 'Calle 13 # 62-05, Bogotá',
                'telefono_sede' => '6015550115',
            ),
            15 => 
            array (
                'id_sede' => 16,
                'nit' => '800123456-1',
                'nombre_sede' => 'Sede Usme Pueblo',
                'direccion_sede' => 'Carrera 3 # 138 Sur, Bogotá',
                'telefono_sede' => '6015550116',
            ),
            16 => 
            array (
                'id_sede' => 17,
                'nit' => '800123456-1',
                'nombre_sede' => 'Sede San Cristóbal Sur',
                'direccion_sede' => 'Calle 18 Sur # 5-10, Bogotá',
                'telefono_sede' => '6015550117',
            ),
            17 => 
            array (
                'id_sede' => 18,
                'nit' => '800123456-1',
                'nombre_sede' => 'Sede Tunjuelito',
                'direccion_sede' => 'Diagonal 44 Sur # 24-05, Bogotá',
                'telefono_sede' => '6015550118',
            ),
            18 => 
            array (
                'id_sede' => 19,
                'nit' => '800123456-1',
                'nombre_sede' => 'Sede Rafael Uribe',
                'direccion_sede' => 'Carrera 12 # 27 Sur, Bogotá',
                'telefono_sede' => '6015550119',
            ),
            19 => 
            array (
                'id_sede' => 20,
                'nit' => '800123456-1',
                'nombre_sede' => 'Sede Los Mártires',
                'direccion_sede' => 'Calle 19 # 22-05, Bogotá',
                'telefono_sede' => '6015550120',
            ),
        ));
        
        
    }
}