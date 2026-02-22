<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // $this->call(PromoSeeder::class);
        $this->call([
            AdminSeeder::class,
            BannerSeeder::class,
            PromoSeeder::class,
            ArticleSeeder::class,
            ManagementSeeder::class,
            LelangSeeder::class,

            InterestRatePeriodSeeder::class,
            InterestRateTabunganSeeder::class,
            InterestRateDepositoSeeder::class,
            InterestRateLpsSeeder::class,
            
            KantorSeeder::class,
            LaporanSeeder::class,
            UmkmSeeder::class,
        ]);
    }
}
