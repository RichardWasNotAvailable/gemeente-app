<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KlachtController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

// Home route — default page
Route::get('/', function () {
    return view('welcome');
});

// Complaint page
Route::get('/klacht', [KlachtController::class, 'index'])->name('klacht');
Route::post('/klachten', [KlachtController::class, 'store'])->name('klacht.store');
// Route to update (mark solved) a klacht

// Employee login
Route::get('/medewerker-login', [LoginController::class, 'index'])->name('medewerker.login');
Route::post('/medewerker-login', [LoginController::class, 'login']);

// Protected dashboard for logged in employees
Route::middleware(['web'])->group(function () {
    // request to update (mark solved) a klacht
    Route::put('/klachten/{klachtID}', [KlachtController::class, 'update'])->name('klachten.update');
    
    // request to access dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});