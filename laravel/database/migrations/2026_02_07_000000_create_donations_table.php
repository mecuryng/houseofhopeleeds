<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('provider'); // stripe|paypal
            $table->string('provider_id')->nullable();
            $table->bigInteger('amount'); // in cents
            $table->string('currency', 8)->default('usd');
            $table->string('frequency')->default('one_time'); // one_time|recurring
            $table->string('status')->default('pending'); // pending|succeeded|failed
            $table->string('email')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
