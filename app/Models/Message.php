<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'category',
        'is_story',
        'status',
    ];

    protected $casts = [
        'is_story' => 'boolean',
    ];

    public static function categories(): array
    {
        return [
            'nasabah_story' => 'Nasabah Story',
            'pertanyaan' => 'Pertanyaan',
            'saran' => 'Saran',
            'umum' => 'Umum',
        ];
    }
}
