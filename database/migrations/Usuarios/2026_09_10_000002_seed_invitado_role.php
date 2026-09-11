<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('rol')) {
            DB::table('rol')->insertOrIgnore([
                'nombre_rol' => 'Invitado',
            ]);
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('rol')) {
            DB::table('rol')->where('nombre_rol', 'Invitado')->delete();
        }
    }
};
