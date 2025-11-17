<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApproveAttendance extends Model
{
    protected $fillabel = [
        'employeed_id',
        'status'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
