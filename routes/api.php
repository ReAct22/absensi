<?php

use App\Http\Controllers\api\ApiLeaverequestController;
use App\Http\Controllers\api\AttendanceController;
use App\Http\Controllers\api\AuthApiController;
use App\Http\Controllers\api\UserLocationController;
use App\Models\UserLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/verify-otp', [AuthApiController::class, 'verifyOtp']);
Route::post('/leave-request/approve', [ApiLeaverequestController::class, 'ApproveLeave']);

Route::middleware('auth:sanctum', 'check.session')->group(function () {
    Route::get('/profile', [AuthApiController::class, 'profile']);
    Route::middleware('role:Pegawai,HR,Manager')->group(function () {
        Route::get('/dashboard', function () {
            return response()->json(['message' => 'Selamat datang di dashboard']);
        });
    });
    Route::middleware(['office.ip'])->group(function() {
        Route::post('/location', [UserLocationController::class, 'store']);
    });
    Route::post('/attendance/presensi', [AttendanceController::class, 'store']);
    Route::get('/attendance/daily/', [AttendanceController::class, 'presensiDaily']);
    Route::get('/attendance/history/', [AttendanceController::class, 'history']);
    Route::get('/location/history', [UserLocationController::class, 'history']);
    Route::post('/leave-request/store', [ApiLeaverequestController::class, 'leave_request']);
    Route::get('/leave-request/history', [ApiLeaverequestController::class, 'getLeave']);
    Route::post('/logout', [AuthApiController::class, 'logout']);
});
