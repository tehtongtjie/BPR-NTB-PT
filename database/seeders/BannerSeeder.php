<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('banners')->insert([
            [
                'image' => 'images/SimbadaHero.webp',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'image' => 'images/tabungan-hero.webp',
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
