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
        Schema::create('job_recruits', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('Full-time');
            $table->string('location')->nullable();
            $table->longText('description');
            $table->longText('requirements'); // Bisa simpan HTML dari CKEditor
            $table->string('salary_range')->nullable();
            $table->enum('status', ['active', 'closed', 'draft'])->default('draft');
            $table->date('deadline')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_recruits');
    }
};
