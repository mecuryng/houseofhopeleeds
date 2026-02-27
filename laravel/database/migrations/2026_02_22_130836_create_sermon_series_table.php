<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sermon_series', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::table('sermons', function (Blueprint $table) {
            $table->foreignId('series_id')->nullable()->after('pastor_id')->constrained('sermon_series')->nullOnDelete();
            $table->integer('series_order')->nullable()->after('series_id');
        });
    }

    public function down(): void
    {
        Schema::table('sermons', function (Blueprint $table) {
            $table->dropForeign(['series_id']);
            $table->dropColumn(['series_id', 'series_order']);
        });

        Schema::dropIfExists('sermon_series');
    }
};
