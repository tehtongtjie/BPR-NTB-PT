<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique();

            $table->string('category')->nullable(); 
            // contoh: internal, berita, pengumuman

            $table->string('author')->nullable(); 
            // contoh: Humas BPR NTB

            $table->string('thumbnail')->nullable(); 
            // path gambar artikel

            $table->text('excerpt')->nullable(); 
            // ringkasan di bawah gambar

            $table->longText('content'); 
            // isi artikel utama

            $table->date('published_at')->nullable();
            $table->boolean('is_published')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
