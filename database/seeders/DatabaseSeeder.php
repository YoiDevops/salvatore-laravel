<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolTableSeeder::class,
            UsuariosColegioTableSeeder::class,
            InstitucionTableSeeder::class,
            SedeTableSeeder::class,
            GradoTableSeeder::class,
            AcudienteTableSeeder::class,
            CaracterizacionDiscapacidadTableSeeder::class,
            AreaTableSeeder::class,
            AsignaturaTableSeeder::class,
            CursoTableSeeder::class,
            PeriodoTableSeeder::class,
            EscalaValoracionTableSeeder::class,
            IndicadorLogroTableSeeder::class,
            EstudianteTableSeeder::class,
            ProfesorTableSeeder::class,
            SolicitudesTableSeeder::class,
        ]);
    }
}
