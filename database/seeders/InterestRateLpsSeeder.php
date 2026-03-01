<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InterestRatePeriod;
use App\Models\InterestRateLps;

class InterestRateLpsSeeder extends Seeder
{
    public function run(): void
    {
        $period = InterestRatePeriod::first();

        if (! $period) {
            return;
        }

        InterestRateLps::create([
            'interest_rate_period_id' => $period->id,
            'rate'                    => 6.00,
            'note'                    => 'Dijamin LPS hingga Rp 2 Miliar',
            'verification_url'        => 'https://apps.lps.go.id/BankPesertaLPSRate',
        ]);
    }
}
