<?php

namespace App\Http\Controllers\api;

use App\Helpers\GeoHelper;
use App\Http\Controllers\Controller;
use App\Models\AttendanceLog;
use App\Models\Employee;
use App\Models\GeoFence;
use App\Models\UserLocation;
use Carbon\Carbon;
// use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\DB as FacadesDB;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

use function Symfony\Component\Clock\now;

class AttendanceController extends Controller
{
    public function presensiDaily()
    {
        $date = Carbon::now();
        $user_id = Auth::user()->id;
        $employee_id = Employee::where('user_id', $user_id)->first();

        $presensi = AttendanceLog::where('employee_id', $employee_id)
            ->whereDate('created_at', $date)
            ->orderBy('created_at', 'desc')
            ->first();

        return response()->json([
            'status' => true,
            'message' => "Data berhasil diambil",
            'data' => $presensi
        ], 200);
    }

    public function history()
    {
        $user_id = Auth::user()->id;
        $employee_id = Employee::where('user_id', $user_id)->first();
        // dd($employee_id);
        $data = DB::table('attendance_logs as al')
            ->leftJoin('employees as e', 'al.employee_id', '=', 'e.id')
            ->select(
                'al.employee_id',
                'e.full_name',

                DB::raw("MAX(CASE WHEN al.flag = 'check-in' THEN al.time END) AS time_checkin"),
                DB::raw("MAX(CASE WHEN al.flag = 'check-out' THEN al.time END) AS time_checkout"),

                DB::raw("MAX(CASE WHEN al.flag = 'check-in' THEN al.photoPath END) AS photo_in"),
                DB::raw("MAX(CASE WHEN al.flag = 'check-out' THEN al.photoPath END) AS photo_out"),

                DB::raw("MAX(CASE WHEN al.flag = 'check-in' THEN al.longitude END) AS longitude_in"),
                DB::raw("MAX(CASE WHEN al.flag = 'check-in' THEN al.latitude END) AS latitude_in"),

                DB::raw("MAX(CASE WHEN al.flag = 'check-out' THEN al.longitude END) AS longitude_out"),
                DB::raw("MAX(CASE WHEN al.flag = 'check-out' THEN al.latitude END) AS latitude_out"),

                DB::raw("
            MAX(
                CASE
                    WHEN al.flag = 'check-out' AND al.time < '17:00:00' THEN 'Pulang Cepat'
                    WHEN al.flag = 'check-out' AND al.time > '17:00:00' THEN 'Lembur'
                    WHEN al.flag = 'check-out' AND al.time = '17:00:00' THEN 'Hadir'
                    ELSE 'Absen'
                END
            ) AS status
        ")
            )
            ->where('al.employee_id', $employee_id->id)
            ->groupBy('al.employee_id', 'e.full_name')
            ->get(); // karena hasilnya 1 row
        // dd($data);
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil di ambil',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'time' => 'required',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'photo' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        Log::info('VALIDATED DATA', $validated);

        $employeeId = Auth::user()->employee->id;

        $presensi = AttendanceLog::where('employee_id', $employeeId)
            ->whereDate('created_at', now())
            ->first();

        if ($presensi == null) {
            // dd($presensi->flag);
            $geo = GeoFence::first();

            if (!$request->hasFile('photo')) {
                return response()->json([
                    'status' => true,
                    'message' => "Silahkan lakukan selfi",
                    'data' => []
                ], 400);
            }

            $photoPath = $request->file('photo')->store('attendance/selfi', 'public');
            $distance = GeoHelper::distance(
                $geo->latitude,
                $geo->longtitude,
                $request->latitude,
                $request->longitude
            );

            if ($distance > $geo->radius) {
                return response()->json([
                    'status' => false,
                    'message' => 'Anda berada diluar radius ' . $distance,
                    'data' => []
                ], 403);
            }

            $data = AttendanceLog::create([
                'employee_id' => $employeeId,
                'time' => $request->time,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'photoPath' => $photoPath,
                'flag' => 'Check-in'
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Presensi berhasil',
                'data' => $data
            ], 200);
        } else {
            // dd($presensi->flag);
            $geo = GeoFence::first();

            if (!$request->hasFile('photo')) {
                return response()->json([
                    'status' => true,
                    'message' => "Silahkan lakukan selfi",
                    'data' => []
                ], 400);
            }

            $photoPath = $request->file('photo')->store('attendance/selfi', 'public');
            $distance = GeoHelper::distance(
                $geo->latitude,
                $geo->longtitude,
                $request->latitude,
                $request->longitude
            );

            if ($distance > $geo->radius) {
                return response()->json([
                    'status' => false,
                    'message' => 'Anda berada diluar radius ' . $distance,
                    'data' => []
                ], 403);
            }

            $data = AttendanceLog::create([
                'employee_id' => $employeeId,
                'time' => $request->time,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'photoPath' => $photoPath,
                'flag' => 'Check-out'
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Presensi berhasil',
                'data' => $data
            ], 200);
        }
    }
}
