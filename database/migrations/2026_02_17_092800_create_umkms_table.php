<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('nama_usaha');
            $table->string('nama_pemilik');
            $table->string('bidang_usaha');
            $table->string('lokasi');
            $table->string('telepon')->nullable();
            $table->string('link_instagram')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('unggulan')->nullable();
            $table->string('skala')->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};

