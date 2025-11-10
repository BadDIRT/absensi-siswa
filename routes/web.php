<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AttendanceController;

Route::get('/', [AuthController::class, 'loginForm'])->middleware('guest');
Route::get('/login', [AuthController::class, 'loginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit')->middleware('guest');

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'registerProcess'])->middleware('guest')->name('register.process');


Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Admin Only
Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth', 'role:admin'])->name('admin.dashboard');

// Teacher Only
Route::get('/teacher', [TeacherController::class, 'index'])->middleware(['auth', 'role:teacher']);

// Student Only
Route::get('/student', [StudentController::class, 'index'])->middleware(['auth', 'role:student']);

Route::resource('attendances', AttendanceController::class);
Route::get('/barcode', [BarcodeController::class, 'index'])->name('barcode.index');
Route::post('/barcode/generate', [BarcodeController::class, 'generate'])->name('barcode.generate');
Route::get('/barcode/scan', [AttendanceController::class, 'scan'])->name('barcode.scan');
Route::post('/barcode/validate', [AttendanceController::class, 'validateScan'])->name('barcode.validate');
