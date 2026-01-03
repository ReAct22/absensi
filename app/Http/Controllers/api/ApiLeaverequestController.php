<?php

namespace App\Http\Controllers\api;

use App\Events\NotificationCreated;
use App\Http\Controllers\Controller;
use App\Mail\LeaveMail;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\Notification;
use App\Models\Position;
use Carbon\Carbon;
use Exception;
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

        $employee = Employee::findOrFail($request->employee_id);

        $position = Position::where('department_id', $employee->department_id)
        ->where('position_name','Manager')->first();
        // dd($position);

        $email_atas = Employee::where('position_id', $position->id)->first();
        // dd($email_atas);

        $data = LeaveRequest::create([
            'employee_id' => $request->employee_id,
            'leave_type' => $request->leave_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_days' => $total_days,
            'reason' => $request->reason,
            'attachment' => $attachment
        ]);

        Mail::to($email_atas->email)->send(new LeaveMail($request->employee_id, $request->start_date, $request->end_date, $total_days, $attachment, $email_atas->email, $data->id));
        return response()->json([
            'message' => 'Leave Request at the post'
        ]);
    }

    public function ApproveLeave(Request $request){
        $request->validate([
            'name_bos' => 'required|string|min:10',
            'status' => 'required|string',
            'date_approve' => 'required|date',
            'employee_id' => 'required|integer'
        ]);

        $notif = Notification::create([
            'employee_id' => $request->employee_id,
            'title' => 'approve leave',
            'message' => 'Izi sudah di approve',
            'type' => 'leave request',
            'is_read' => 0
        ]);

        event(new NotificationCreated($notif));

        $employee_request = LeaveRequest::where('employee_id', $request->employee_id)->first();

        $employee_request->update([
            'approve_by' => $request->name_bos,
            'approve_date' => $request->date_approve,
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'Your Request as approve'
        ]);

    }

    public function getLeave(){
        try{
            $user_id = Auth::user()->id;
            $employee = Employee::where('user_id', $user_id)->first();
            $data = LeaveRequest::where('employee_id', $employee->id)
            ->orderby('created_at', 'desc')
            ->get();
            if($data){
                return response()->json([
                    'status'=> true,
                    'message' => 'Data berhasil dipanggil',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dipanggil',
                    'data' => []
                ], 200);
            }
        } catch (Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan pada sistem '.$e
            ]);
        }
    }

    public function historyLeave(){
        $history = LeaveRequest::all();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diambil',
            'data' => $history
        ], 200);
    }

}
