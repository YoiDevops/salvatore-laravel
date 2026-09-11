<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('rol') && in_array(DB::connection()->getDriverName(), ['mysql', 'mariadb'], true)) {
            DB::statement('ALTER TABLE rol MODIFY nombre_rol VARCHAR(80) NOT NULL');
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('rol') && in_array(DB::connection()->getDriverName(), ['mysql', 'mariadb'], true)) {
            DB::table('rol')->where('nombre_rol', 'Administrativo')->update(['nombre_rol' => 'Administrador']);
            DB::statement("ALTER TABLE rol MODIFY nombre_rol ENUM('Administrador', 'Profesor', 'Estudiante') NOT NULL");
        }
    }
};
