<?php

namespace App\Http\Controllers\api;

use App\Helpers\GeoHelper;
use App\Http\Controllers\Controller;
use App\Models\AttendanceLog;
use App\Models\GeoFence;
use App\Models\UserLocation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function checkIn(Request $request)
    {
        $request->validate([
            'longtitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'photo' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);



        $geo = GeoFence::first();

        if(!$request->hasFile('photo')){
            return response()->json([
                'status' => false,
                'message' => "silahkan lakukan selfi"
            ], 404);
        }

        $photoPath = $request->file('photo')->store('attendance/selfies', 'public');

        $employeId = Auth::id();
        $officeLat = $geo->latitude;
        $officeLong = $geo->longtitude;
        $radius = $geo->radius;

        $distance = GeoHelper::distance(
            $officeLat,
            $officeLong,
            $request->latitude,
            $request->longtitude
        );

        if ($distance > $radius) {
            return response()->json([
                'success' => false,
                'message' => 'Anda berada di luar area kantor. Check-In ditolak',
                'distance_m' => round($distance, 2)
            ]);
        }

        $now = Carbon::now();

        $attendance = AttendanceLog::create([
            'employee_id' => $employeId,
            'check_in_time' => $now->format('H:i:s'),
            'location_lat' => $request->latitude,
            'location_long' => $request->longtitude,
            'status' => $now->gt(Carbon::parse('08:00:00')) ? 'Terlambat' : 'Hadir',
            'photo_path' => $photoPath
        ]);

        UserLocation::create([
            'user_id' => $employeId,
            'latitude' => $request->latitude,
            'longtitude' => $request->longtitude,
            'tracked_at' => now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Check-In berhasil',
            'data' => $attendance
        ]);
    }

    public function checkOut(Request $request)
    {
        $request->validate([
            'longtitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'photo' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);

        $user = Auth::user();

        if(!$request->hasFile('photo')){
            return response()->json([
                'status' => false,
                'message' => "Silahkan melakukan selfie"
            ], 404);
        }

        $photoPath = $request->file('photo')->store('attendance/selfies', 'public');

        $attendance = AttendanceLog::where('employee_id', $user->id)
            ->whereNull('check_out_time')
            ->latest('check_in_time')
            ->first();

        if(!$attendance){
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada data Check-In yang aktif untuk user ini'
            ], 404);
        }

        $now = Carbon::now();
        $checkInTime = Carbon::parse($attendance->check_in_time);
        $checkOutTime = $checkInTime->diffInHours($now);

        $attendance->update([
            'check_out_time' => $now->format('H:i:s'),
            'total_work_hours' => $checkOutTime,
            'photo_out' => $photoPath
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Check-Out berhasil',
            'data' => $attendance
        ], 201);
    }
}
