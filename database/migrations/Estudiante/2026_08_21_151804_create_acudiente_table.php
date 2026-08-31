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

        Schema::create('acudiente', function (Blueprint $table) {
            $table->increments('id_acudiente');
            $table->enum('tipo_documento', ["CC","TI","CE","PASAPORTE","PEP","PPT"]);
            $table->string('documento_identidad', 20)->unique();
            $table->string('nombres_acudiente', 50);
            $table->string('apellidos_acudiente', 50);
            $table->date('fecha_nacimiento')->nullable();
            $table->enum('genero', ["Masculino","Femenino","Otro"]);
            $table->string('parentesco_estudiante', 30);
            $table->string('direccion_residencia', 150)->nullable();
            $table->string('telefono_acudiente', 20)->nullable();
            $table->string('correo_acudiente', 100)->nullable();
            $table->string('lugar_trabajo', 100)->nullable();
            $table->string('ocupacion', 60)->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acudiente');
    }
};
