<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('solicitudes', function (Blueprint $table): void {
            $table->unsignedInteger('id_usuario')->nullable()->after('estado');
            $table->foreign('id_usuario')
                ->references('id_users')
                ->on('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('solicitudes', function (Blueprint $table): void {
            $table->dropForeign(['id_usuario']);
            $table->dropColumn('id_usuario');
        });
    }
};
