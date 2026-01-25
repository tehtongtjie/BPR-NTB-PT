<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterestRateDeposito extends Model
{
    protected $fillable = [
        'interest_rate_period_id',
        'tenor_month',
        'rate',
        'is_best',
        'label',
    ];

    public function period()
    {
        return $this->belongsTo(InterestRatePeriod::class);
    }
}
