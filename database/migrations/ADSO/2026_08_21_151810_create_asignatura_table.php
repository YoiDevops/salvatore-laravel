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

        Schema::create('asignatura', function (Blueprint $table) {
            $table->increments('id_asignatura');
            $table->unsignedInteger('id_area')->index();
            $table->foreign('id_area')->references('id_area')->on('area');
            $table->string('nombre_asignatura', 80);
            $table->unsignedTinyInteger('intensidad_horaria');
            $table->decimal('porcentaje_area', 5, 2)->nullable();
            $table->text('descripcion')->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignatura');
    }
};
