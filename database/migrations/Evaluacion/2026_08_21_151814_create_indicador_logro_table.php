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

        Schema::create('indicador_logro', function (Blueprint $table) {
            $table->increments('id_indicador');
            $table->unsignedInteger('id_asignatura')->index();
            $table->foreign('id_asignatura')->references('id_asignatura')->on('asignatura');
            $table->unsignedInteger('id_periodo')->index();
            $table->foreign('id_periodo')->references('id_periodo')->on('periodo');
            $table->unsignedInteger('id_escala')->index();
            $table->foreign('id_escala')->references('id_escala')->on('escala_valoracion');
            $table->string('codigo_logro', 20)->nullable();
            $table->text('descripcion_logro');
            $table->string('tipo_logro', 40)->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicador_logro');
    }
};
