<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveRequest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'employee_id',
        'leave_type',
        'start_date',
        'end_date',
        'total_days',
        'reason',
        'attachment',
        'status',
        'approved_by',
        'approved_date'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
