<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterestRatePeriod extends Model
{
    protected $fillable = [
        'title',
        'month',
        'year',
        'is_active',
    ];

    public function lps()
    {
        return $this->hasOne(InterestRateLps::class);
    }

    public function tabungans()
    {
        return $this->hasMany(InterestRateTabungan::class);
    }

    public function depositos()
    {
        return $this->hasMany(InterestRateDeposito::class);
    }
}
