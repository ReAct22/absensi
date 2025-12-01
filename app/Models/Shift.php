<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shift extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'shift_name',
        'start_time',
        'end_time',
        'tolerance_time',
        'working_days'
    ];
}
