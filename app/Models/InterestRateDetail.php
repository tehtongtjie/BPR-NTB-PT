<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class InterestRateDetail extends Model
{
    protected $fillable = [
        'interest_rate_id', 'category', 'name', 'rate', 'sort_order'
    ];

    public function interestRate()
    {
        return $this->belongsTo(InterestRate::class);
    }
}