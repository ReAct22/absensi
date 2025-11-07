<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UserSession extends Model
{
    protected $fillable = [
        'user_id',
        'token',
        'expires_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // mengecek apakah session sudah kadaluarsa
    protected function isExpired(): Attribute
    {
        return Attribute::get(fn() => $this->expires_at && now()->greaterThan($this->expires_at));
    }
}
