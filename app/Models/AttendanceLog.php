<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttendanceLog extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'employee_id',
        'check_in_time',
        'check_out_time',
        'location_lat',
        'location_long',
        'status',
        'total_work_hours',
        'photo_path',
        'photo_out',
        'location_lat_out',
        'location_long_out',
        'status_out'
    ];
}
