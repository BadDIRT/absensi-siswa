<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirstController;
use App\Http\Controllers\LoginController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FirstController::class, 'index'])->middleware('guest');
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest')->name('authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/admin/dashboard', [FirstController::class, 'index2'])->middleware('auth')->name('admin.dashboard');
