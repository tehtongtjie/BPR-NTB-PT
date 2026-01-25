<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interest_rate_tabungan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('interest_rate_period_id')
                  ->constrained('interest_rate_periods')
                  ->cascadeOnDelete();

            $table->string('tabungan_type'); // SIMBADA, TABUNGANKU
            $table->decimal('rate', 5, 2);   // 2.50

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interest_rate_tabungan');
    }
};
