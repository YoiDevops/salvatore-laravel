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

        Schema::create('estudiante', function (Blueprint $table) {
            $table->increments('id_estudiante');
            $table->unsignedInteger('id_usuario')->unique()->index();
            $table->unsignedInteger('id_curso')->index();
            $table->foreign('id_curso')->references('id_curso')->on('curso');
            $table->unsignedInteger('id_acudiente')->index();
            $table->foreign('id_acudiente')->references('id_acudiente')->on('acudiente');
            $table->unsignedInteger('id_caracterizacion')->index()->nullable();
            $table->foreign('id_caracterizacion')->references('id_caracterizacion')->on('caracterizacion_discapacidad');
            $table->enum('tipo_documento', ["RC","TI","CC","CE","PASAPORTE","PPT"]);
            $table->string('documento_identidad', 20)->unique();
            $table->string('nombres_estudiante', 50);
            $table->string('apellidos_estudiante', 50);
            $table->date('fecha_nacimiento');
            $table->enum('genero', ["Masculino","Femenino","Otro"]);
            $table->enum('tipo_sangre', ["A+","A-","B+","B-","AB+","AB-","O+","O-"]);
            $table->string('lugar_nacimiento', 80)->nullable();
            $table->string('eps', 80)->nullable();
            $table->enum('estado_estudiante', ["Activo","Retirado","Graduado","Suspendido"])->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiante');
    }
};
