<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $table = 'admins';

    protected $guard_name = 'web';

    protected $fillable = [
        'username',
        'password',
        'role',
        'is_active',
        'last_login_at',
        'last_login_ip',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'last_login_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    // Auto hash password
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            // Jika sudah di-hash (panjang 60 char), jangan di-hash lagi. 
            // Jika belum, baru di-hash.
            $this->attributes['password'] = Hash::needsRehash($value)
                ? Hash::make($value)
                : $value;
        }
    }
}
