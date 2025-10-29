<?php

namespace App\Http\Controllers;

use App\Models\Klacht;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Session::has('medewerker_id')) {
            return redirect('/medewerker-login');
        }

        $klachten = Klacht::latest()->get();

        return view('dashboard', [
            'naam' => Session::get('naam'),
            'klachten' => $klachten
        ]);
    }
}

