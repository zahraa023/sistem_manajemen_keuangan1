<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JadwalShalatController extends Controller
{
    public function getJadwal(Request $request)
    {
        // Lokasi default: Agam (ID kota 703 berdasarkan MyQuran API)
        $cityId = 703;
        $date = now()->format('Y-m-d');

        $url = "https://api.myquran.com/v1/sholat/jadwal/{$cityId}/{$date}";

        $response = Http::get($url);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Gagal mengambil jadwal shalat'], 500);
        }
    }
}
