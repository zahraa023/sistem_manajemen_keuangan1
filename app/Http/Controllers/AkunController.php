<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('akun', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'password' => 'nullable|min:6'
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('akun.index')->with('success', 'Akun berhasil diperbarui!');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();

        // Hapus user dari database
        $user->delete();

        // Logout dari session
        Auth::logout();

        // Invalidasi session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke /login
        return redirect('/loginuser');
    }
}
