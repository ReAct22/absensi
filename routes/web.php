<?php

use App\Http\Controllers\AttendanceControler;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeShiftController;
use App\Http\Controllers\GeoController;
use App\Http\Controllers\LeaveApproveController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PresensiManualController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\UserManagementController;
use App\Models\Position;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login/post', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'roleweb:HR'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('attendance', AttendanceControler::class);
    Route::get('/presensi', [PresensiManualController::class, 'index'])->name('presensi');
    Route::get('/presensi/list', [PresensiManualController::class, 'ListApprove'])->name('presensi.list');
    Route::resource('department', DepartmentController::class);
    Route::resource('position', PositionController::class);
    Route::resource('employeed', EmployeeController::class);
    Route::resource('shift', ShiftController::class);
    Route::resource('employee-shift', EmployeeShiftController::class);
    Route::resource('leave-approve', LeaveApproveController::class);
    Route::resource('geo-fance', GeoController::class);
    Route::resource('user', UserManagementController::class);
    Route::get('/get-position/{id}', [EmployeeController::class, 'GetPosition'])->name('employeed.getPosition');
});

Route::middleware(['auth', 'roleweb:Manager'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('attendance', AttendanceControler::class);
    Route::get('/presensi', [PresensiManualController::class, 'index'])->name('presensi');
    Route::get('/presensi/list', [PresensiManualController::class, 'ListApprove'])->name('presensi.list');
    Route::resource('department', DepartmentController::class);
    Route::resource('position', PositionController::class);
    Route::resource('employeed', EmployeeController::class);
    Route::resource('shift', ShiftController::class);
    Route::resource('employee-shift', EmployeeShiftController::class);
    Route::resource('leave-approve', LeaveApproveController::class);
});
