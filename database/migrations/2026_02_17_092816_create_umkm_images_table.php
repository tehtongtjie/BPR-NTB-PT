<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('umkm_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('umkm_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->string('image_path');
            $table->boolean('is_thumbnail')->default(false); // untuk foto utama
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umkm_images');
    }
};

