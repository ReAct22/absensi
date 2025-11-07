<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficeIp extends Model
{
    protected $fillable = [
        'name', 'ip_address'
    ];
}
