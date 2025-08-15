<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil daftar bulan unik dari created_at
        $bulan = DB::table('transaksis')
                    ->selectRaw('YEAR(created_at) as tahun, MONTH(created_at) as bulan')
                    ->distinct()
                    ->orderBy('tahun', 'asc')
                    ->orderBy('bulan', 'asc')
                    ->get();

        // Ambil data transaksi, bisa filter bulan
        if ($request->has('bulan') && $request->bulan != '') {
            $selected = explode('-', $request->bulan); // format: YYYY-MM
            $transaksis = Transaksi::whereYear('created_at', $selected[0])
                            ->whereMonth('created_at', $selected[1])
                            ->get();
        } else {
            $transaksis = Transaksi::all();
        }

        return view('laporan', compact('bulan', 'transaksis'));
    }
}

