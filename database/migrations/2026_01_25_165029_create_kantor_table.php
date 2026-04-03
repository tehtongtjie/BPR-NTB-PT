<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kantor', function (Blueprint $table) {
            $table->id();

            $table->enum('tipe', ['pusat', 'cabang', 'kas', 'pokp'])
                  ->comment('jenis kantor');

            $table->string('nama');
            $table->text('alamat');

            $table->string('telepon')
                  ->nullable()
                  ->comment('nomor yang bisa dihubungi');

            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kantor');
    }
};
