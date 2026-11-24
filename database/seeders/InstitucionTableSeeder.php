<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InstitucionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('institucion')->delete();
        
        \DB::table('institucion')->insert(array (
            0 => 
            array (
                'nit' => '800123456-1',
                'nombre_institucion' => 'Centro Educativo Infantil Los Naranjos',
                'direccion_principal' => 'Calle 10 # 5-20, Bogotá',
                'telefono_contacto' => '6015550101',
                'correo_electronico' => 'contacto@losnaranjos.edu.co',
                'registro_dane' => '111001000123',
                'resolucion_aprobacion' => 'Res. 1234 de 2018',
                'url_logo' => 'https://losnaranjos.edu.co/logo.png',
            ),
        ));
        
        
    }
}