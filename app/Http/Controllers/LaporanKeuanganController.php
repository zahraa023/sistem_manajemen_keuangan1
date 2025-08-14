<?php

namespace App\Http\Controllers;

use App\Models\LaporanKeuangan;
use Illuminate\Http\Request;

class LaporanKeuanganController extends Controller
{
    /**
     * Tampilkan daftar laporan keuangan berdasarkan bulan dan tahun.
     */
    public function index(Request $request)
    {
        // Ambil filter bulan dan tahun, default ke bulan & tahun sekarang
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));

        // Ambil data laporan keuangan
        $laporan = LaporanKeuangan::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->orderByDesc('created_at')
            ->get();

        return view('laporanadmin', compact('laporan', 'bulan', 'tahun'));
    }

    /**
     * Simpan laporan keuangan baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_transaksi' => 'required|string|max:255',
            'pemasukan'      => 'nullable|numeric',
            'pengeluaran'    => 'nullable|numeric',
            'bulan'          => 'required|digits:2',
            'tahun'          => 'required|digits:4',
        ]);

        // Pastikan pemasukan dan pengeluaran default 0 jika null
        $validated['pemasukan'] = $validated['pemasukan'] ?? 0;
        $validated['pengeluaran'] = $validated['pengeluaran'] ?? 0;

        LaporanKeuangan::create($validated);

        return redirect()->route('laporan.index')
                         ->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Hapus laporan keuangan berdasarkan ID.
     */
    public function destroy($id)
    {
        $laporan = LaporanKeuangan::findOrFail($id);
        $laporan->delete();

        return redirect()->route('laporan.index')
                         ->with('success', 'Data berhasil dihapus.');
    }
}
