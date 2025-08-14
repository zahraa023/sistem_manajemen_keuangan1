<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    // Menampilkan halaman laporan admin + filter
    public function index(Request $request)
{
    $filter = $request->get('filter');
    $judul  = 'Semua Data';
    $dataMingguan = []; // <- default, supaya selalu ada

    $query = Transaksi::query();

    if ($filter === 'minggu') {
        $query->whereMonth('created_at', Carbon::now()->month)
              ->whereYear('created_at', Carbon::now()->year);

        $transaksis = $query->orderBy('created_at', 'asc')->get();

        $dataMingguan = [];
        foreach ($transaksis as $t) {
            $tanggal = Carbon::parse($t->created_at)->day;
            $minggu = ceil($tanggal / 7);
            $bulanTahun = Carbon::parse($t->created_at)->format('F Y');
            $key = "Minggu $minggu ($bulanTahun)";
            $dataMingguan[$key][] = $t;
        }

        $judul = 'Data Mingguan Bulan Ini';
    } elseif ($filter === 'bulan') {
        $query->whereMonth('created_at', Carbon::now()->month)
              ->whereYear('created_at', Carbon::now()->year);
        $transaksis = $query->orderBy('created_at', 'desc')->get();
        $dataMingguan = ['Bulan Ini' => $transaksis];
        $judul = 'Data Bulan Ini';
    } elseif ($filter === 'tahun') {
        $query->whereYear('created_at', Carbon::now()->year);
        $transaksis = $query->orderBy('created_at', 'desc')->get();
        $dataMingguan = ['Tahun Ini' => $transaksis];
        $judul = 'Data Tahun Ini';
    } else {
        $transaksis = $query->orderBy('created_at', 'desc')->get();
        $dataMingguan = ['Semua Data' => $transaksis];
        $judul = 'Semua Data';
    }

    return view('laporanadmin', compact('dataMingguan', 'judul', 'filter'));
}
    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_transaksi' => 'required|string|max:255',
            'pemasukan'      => 'nullable|numeric',
            'pengeluaran'    => 'nullable|numeric',
        ]);

        $transaksi = Transaksi::create([
            'nama_transaksi' => $request->nama_transaksi,
            'pemasukan'      => $request->pemasukan ?? 0,
            'pengeluaran'    => $request->pengeluaran ?? 0,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data berhasil disimpan',
            'id'      => $transaksi->id
        ]);
    }

    // Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_transaksi' => 'required|string|max:255',
            'pemasukan'      => 'nullable|numeric',
            'pengeluaran'    => 'nullable|numeric',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'nama_transaksi' => $request->nama_transaksi,
            'pemasukan'      => $request->pemasukan ?? 0,
            'pengeluaran'    => $request->pengeluaran ?? 0,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Data berhasil diperbarui'
        ]);
    }

    // Hapus data
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
