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

            InterestRatePeriodSeeder::class,
            InterestRateTabunganSeeder::class,
            InterestRateDepositoSeeder::class,
            InterestRateLpsSeeder::class,

            KantorSeeder::class,
        ]);
    }
}
