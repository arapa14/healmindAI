<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JournalEntrieController;
use App\Http\Controllers\MoodEntrieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecomendationController;
use App\Http\Controllers\ReferralController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('landing');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'e   dit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    //
});

Route::middleware(['auth', 'isProfessional'])->group(function () {
    //
});

Route::middleware(['auth', 'isUser'])->group(function () {
    // Mood Entries
    Route::get('/mood', [MoodEntrieController::class, 'index'])->name('mood');
    Route::post('/mood', [MoodEntrieController::class, 'store'])->name('mood.store');

    // Journal Entries
    Route::get('/journal', [JournalEntrieController::class, 'index'])->name('journal');
    Route::post('/journal', [JournalEntrieController::class, 'store'])->name('journal.store');
    Route::get('/journal/{id}', [JournalEntrieController::class, 'edit'])->name('journal.edit');
    Route::put('/journal/{id}', [JournalEntrieController::class, 'update'])->name('journal.update');
    Route::delete('/journal/{id}', [JournalEntrieController::class, 'destroy'])->name('journal.destroy');

    // Chatbot AI
    Route::get('/chatbot', [JournalEntrieController::class, 'chatbot'])->name('chatbot');

    // Recomendation
    Route::get('/recomendation', [RecomendationController::class, 'index'])->name('recomendation');

    // Referral
    Route::get('/referral', [ReferralController::class, 'index'])->name('referral');
    Route::post('/referral', [ReferralController::class, 'store'])->name('referral.store');
});
