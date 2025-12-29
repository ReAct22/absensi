<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Exception;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class NotificationController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'title' => 'required|string',
            'message' => 'required|string',
            'type' => 'required'
        ]);

        try{
            $employeeId = FacadesAuth::user()?->employee?->id;
            // dd($employeeId);
            $data = Notification::create([
                'employee_id' => $employeeId,
                'title' => $request->title,
                'message' => $request->message,
                'type' => $request->type
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $data
            ]);
        } catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: '.$e,
                'data' => []
            ], 400);
        }
    }

    public function getNotification(){
        $employeeId = FacadesAuth::user()->employee->id;

        if(!$employeeId){
            return response()->json([
                'status' => false,
                'message' => "User tidak memiliki employee terkait",
                'data' => []
            ], 400);
        }

        $notification = Notification::where('employee_id', $employeeId)
        ->where('is_read', false)
        ->orderBy('created_at', 'desc')
        ->first();

        return response()->json([
            'status' => true,
            'message' => 'Data notification berhasil diambil',
            'data' => $notification
        ]);
    }

    public function update(Request $request, $id){
        $notif = Notification::findOrFail($id);
        $employeeId = FacadesAuth::user()->employee->id;

        $request->validate([
            'is_read' => 'required|boolean'
        ]);

        if($notif->employee_id !== $employeeId){
            return response()->json([
                'status' => false,
                'message' => 'Tidak diizinkan notifikasi ini',
                'data' => []
            ], 400);
        }

        $notif->is_read = $request->is_read;
        $notif->save();

        return response()->json([
            'status' => true,
            'message' => 'Data Notification berubah',
            'data' => $notif
        ]);
    }
}
