<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_recruits', function (Blueprint $table) {
            $table->string('url_recruits')->nullable()->after('is_featured');
        });
    }

    public function down(): void
    {
        Schema::table('job_recruits', function (Blueprint $table) {
            $table->dropColumn('url_recruits');
        });
    }
};
