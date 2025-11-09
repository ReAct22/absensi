<?php

use App\Http\Controllers\api\AttendanceController;
use App\Http\Controllers\api\AuthApiController;
use App\Http\Controllers\api\UserLocationController;
use App\Models\UserLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/verify-otp', [AuthApiController::class, 'verifyOtp']);

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
    Route::post('/attendance/checkin', [AttendanceController::class, 'checkIn']);
    Route::post('/attendance/checkout', [AttendanceController::class, 'checkOut']);
    Route::get('/location/history', [UserLocationController::class, 'history']);
    Route::post('/logout', [AuthApiController::class, 'logout']);
});
