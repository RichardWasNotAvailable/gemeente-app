
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KlachtController;

// Home route — the default Laravel welcome page
Route::get('/', function () {
    return view('welcome');
});

// Klacht page — your complaint form or list
Route::get('/klacht', [KlachtController::class, 'index']);
