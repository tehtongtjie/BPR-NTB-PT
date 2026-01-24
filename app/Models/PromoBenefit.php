<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PromoBenefit extends Model
{
    use HasFactory;

    protected $table = 'promo_benefits';

    protected $fillable = [
        'promo_id',
        'title',
    ];

    /**
     * RELATION: Benefit -> Promo
     */
    public function promo()
    {
        return $this->belongsTo(Promo::class);
    }
}
