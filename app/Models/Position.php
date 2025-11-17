<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use SoftDeletes;
    protected $fillabel = [
        'position_name',
        'department_id',
        'level'
    ];

    public function department(){
        return $this->belongsTo(Departments::class);
    }
}
