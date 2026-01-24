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
        Schema::create('lelang_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lelang_id')
                ->constrained('lelangs')
                ->cascadeOnDelete();

            $table->string('title'); // contoh: Memiliki SIUP/NIB Aktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lelang_requirements');
    }
};
