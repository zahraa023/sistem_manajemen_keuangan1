<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login'); // ✅ langsung arahkan ke view yang ada
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
            'role'     => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        $role = $request->role;

        if (Auth::attempt([
            'email'    => $credentials['email'],
            'password' => $credentials['password'],
            'role'     => $role
        ])) {
            $request->session()->regenerate();

            if ($role === 'admin') {
                return redirect()->intended('/dashboard');
            } elseif ($role === 'bendahara') {
                return redirect()->intended('/dashben');
            }
        }

        return back()->withErrors([
            'login' => 'Email, password, atau peran tidak sesuai.'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
