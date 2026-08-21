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

        Schema::create('curso', function (Blueprint $table) {
            $table->increments('id_curso');
            $table->unsignedInteger('id_sede')->index();
            $table->foreign('id_sede')->references('id_sede')->on('sede');
            $table->unsignedInteger('id_grado')->index();
            $table->foreign('id_grado')->references('id_grado')->on('grado');
            $table->string('nombre_curso', 15);
            $table->string('cupo_maximo', 10);
            $table->string('jornada', 10)->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curso');
    }
};
