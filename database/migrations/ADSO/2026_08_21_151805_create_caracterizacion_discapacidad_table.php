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

        Schema::create('caracterizacion_discapacidad', function (Blueprint $table) {
            $table->increments('id_caracterizacion');
            $table->string('tipo_discapacidad', 60);
            $table->text('diagnostico')->nullable();
            $table->enum('grado_discapacidad', ["Leve","Moderada","Severa"]);
            $table->enum('permanencia', ["Temporal","Permanente"]);
            $table->string('grado_atencion', 80)->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caracterizacion_discapacidad');
    }
};
