<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->foreignId('donation_goal_id')->nullable()->after('user_id')->constrained('donation_goals')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->dropForeign(['donation_goal_id']);
            $table->dropColumn('donation_goal_id');
        });
    }
};
