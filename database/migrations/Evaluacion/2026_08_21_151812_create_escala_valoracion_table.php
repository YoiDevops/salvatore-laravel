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

        Schema::create('escala_valoracion', function (Blueprint $table) {
            $table->increments('id_escala');
            $table->enum('nombre_desempeno', ["Superior","Alto","Basico","Bajo"]);
            $table->decimal('nota_minima', 1, 0);
            $table->decimal('nota_maxima', 5, 0);
            $table->text('definicion_escala')->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escala_valoracion');
    }
};
