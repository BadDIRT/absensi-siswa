<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\RegisterController;

Route::middleware('guest')->group(function () {
Route::get('/', [AuthController::class, 'loginForm']);
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'registerProcess'])->name('register.process');

});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Admin Only
Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth', 'role:admin']);

// Teacher Only
Route::get('/teacher', [TeacherController::class, 'index'])->middleware(['auth', 'role:teacher']);

// Student Only
Route::get('/student', [StudentController::class, 'index'])->middleware(['auth', 'role:student']);
