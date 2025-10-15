<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/send-location', function (Request $request) {
    $latitude = $request->input('latitude');
    $longitude = $request->input('longitude');

    // Here, you would typically process the latitude and longitude
    // You can save it to the database or send it to your employee platform

    // Example: Log the coordinates (replace this with your actual logic)
    \Log::info("User's location: Latitude: $latitude, Longitude: $longitude");

    return response()->json(['success' => true]);
});
