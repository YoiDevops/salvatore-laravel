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
    }
}