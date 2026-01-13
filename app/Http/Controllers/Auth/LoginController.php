<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


// app/Http/Controllers/Auth/LoginController.php
class LoginController extends Controller
{
    /*************  ✨ Windsurf Command ⭐  *************/
    /**
     * Show the login form
     *
     * @return \Illuminate\Http\Response
     */
    /*******  3c543aec-eee6-435f-b68f-3bf058eece68  *******/
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            /** @var \App\Models\User $user */
            $user = Auth::user();

            if ($user->isBidan()) {
                return redirect()->route('bidan.dashboard');
            }

            if ($user->isPetugasDesa()) {
                return redirect()->route('desa.dashboard');
            }

            return redirect()->route('user.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
