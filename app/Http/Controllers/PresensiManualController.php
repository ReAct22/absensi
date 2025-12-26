<?php

namespace App\Http\Controllers;

use App\Models\ApproveAttendance;
use App\Models\AttendanceLog;
use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;

class PresensiManualController extends Controller
{
    public function index(){
        $employees = Employee::lazy();
        return view('pages.presensi_manual.index', compact('employees'));
    }

    public function ListApprove(){
        $approves = ApproveAttendance::all();
        return view("pages.approve_list.index", compact('approves'));
    }

    public function store(Request $request){
        $request->validate([
            'employee_id' => 'required|integer',
            'check_in' => 'required',
            'check_out' => 'required',
            'status' => 'required'
        ]);

        try{
            AttendanceLog::create([
                'employee_id' => $request->employee_id,
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'status' => $request->status
            ]);
        } catch(Exception $e){
            
        }
    }
}
