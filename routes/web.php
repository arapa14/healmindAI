<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('landing');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');