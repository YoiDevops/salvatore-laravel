<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carga_academica', function (Blueprint $table): void {
            $table->increments('id_carga');
            $table->unsignedInteger('id_curso');
            $table->unsignedInteger('id_asignatura');
            $table->unsignedInteger('id_profesor');
            $table->unsignedTinyInteger('intensidad_horaria')->nullable();
            $table->foreign('id_curso')->references('id_curso')->on('curso')->cascadeOnDelete();
            $table->foreign('id_asignatura')->references('id_asignatura')->on('asignatura')->cascadeOnDelete();
            $table->foreign('id_profesor')->references('id_profesor')->on('profesor')->cascadeOnDelete();
            $table->unique(
                ['id_curso', 'id_asignatura', 'id_profesor'],
                'carga_academica_curso_asignatura_profesor_unique',
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carga_academica');
    }
};
