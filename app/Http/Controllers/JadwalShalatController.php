<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\PrayerTime;

class JadwalShalatController extends Controller
{
    // Endpoint API - Mengambil data dari Aladhan dan simpan ke DB
    public function getJadwal(Request $request)
{
    $today = now()->format('Y-m-d');
    $city = 'Agam';

    // Cek apakah sudah ada di DB
    $existing = PrayerTime::where('date', $today)
                          ->where('location', $city)
                          ->first();

    if ($existing) {
        return response()->json(['status' => 'from_db', 'data' => [
            'tanggal' => $existing->date,
            'imsak'   => $existing->imsak,
            'fajr'    => $existing->fajr,
            'dhuhr'   => $existing->dhuhr,
            'asr'     => $existing->asr,
            'maghrib' => $existing->maghrib,
            'isha'    => $existing->isha,
        ]]);
    }

    // Kalau belum ada di DB, ambil dari API
    $response = Http::get('https://api.aladhan.com/v1/timingsByCity', [
        'city'    => $city,
        'country' => 'Indonesia',
        'method'  => 2
    ]);

    if ($response->successful()) {
        $data = $response->json()['data']['timings'];

        // Simpan ke DB
        PrayerTime::create([
            'date'     => $today,
            'imsak'    => $data['Imsak'],
            'fajr'     => $data['Fajr'],
            'dhuhr'    => $data['Dhuhr'],
            'asr'      => $data['Asr'],
            'maghrib'  => $data['Maghrib'],
            'isha'     => $data['Isha'],
            'location' => $city,
        ]);

        return response()->json(['status' => 'from_api', 'data' => [
            'tanggal' => $today,
            'imsak'   => $data['Imsak'],
            'fajr'    => $data['Fajr'],
            'dhuhr'   => $data['Dhuhr'],
            'asr'     => $data['Asr'],
            'maghrib' => $data['Maghrib'],
            'isha'    => $data['Isha']
        ]]);
    }

    return response()->json(['error' => 'Gagal mengambil jadwal shalat dari Aladhan'], 500);
}

    // Menampilkan halaman HTML untuk pengguna
    public function showJadwal()
    {
        return view('jadwal');
    }
}
