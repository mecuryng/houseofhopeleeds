<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sermon_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sermon_id')->constrained('sermons')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('session_id')->nullable()->index();
            $table->ipAddress('ip')->nullable();
            $table->timestamps();

            $table->unique(['sermon_id','user_id']);
            $table->unique(['sermon_id','session_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sermon_likes');
    }
};
