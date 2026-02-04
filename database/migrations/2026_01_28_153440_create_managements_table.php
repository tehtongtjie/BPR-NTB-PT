<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('managements', function (Blueprint $table) {
            $table->id();

            // Umum
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('image')->nullable();

            /**
             * type:
             * - direksi
             * - komisaris
             */
            $table->enum('type', ['direksi', 'komisaris']);

            /**
             * position:
             * - Direktur Bisnis
             * - Direktur Kepatuhan
             * - Komisaris Independen
             * - Komisaris Utama
             * dll
             */
            $table->string('position');

            $table->string('excerpt', 255)->nullable();
            $table->longText('profile')->nullable();

            // Pengaturan tampilan
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('managements');
    }
};
