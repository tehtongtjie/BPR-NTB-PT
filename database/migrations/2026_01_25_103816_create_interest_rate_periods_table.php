<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interest_rate_periods', function (Blueprint $table) {
            $table->id();

            $table->string('title');                 // Update Jan 2026
            $table->unsignedTinyInteger('month');    // 1 - 12
            $table->unsignedSmallInteger('year');    // 2026
            $table->boolean('is_active')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interest_rate_periods');
    }
};
