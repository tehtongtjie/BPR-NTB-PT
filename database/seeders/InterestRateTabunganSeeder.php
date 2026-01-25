<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InterestRatePeriod;
use App\Models\InterestRateTabungan;
use Carbon\Carbon;

class InterestRateTabunganSeeder extends Seeder
{
    public function run(): void
    {
        $period = InterestRatePeriod::first();

        if (! $period) {
            return;
        }

        InterestRateTabungan::insert([
            [
                'interest_rate_period_id' => $period->id,
                'tabungan_type'           => 'SIMBADA',
                'rate'                    => 5.00,
                'created_at'              => Carbon::now(),
                'updated_at'              => Carbon::now(),
            ],
            [
                'interest_rate_period_id' => $period->id,
                'tabungan_type'           => 'TABUNGANKU',
                'rate'                    => 3.00,
                'created_at'              => Carbon::now(),
                'updated_at'              => Carbon::now(),
            ],
        ]);
    }
}
