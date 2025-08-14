<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanKeuangan;

class LaporanKeuanganController extends Controller
{
    public function index()
    {
        $laporan = LaporanKeuangan::orderBy('created_at', 'desc')->get();
        return view('admin.laporanadmin', compact('laporan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_transaksi' => 'required|string|max:255',
            'pemasukan' => 'nullable|numeric',
            'pengeluaran' => 'nullable|numeric',
            'bulan' => 'required|string',
            'tahun' => 'required|string'
        ]);

        LaporanKeuangan::create($request->all());

        return redirect()->back()->with('success', 'Laporan berhasil disimpan.');
    }
}
