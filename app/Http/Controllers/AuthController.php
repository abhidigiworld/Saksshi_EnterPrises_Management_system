<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($request->username === 'SakshiE2024' && $request->password === 'sakshi0807') {
            return redirect()->route('welcome');
        }

        return back()->withErrors([
            'error' => 'Invalid username or password.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout(); 

        return redirect()->route('login'); 
    }

}
