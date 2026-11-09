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
            foreach (['tipo_documento', 'numero_documento', 'nombres', 'apellidos', 'genero', 'tipo_sangre', 'lugar_nacimiento', 'eps', 'estado', 'tiene_discapacidad', 'tipo_discapacidad', 'diagnostico_discapacidad', 'grado_discapacidad', 'permanencia_discapacidad', 'grado_atencion'] as $field) {
                $table->string('estudiante_'.$field, 150)->nullable();
            }
            $table->date('estudiante_fecha_nacimiento')->nullable();
            foreach (['tipo_documento', 'numero_documento', 'nombres', 'apellidos', 'genero', 'parentesco', 'direccion', 'telefono', 'correo', 'lugar_trabajo', 'ocupacion'] as $field) {
                $table->string('acudiente_'.$field, 150)->nullable();
            }
            $table->date('acudiente_fecha_nacimiento')->nullable();
            $table->string('estado_solicitud', 30)->default('Pendiente');
            $table->timestamps();
            $table->index('estudiante_numero_documento');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};
