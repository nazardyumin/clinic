<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DBCreateController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\SpecialityController;

Route::middleware("auth")->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/appointments', [AppointmentController::class, 'show'])->name('appointments');
    Route::get('/get_doctors/{id}', [AppointmentController::class, 'get_doctors'])->name('get_doctors');
    Route::get('/get_appointments/{id}', [AppointmentController::class, 'get_appointments'])->name('get_appointments');
    Route::get('/redirect_from_doctors_page/{id}', [AppointmentController::class, 'redirect_from_doctors_page'])->name('redirect_from_doctors_page');
    Route::post('/save_appointment', [AppointmentController::class, 'save_appointment'])->name('save_appointment');
    Route::resource('/admin/speciality', SpecialityController::class);
    Route::resource('/admin/doctor', DoctorController::class);
    Route::resource('/admin/timetable', TimetableController::class);
});

Route::middleware("guest")->group(function () {
    Route::get('/login', [AuthController::class, 'show_login_form'])->name('login');
    Route::post('/login_this_user', [AuthController::class, 'login'])->name('login_this_user');
    Route::get('/register', [AuthController::class, 'show_register_form'])->name('register');
    Route::post('/register_new_user', [AuthController::class, 'register'])->name('register_new_user');
});

Route::get('/', function () {
    return redirect(route('home'));
});

Route::get('/home', [DBCreateController::class, 'create_db'])->name('home');
Route::get('/doctors', [DoctorController::class, 'show_doctors'])->name('doctors');
