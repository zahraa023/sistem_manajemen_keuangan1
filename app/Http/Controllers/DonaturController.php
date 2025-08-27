<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;

class DonaturController extends Controller
{
    public function index()
    {
        // Ambil semua data donasi terbaru
        $donatur = Donasi::orderBy('created_at', 'desc')->get();
        return view('donatur', compact('donatur'));
    }

    public function approve($id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->status = 'selesai';
        $donasi->save();

        return redirect()->back()->with('success', 'Donasi berhasil di-approve.');
    }

    public function reject($id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->status = 'tolak';
        $donasi->save();

        return redirect()->back()->with('success', 'Donasi berhasil ditolak.');
    }

    public function destroy($id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->delete();

        return redirect()->back()->with('success', 'Donasi berhasil dihapus.');
    }
}
