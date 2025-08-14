<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function laporanAdmin(Request $request)
    {
        $filter = $request->get('filter');
        $query = Transaksi::query();
        $judul = 'Semua Data';

        if ($filter === 'minggu') {
            $query->whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ]);
            $judul = 'Per Minggu';
        } elseif ($filter === 'bulan') {
            $query->whereMonth('created_at', Carbon::now()->month)
                  ->whereYear('created_at', Carbon::now()->year);
            $judul = 'Per Bulan';
        } elseif ($filter === 'tahun') {
            $query->whereYear('created_at', Carbon::now()->year);
            $judul = 'Per Tahun';
        }

        $transaksis = $query->orderBy('created_at', 'desc')->get();

        return view('laporanadmin', compact('transaksis', 'judul'));
    }
}
