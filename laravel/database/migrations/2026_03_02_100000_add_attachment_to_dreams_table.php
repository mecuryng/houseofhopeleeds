<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('dreams', function (Blueprint $table) {
            $table->string('attachment_path')->nullable()->after('content');
        });
    }

    public function down()
    {
        Schema::table('dreams', function (Blueprint $table) {
            $table->dropColumn('attachment_path');
        });
    }
};
