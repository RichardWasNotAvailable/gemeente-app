
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KlachtController;
use App\Http\Controllers\LoginController;

// Home route — the default Laravel welcome page
Route::get('/', function () {
    return view('welcome');
});

// Klacht page — your complaint form or list
Route::get('/klacht', [KlachtController::class, 'index']);

// storing the klacht
Route::post('/klachten', [KlachtController::class, 'store'])->name('klacht.store');

// returning to the klacht page
Route::get('/klacht', [KlachtController::class, 'index'])->name('klacht');

// going to the employee page
Route::get('/medewerker-login', [LoginController::class, 'index'])->name('medewerker.login');
Route::post('/medewerker-login', [LoginController::class, 'login']);
