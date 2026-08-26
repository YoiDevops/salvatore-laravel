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

        Schema::create('grado', function (Blueprint $table) {
            $table->increments('id_grado');
            $table->string('nombre_grado', 25);
            $table->unsignedTinyInteger('edad_minima')->nullable();
            $table->unsignedTinyInteger('edad_maxima')->nullable();
            $table->string('ano_lectivo', 20)->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grado');
    }
};
