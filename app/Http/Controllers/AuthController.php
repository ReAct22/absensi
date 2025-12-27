<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        // Coba autentikasi langsung dengan Auth
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Hindari session fixation
            return redirect()->route('dashboard');// Redirect ke tujuan awal atau home
        }

        // Jika gagal login
        return back()->withErrors([
            'error' => 'Email atau password salah',
        ])->onlyInput('email'); // Kembalikan input email saja
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
