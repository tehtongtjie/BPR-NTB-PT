<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            // Tambahkan kolom role setelah kolom password
            $table->enum('role', ['it', 'bisnis', 'sekper'])
                ->default('it')
                ->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            // Hapus kolom jika migration di-rollback
            $table->dropColumn('role');
        });
    }
};
