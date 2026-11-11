<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Compatibilidad con instalaciones que ya ejecutaron la migración anterior.
        if (Schema::hasColumn('solicitudes', 'estado_solicitud') && ! Schema::hasColumn('solicitudes', 'estado')) {
            Schema::table('solicitudes', function (Blueprint $table): void {
                $table->renameColumn('estado_solicitud', 'estado');
            });
        }

        if (! Schema::hasColumn('solicitudes', 'estado')) {
            Schema::table('solicitudes', function (Blueprint $table): void {
                $table->string('estado', 20)->default('en espera');
            });
        }

        Schema::table('solicitudes', function (Blueprint $table): void {
            $table->string('estado', 20)->default('en espera')->change();
            $table->index('estado');
        });

        DB::table('solicitudes')->whereIn('estado', ['Pendiente', 'pendiente'])->update(['estado' => 'en espera']);
        DB::table('solicitudes')->whereIn('estado', ['Aprobado', 'aprobado'])->update(['estado' => 'aprobado']);
        DB::table('solicitudes')->whereIn('estado', ['Denegado', 'denegado'])->update(['estado' => 'denegado']);
        DB::table('solicitudes')->whereNull('estado')->update(['estado' => 'en espera']);
    }

    public function down(): void
    {
        Schema::table('solicitudes', function (Blueprint $table): void {
            $table->dropIndex(['estado']);
        });
    }
};
