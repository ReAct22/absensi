<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeShift extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'employee_id',
        'shift_id',
        'effective_date',
        'end_date'
    ];

    public function Shift(){
        return $this->belongsTo(Shift::class);
    }

    public function Employee(){
        return $this->belongsTo(Employee::class);
    }
}
