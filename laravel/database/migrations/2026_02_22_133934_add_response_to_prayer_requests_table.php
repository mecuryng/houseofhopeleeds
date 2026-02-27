<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prayer_requests', function (Blueprint $table) {
            $table->text('response')->nullable()->after('status');
            $table->foreignId('responded_by')->nullable()->after('response')->constrained('users')->nullOnDelete();
            $table->timestamp('responded_at')->nullable()->after('responded_by');
        });
    }

    public function down(): void
    {
        Schema::table('prayer_requests', function (Blueprint $table) {
            $table->dropColumn(['response', 'responded_by', 'responded_at']);
        });
    }
};
