<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function updatePassword(Request $request, $id)
    {
        // Validasi password baru
        $request->validate([
            'password' => 'required|string|min:6',
        ]);

        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Update password (hashing)
        $user->password = Hash::make($request->password);
        $user->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Password user berhasil diperbarui.');
    }
}
