<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Usuarios\Rol;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call(RolTableSeeder::class);
       $this->call(UsersTableSeeder::class);
       $this->call(AcudienteTableSeeder::class);
       $this->call(AreaTableSeeder::class);
       $this->call(AsignaturaTableSeeder::class);
       $this->call(CaracterizacionDiscapacidadTableSeeder::class);
       $this->call(InstitucionTableSeeder::class);
       $this->call(SedeTableSeeder::class);
       $this->call(GradoTableSeeder::class);
       $this->call(CursoTableSeeder::class);
       $this->call(::class);
       $this->call(::class);
       $this->call(::class);
       $this->call(::class);
       $this->call(::class);
       $this->call(::class);
       
        $this->call(CursoTableSeeder::class);
    }
}