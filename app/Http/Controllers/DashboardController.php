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
    $errorMessage = '';
    // Retrieve unresolved klachten from the Dashboard model
    $klachten = Dashboard::returnKlachten();
    // Retrieve resolved (opgeloste) klachten as well
    $opgelosteKlachten = Dashboard::returnOpgelosteKlachten();

        // Pass variables to the view
        return view('dashboard', compact('Naam', 'klachten', 'opgelosteKlachten', 'errorMessage'));
    }
}