<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('promos')->insert([
            [
                'title' => 'TABUNGANKU',
                'short_desc' => 'Tabungan KU BPR NTB merupakan tabungan yang dikhususkan untuk perorangan dengan persyaratan mudah dan ringan serta bebas biaya administrasi.',
                'image' => 'images/tabunganku.png',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'SIMBADA',
                'short_desc' => 'Tabungan SIMBADA BPR NTB merupakan tabungan berjangka untuk mempersiapkan kebutuhan ibadah Qurban dan dilengkapi jaminan Asuransi Jiwa.',
                'image' => 'images/simbada-card.png',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'TABUNGAN SUKSES',
                'short_desc' => 'Tabungan Sukses BPR NTB ditujukan bagi pelaku usaha kecil dengan suku bunga bersaing dan setoran awal ringan.',
                'image' => 'images/tabungan-sukses.png',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
