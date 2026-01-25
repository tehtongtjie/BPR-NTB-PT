<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InterestRatePeriod;

class InterestRatePeriodSeeder extends Seeder
{
    public function run(): void
    {
        InterestRatePeriod::firstOrCreate(
            [
                'month' => 1,
                'year'  => 2026,
            ],
            [
                'title'     => 'Update Jan 2026',
                'is_active' => true,
            ]
        );
    }
}
