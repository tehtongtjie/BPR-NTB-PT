<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('interest_rate_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('interest_rate_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('category', ['tabungan', 'deposito']);
            $table->string('name'); // Simbada / 1 Bulan
            $table->string('rate'); // 5.00% / 6.00% p.a
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interest_rate_details');
    }
};
