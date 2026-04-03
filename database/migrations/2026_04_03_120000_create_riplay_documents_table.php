<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riplay_documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('file_path');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riplay_documents');
    }
};
