<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Melder;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{

    public function index()
    {
        // Retrieve session data
        $Naam = Session::get('Naam', 'Guest'); // Default to 'Guest' if Naam is not set

        // Initialize an empty collection for klachten
        $klachten = collect();
        $errorMessage = '';
        $klachten = klacht::returnKlachten();
        // Pass variables to the view
        return view('dashboard', compact('Naam', 'klachten', 'errorMessage'));
    }
<<<<<<< Updated upstream
}
=======


}
>>>>>>> Stashed changes
