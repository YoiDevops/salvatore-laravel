<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id('id_solicitud');
            $table->string('estudiante_tipo_documento', 30);
            $table->string('estudiante_numero_documento', 30)->index();
            $table->string('estudiante_nombres', 100);
            $table->string('estudiante_apellidos', 100);
            $table->date('estudiante_fecha_nacimiento');
            $table->string('estudiante_genero', 30);
            $table->string('estudiante_tipo_sangre', 10);
            $table->string('estudiante_lugar_nacimiento', 100);
            $table->string('estudiante_eps', 100);
            $table->string('estudiante_estado', 30)->default('Activo');
            $table->string('estudiante_tiene_discapacidad', 5);
            $table->string('estudiante_tipo_discapacidad', 100)->nullable();
            $table->string('estudiante_diagnostico_discapacidad', 150)->nullable();
            $table->string('estudiante_grado_discapacidad', 50)->nullable();
            $table->string('estudiante_permanencia_discapacidad', 50)->nullable();
            $table->string('estudiante_grado_atencion', 100)->nullable();
            $table->string('acudiente_tipo_documento', 30);
            $table->string('acudiente_numero_documento', 30)->index();
            $table->string('acudiente_nombres', 100);
            $table->string('acudiente_apellidos', 100);
            $table->date('acudiente_fecha_nacimiento');
            $table->string('acudiente_genero', 30);
            $table->string('acudiente_parentesco', 60);
            $table->string('acudiente_direccion', 150);
            $table->string('acudiente_telefono', 30);
            $table->string('acudiente_correo', 150);
            $table->string('acudiente_lugar_trabajo', 150)->nullable();
            $table->string('acudiente_ocupacion', 100)->nullable();
            $table->string('estado', 20)->default('en espera')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};
