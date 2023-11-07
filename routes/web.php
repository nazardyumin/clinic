<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DBCreateController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware("auth")->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/appointments', [AppointmentController::class, 'show'])->name('appointments');
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
