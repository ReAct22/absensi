<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('employee.{employee_id}', function($user, $employee_id){
    return (int) $user->employee->id === (int) $employee_id;
});
