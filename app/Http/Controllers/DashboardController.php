<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;

class DashboardController extends Controller
{
    public function storeDonatur(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'metode' => 'nullable|string|max:100',
            'bukti' => 'nullable|image|max:2048',
            'status' => 'nullable|string|max:50',
        ]);

        if ($request->hasFile('bukti')) {
            $validated['bukti'] = $request->file('bukti')->store('bukti_donasi', 'public');
        }

        Donasi::create($validated);

        $donatur = Donasi::orderBy('created_at', 'desc')->get();

        return view('admin.donatur', compact('donatur'));
    }

    public function donatur()
    {
        $donatur = Donasi::orderBy('created_at', 'desc')->get();
        return view('admin.donatur', compact('donatur'));
    }

    public function approve($id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->status = 'selesai';
        $donasi->save();

        return redirect()->back()->with('success', 'Donasi telah di-approve.');
    }

    public function destroy($id)
    {
        $donasi = Donasi::findOrFail($id);
        $donasi->delete();

        return redirect()->back()->with('success', 'Donatur berhasil dihapus.');
    }
}
