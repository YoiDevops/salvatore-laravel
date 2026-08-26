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
        Schema::disableForeignKeyConstraints();

        Schema::create('profesor', function (Blueprint $table) {
            $table->increments('id_profesor');
            $table->unsignedInteger('id_usuario')->unique();
            $table->enum('tipo_documento', ["CC","CE","PASAPORTE","PPT"]);
            $table->string('documento_profesor', 20)->unique();
            $table->string('nombres_profesor', 50);
            $table->string('apellidos_profesor', 50);
            $table->string('telefono_profesor', 20)->nullable();
            $table->string('correo_profesor', 100)->nullable();
            $table->string('direccion_residencia', 150)->nullable();
            $table->date('fecha_ingreso_colegio')->nullable();
            $table->string('tipo_contra', 50)->nullable();
            $table->enum('estado_profesor', ["Activo","Inactivo","Licencia"])->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesor');
    }
};
