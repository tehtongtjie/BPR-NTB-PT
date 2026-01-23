<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class InterestRate extends Model
{
    protected $fillable = [
        'title', 'rate', 'description', 'lps_url', 'is_active'
    ];

    public function details()
    {
        return $this->hasMany(InterestRateDetail::class);
    }
}
