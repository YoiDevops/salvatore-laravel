<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('institucion', function (Blueprint $table) {
            $table->string('nit', 20)->primary();
            $table->string('nombre_institucion', 120);
            $table->string('direccion_principal', 150);
            $table->string('telefono_contacto', 20)->nullable();
            $table->string('correo_electronico', 100)->nullable();
            $table->string('registro_dane', 30)->unique()->nullable();
            $table->string('resolucion_aprobacion', 50)->nullable();
            $table->string('url_logo', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institucion');
    }
};
