<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interest_rate_depositos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('interest_rate_period_id')
                  ->constrained('interest_rate_periods')
                  ->cascadeOnDelete();

            $table->unsignedTinyInteger('tenor_month'); // 1, 3, 6, 12
            $table->decimal('rate', 5, 2);              // 5.75
            $table->boolean('is_best')->default(false); // highlight
            $table->string('label')->nullable();        // Best Choice

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interest_rate_depositos');
    }
};