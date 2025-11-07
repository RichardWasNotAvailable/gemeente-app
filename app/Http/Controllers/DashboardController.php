<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Melder;
use Illuminate\Support\Facades\Session;
use App\Models\Klacht;
use App\Models\Dashboard;


class DashboardController extends Controller
{

    public function index()
    {
        // Retrieve session data
        $Naam = Session::get('Naam', 'Guest'); // Default to 'Guest' if Naam is not set

    // Initialize an empty collection for klachten
    $klachten = collect();
        
    $errorMessage = '';
    // Retrieve klachten from the Dashboard model (return a collection)
    // Dashboard::returnKlachten() returns a query builder, so call ->get()
    $klachten = Dashboard::returnKlachten()->get();
        // Pass variables to the view
        return view('dashboard', compact('Naam', 'klachten', 'errorMessage'));
    }
}
