<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calificacion', function (Blueprint $table) {
            $table->increments('id_calificacion');
            $table->unsignedInteger('id_estudiante');
            $table->unsignedInteger('id_indicador');
            $table->unsignedInteger('id_escala');
            $table->decimal('nota', 3, 2);
            $table->timestamps();

            $table->foreign('id_estudiante')
                ->references('id_estudiante')
                ->on('estudiante')
                ->cascadeOnDelete();
            $table->foreign('id_indicador')
                ->references('id_indicador')
                ->on('indicador_logro')
                ->cascadeOnDelete();
            $table->foreign('id_escala')
                ->references('id_escala')
                ->on('escala_valoracion');
            $table->unique(['id_estudiante', 'id_indicador']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calificacion');
    }
};
