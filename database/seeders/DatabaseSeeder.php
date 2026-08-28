<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Crear Administrador principal de prueba
        User::factory()->admin()->create([
            'name' => 'Administrador Sistema',
            'email' => 'admin@salvatore.test',
            'password' => bcrypt('password'),
        ]);

        // 2. Crear un Profesor de prueba
        User::factory()->profesor()->create([
            'name' => 'Profesor Demo',
            'email' => 'profesor@salvatore.test',
            'password' => bcrypt('password'),
        ]);

        // 3. Crear un Estudiante de prueba
        User::factory()->estudiante()->create([
            'name' => 'Estudiante Demo',
            'email' => 'estudiante@salvatore.test',
            'password' => bcrypt('password'),
        ]);

        // 4. Generar varios estudiantes y profesores adicionales para poblar listas
        User::factory()->count(10)->estudiante()->create();
        User::factory()->count(5)->profesor()->create();
    }
}