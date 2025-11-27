<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'employee_code',
        'full_name',
        'email',
        'phone_number',
        'gender',
        'position_id',
        'department_id',
        'hire_date',
        'employment_status',
        'photo_profile',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function position(){
        return $this->belongsTo(Position::class);
    }

    public function department(){
        return $this->belongsTo(Departments::class);
    }
}
