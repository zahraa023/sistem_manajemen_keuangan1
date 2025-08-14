<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:6',
        ]);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password user berhasil diperbarui.');
    }
}
