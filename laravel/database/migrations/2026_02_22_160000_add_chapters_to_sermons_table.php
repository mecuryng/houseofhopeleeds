<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sermons', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->json('chapters')->nullable()->after('audio_url');
            $table->string('duration')->nullable()->after('chapters');
            $table->string('thumbnail')->nullable()->after('duration');
        });
    }

    public function down(): void
    {
        Schema::table('sermons', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->dropColumn(['chapters', 'duration', 'thumbnail']);
        });
    }
};
