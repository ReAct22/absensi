<?php

namespace App\Http\Controllers;

use App\Models\ApproveAttendance;
use Illuminate\Http\Request;

class PresensiManualController extends Controller
{
    public function index(){
        return view('pages.presensi_manual.index');
    }

    public function ListApprove(){
        $approves = ApproveAttendance::all();
        return view("pages.approve_list.index", compact('approves'));
    }
}
