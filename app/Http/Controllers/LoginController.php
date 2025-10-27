<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        // shows medewerkerlogin.blade.php
        return view('medewerkerlogin');
    }

    public function login(Request $request)
    {
        // validate fields first
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // try to log in
        if (Auth::attempt($request->only('email', 'password'))) {
            // success → redirect to dashboard or wherever
            return redirect()->route('dashboard');
        }

        // failed -> send back with error
        return back()->withErrors([
            'email' => 'Email of wachtwoord klopt niet.',
        ])->withInput();
    }
}
