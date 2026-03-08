<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            [
                'username' => 'admin_it',
                'password' => Hash::make('admin123'),
                'role' => 'it',
                'is_active' => true,
            ],
            [
                'username' => 'admin_bisnis',
                'password' => Hash::make('admin123'),
                'role' => 'bisnis',
                'is_active' => true,
            ],
            [
                'username' => 'admin_sekper',
                'password' => Hash::make('admin123'),
                'role' => 'sekper',
                'is_active' => true,
            ],
        ];

        foreach ($admins as $admin) {
            Admin::updateOrCreate(
                ['username' => $admin['username']],
                $admin
            );
        }
    }
}