<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();

            // Identitas Login
            $table->string('username')->unique();
            $table->string('password');

            // Status akun (bisa disable tanpa hapus)
            $table->boolean('is_active')->default(true);

            // Tracking login
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();

            // Remember session
            $table->rememberToken();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};