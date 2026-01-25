<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PromoRequirement extends Model
{
    use HasFactory;

    protected $table = 'promo_requirements';

    protected $fillable = [
        'promo_id',
        'title',
    ];

    /**
     * RELATION: Requirement -> Promo
     */
    public function promo()
    {
        return $this->belongsTo(Promo::class);
    }
}
