<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InterestRatePeriod;
use App\Models\InterestRateDeposito;

class InterestRateDepositoSeeder extends Seeder
{
    public function run(): void
    {
        $period = InterestRatePeriod::first();

        if (! $period) {
            return;
        }

        InterestRateDeposito::create([
            'interest_rate_period_id' => $period->id,
            'tenor_month'             => 12,
            'rate'                    => 6.00,
            'is_best'                 => true,
            'label'                   => 'Penempatan Terbaik',
        ]);
    }
}
