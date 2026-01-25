<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterestRateTabungan extends Model
{
    protected $table = 'interest_rate_tabungan';
    protected $fillable = [
        'interest_rate_period_id',
        'tabungan_type',
        'rate',
    ];

    public function period()
    {
        return $this->belongsTo(InterestRatePeriod::class);
    }
}
