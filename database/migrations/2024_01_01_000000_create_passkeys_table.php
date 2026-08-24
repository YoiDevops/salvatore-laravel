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
        Schema::create('passkeys', function (Blueprint $table) {
            $table->id();
            
            // 1. Tipo de dato exacto matching INT UNSIGNED
            $table->unsignedInteger('id_users');
            
            // 2. Definición explícita de la columna foránea y la columna referenciada
            $table->foreign('id_users')
                  ->references('id_users')
                  ->on('users')
                  ->cascadeOnDelete();

            $table->string('name');
            $table->string('credential_id')->unique();
            $table->json('credential');
            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();

            $table->index('id_users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passkeys');
    }
};

