<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserCrudController;
use App\Http\Controllers\ClassCrudController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\StudentCrudController;
use App\Http\Controllers\TeacherCrudController;
use App\Http\Controllers\AttendanceCrudController;
use App\Http\Controllers\DepartmentCrudController;

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


// CRUD Routes for Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::resource('students', StudentCrudController::class);
    Route::resource('classes', ClassCrudController::class);
    Route::resource('departments', DepartmentCrudController::class);
    Route::resource('teachers', TeacherCrudController::class);
    Route::resource('users', UserCrudController::class);
    Route::resource('attendances', AttendanceCrudController::class);

    Route::get('students/barcode/create', [BarcodeController::class, 'create'])
        ->name('students.barcode.create');

    Route::post('students/barcode/store', [BarcodeController::class, 'store'])
        ->name('students.barcode.store');

    Route::get('students/{student}/barcode/download', [BarcodeController::class, 'download'])
        ->name('students.barcode.download');

    Route::get('attendances/scan', [AttendanceController::class, 'scanForm'])
        ->name('attendances.scan');

    Route::post('attendances/scan', [AttendanceController::class, 'scanProcess'])
        ->name('attendances.scan.process');

});
