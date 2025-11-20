<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginProcess(Request $request)
    {
        // Login paling simpel
        if ($request->email === 'admin@gmail.com' && $request->password === 'admin123') {
            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Email atau Password salah!');
    }

    public function password()
    {
        return view('auth.password');
    }

    public function logout()
    {
        // Logout paling simpel
        return redirect()->route('login');
    }
}
