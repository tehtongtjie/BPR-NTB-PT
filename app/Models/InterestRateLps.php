<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterestRateLps extends Model
{
    protected $fillable = [
        'interest_rate_period_id',
        'rate',
        'note',
        'verification_url',
    ];

    public function period()
    {
        return $this->belongsTo(InterestRatePeriod::class);
    }
}
