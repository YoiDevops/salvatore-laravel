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

        Schema::create('asignacion_academica', function (Blueprint $table) {
            $table->increments('id_asignacion');
            $table->unsignedInteger('id_profesor')->index();
            $table->foreign('id_profesor')->references('id_profesor')->on('profesor');
            $table->unsignedInteger('id_curso')->index();
            $table->foreign('id_curso')->references('id_curso')->on('curso');
            $table->unsignedInteger('id_asignatura')->index();
            $table->foreign('id_asignatura')->references('id_asignatura')->on('asignatura');
            $table->date('fecha_vinculacion');
            $table->enum('estado_asignacion', ["Activa","Finalizada","Suspendida"])->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignacion_academica');
    }
};
