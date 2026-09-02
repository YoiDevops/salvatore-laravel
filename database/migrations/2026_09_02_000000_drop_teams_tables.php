<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('users', 'current_team_id')) {
            Schema::table('users', function ($table) {
                $table->dropForeign(['current_team_id']);
                $table->dropColumn('current_team_id');
            });
        }

        Schema::dropIfExists('team_invitations');
        Schema::dropIfExists('team_members');
        Schema::dropIfExists('teams');
    }

    public function down(): void
    {
        // Teams were removed intentionally and are not recreated automatically.
    }
};
