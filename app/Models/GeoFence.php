<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeoFence extends Model
{
    protected $fillable = [
        'name', 'latitude', 'longtitude', 'radius'
    ];
}
