<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();

            $table->string('tipe'); 
            // keuangan | tata-kelola | berkelanjutan

            $table->enum('jenis', [
                'triwulan',
                'semester',
                'tahunan'
            ])->nullable();
            // nullable karena non-keuangan bisa langsung tahunan

            $table->year('tahun');

            $table->string('judul');

            $table->string('file');
            // contoh: keu-t1-2025.pdf

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
