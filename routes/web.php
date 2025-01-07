<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorAppointmentController;

// Authentication routes
Route::get('register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('register', [UserController::class, 'register']);
Route::get('login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->name('logout');

// Patient routes
Route::middleware('auth')->group(function () {
    Route::get('appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::post('appointments', [AppointmentController::class, 'store']);
    Route::patch('appointments/{id}/status', [AppointmentController::class, 'updateStatus']);
});

// Doctor routes
Route::middleware('auth')->prefix('doctor')->group(function () {
    Route::get('appointments', [DoctorAppointmentController::class, 'index'])->name('doctor.appointments.index');
    Route::patch('appointments/{id}/status', [DoctorAppointmentController::class, 'updateStatus']);
});

Route::get('/', function () {
    return view('welcome');
});
