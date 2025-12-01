<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\LeaveMail;
use App\Models\LeaveRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ApiLeaverequestController extends Controller
{
    public function leave_request(Request $request){
        $request->validate([
            'employee_id' => 'required|integer',
            'leave_type' => 'required|string',
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d',
            'reason' => 'nullable|string',
            'attachment' => 'nullable|mimes:jpg,png,pdf|max:5120',
        ]);

        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);

        $total_days = $start->diffInDays($end) + 1;

        $attachment = null;

        if($request->hasFile('attachment')){
            $attachment = $request->file('attachment')->store('document', 'public');
        }

        $email = Auth::user()->email;

        Mail::to($email)->send(new LeaveMail($request->employee_id, $request->start_date, $request->end_date, $total_days, $attachment));

        LeaveRequest::create([
            'employee_id' => $request->employee_id,
            'leave_type' => $request->leave_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_days' => $total_days,
            'reason' => $request->reason,
            'attachment' => $attachment
        ]);

        return response()->json([
            'message' => 'Leave Request at the post'
        ]);
    }
}
