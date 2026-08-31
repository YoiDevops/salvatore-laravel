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

        Schema::create('periodo', function (Blueprint $table) {
            $table->increments('id_periodo');
            $table->string('nombre_periodo', 30);
            $table->decimal('porcentaje_periodo', 5, 2);
            $table->year('anio_lectivo');
            $table->date('fecha_inicio');
            $table->date('fecha_cierre');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodo');
    }
};
