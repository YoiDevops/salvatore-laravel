<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id_users' => 1,
                'name' => 'andres',
                'email' => 'andres@gmail.com',
                'role' => 'Administrador',
                'status' => 'Activo',
                'email_verified_at' => NULL,
                'password' => '$2y$12$WojjcUtTHlNfcGGlz1jiVeoQr8GksCM4MhfSxmuTZEmcFuQzflIga',
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'nom_rol' => 'Administrador',
                'estado' => 'Activo',
                'remember_token' => NULL,
                'created_at' => '2026-09-11 08:32:42',
                'updated_at' => '2026-09-11 08:32:42',
            ),
            1 => 
            array (
                'id_users' => 2,
                'name' => 'YOJHAN',
                'email' => 'yojhan@gmail.com',
                'role' => 'Profesor',
                'status' => 'Activo',
                'email_verified_at' => NULL,
                'password' => '$2y$12$W387GuGwEmhs8XK.CRjf4OvVZCx8jCeCvynE4I3Lc/f8oniGqJzg6',
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'nom_rol' => 'Profesor',
                'estado' => 'Activo',
                'remember_token' => NULL,
                'created_at' => '2026-09-11 09:02:21',
                'updated_at' => '2026-09-11 09:02:21',
            ),
            2 => 
            array (
                'id_users' => 3,
                'name' => 'yoiner',
                'email' => 'yoiner@gmail.com',
                'role' => 'Administrativo',
                'status' => 'Activo',
                'email_verified_at' => NULL,
                'password' => '$2y$12$AYbr8yKFGzDKWydg7GR8buSSjdsUi52fWx/DH61Mt04Wwm08C/OtG',
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'nom_rol' => 'Administrativo',
                'estado' => 'Activo',
                'remember_token' => NULL,
                'created_at' => '2026-09-11 09:02:53',
                'updated_at' => '2026-09-11 09:02:53',
            ),
        ));
        
        
    }
}