<?php

use App\Http\Controllers\AttendanceControler;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login/post', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class. 'logout'])->name('logout');

Route::middleware(['auth', 'roleweb:HR'])->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::resource('attendance', AttendanceControler::class);
});

