<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lelangs', function (Blueprint $table) {
            $table->id();

            // =====================
            // INFORMASI UTAMA
            // =====================
            $table->string('title');               // Renovasi Gedung Kantor Cabang Utama Mataram
            $table->string('slug')->unique();      // URL SEO
            $table->string('category')->nullable(); // Konstruksi, IT, Pengadaan, dll

            // =====================
            // STATUS & WAKTU
            // =====================
            $table->enum('status', ['aktif', 'ditutup', 'selesai'])
                  ->default('aktif');              // Tender status
            $table->date('deadline')->nullable();  // Batas akhir (10 Feb 2026)

            // =====================
            // KONTEN
            // =====================
            $table->string('banner')->nullable();  // Banner / gambar lelang
            $table->text('short_desc')->nullable();// Ringkasan singkat
            $table->longText('description')->nullable(); 
            // Spesifikasi proyek

            // =====================
            // FILE & DOKUMEN
            // =====================
            $table->string('rks_file')->nullable(); 
            // Dokumen RKS (PDF)

            // =====================
            // FLAG & KONTROL
            // =====================
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lelangs');
    }
};
