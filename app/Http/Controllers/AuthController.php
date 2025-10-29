<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medewerker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'wachtwoord' => 'required'
        ]);

        $user = Medewerker::where('email', $request->email)->first();

        if ($user && Hash::check($request->wachtwoord, $user->wachtwoord)) {
            Session::put('medewerker_id', $user->MedewerkerID);
            Session::put('naam', $user->Naam);
            return redirect('/dashboard');
        }

        return back()->withErrors(['login' => 'Ongeldige inloggegevens']);
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}
