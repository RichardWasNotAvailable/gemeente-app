<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medewerker;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


class LoginController extends Controller
{
    public function index()
    {
        return view('medewerkerlogin'); // Ensure this view exists
    }
    public function login(Request $request)
{
    // Validate the input
    $request->validate([
        'email' => 'required|email',
        'wachtwoord' => 'required',
    ]);

    // Find the user by email
    $user = Medewerker::where('email', $request->email)->first();

    // Debug user retrieval
    if (!$user) {
        Log::info('Login attempt failed for non-existent user.', ['email' => $request->email]);
        return back()->withErrors(['login' => 'Ongeldige inloggegevens']);
    }

    // Log current user data
    Log::info('User found:', ['user_id' => $user->MedewerkerID, 'stored_password' => $user->wachtwoord]);

    // Compare passwords
    if ($user && trim($request->wachtwoord) === trim($user->wachtwoord)) {
        // Set session variables
        Session::put('medewerker_id', $user->MedewerkerID);
        Session::put('naam', $user->Naam); // Store the name if needed

        // Confirm session data
        Log::info('User authenticated successfully.', ['user_id' => $user->MedewerkerID]);
        Log::info('Current session:', ['session' => Session::all()]);

        return redirect()->route('dashboard'); // Redirect to the dashboard
    } else {
        // Log the failure details
        Log::info('Login attempt failed', [
            'Entered' => $request->wachtwoord,
            'Stored' => $user->wachtwoord,
            'Match' => trim($request->wachtwoord) === trim($user->wachtwoord) // Check if they match
        ]);
        return back()->withErrors(['login' => 'Ongeldige inloggegevens']); // Failed login
    }
}

public function logout()
    {
        Session::flush(); // Clear all session data
        return redirect('/medewerker-login'); // Redirect to login page
    }
}
