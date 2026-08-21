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

        Schema::create('sede', function (Blueprint $table) {
            $table->increments('id_sede');
            $table->string('nit', 20)->index();
            $table->foreign('nit')->references('nit')->on('institucion');
            $table->string('nombre_sede', 80);
            $table->string('direccion_sede', 150)->nullable();
            $table->string('telefono_sede', 20)->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sede');
    }
};
