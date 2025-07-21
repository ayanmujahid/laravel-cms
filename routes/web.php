<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\AttendanceController;

Route::get('/', [IndexController::class, 'index'])->name('home');




// -----------------------------------Auth system-----------------------------------
Route::post('/signup-submit', [AuthController::class, 'signUpSubmit'])->name('signupSubmit');
Route::post('/signin-submit', [AuthController::class, 'signInSubmit'])->name('signInSubmit');

Route::get('/signin', [AuthController::class, 'signin'])->name('signin');
Route::get('/signup', [AuthController::class, 'signup'])
    ->middleware(['auth', 'role:1'])
    ->name('signup');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// -----------------------------------Auth system-----------------------------------




// -----------------------------------Leave system-----------------------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('home');
    Route::get('/leaves', [LeaveController::class, 'index'])->name('leaves.index');
    Route::post('/leaves', [LeaveController::class, 'store'])->name('leaves.store');
    Route::get('/apply-leave', [LeaveController::class, 'create'])->name('leaves.create');


});
// -----------------------------------Leave system-----------------------------------

// ------------------------------------Attendance system-----------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance/mark', [AttendanceController::class, 'store'])->name('attendance.mark');
    Route::get('/mark-attendance', [AttendanceController::class, 'create'])->name('attendance.create');

});
// ------------------------------------Attendance system----------------------------------- 