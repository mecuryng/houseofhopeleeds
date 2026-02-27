<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('small_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->foreignId('leader_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('location')->nullable();
            $table->string('meeting_day')->nullable();
            $table->string('meeting_time')->nullable();
            $table->integer('max_members')->default(20);
            $table->boolean('is_open')->default(true);
            $table->string('category')->default('general');
            $table->timestamps();
        });

        Schema::create('small_group_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('small_group_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('role', ['member', 'leader', 'assistant'])->default('member');
            $table->timestamp('joined_at')->nullable();
            $table->timestamps();

            $table->unique(['small_group_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('small_group_members');
        Schema::dropIfExists('small_groups');
    }
};
