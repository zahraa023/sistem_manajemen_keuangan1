<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\PrayerTime;
use Carbon\Carbon;

class JadwalShalatController extends Controller
{
    public function getJadwal(Request $request)
    {
        $today = Carbon::now();
        $city = 'Agam';

        // Format untuk tampilan (misalnya: 15 Agustus 2025)
        $displayDate = $today->translatedFormat('j F Y');

        // Format untuk database (Y-m-d)
        $dbDate = $today->format('Y-m-d');

        // Cek apakah sudah ada di DB
        $existing = PrayerTime::where('date', $dbDate)
            ->where('location', $city)
            ->first();

        if ($existing) {
            return response()->json([
                'status' => 'from_db',
                'data' => [
                    'tanggal' => $displayDate,
                    'imsak'   => $existing->imsak,
                    'fajr'    => $existing->fajr,
                    'dhuhr'   => $existing->dhuhr,
                    'asr'     => $existing->asr,
                    'maghrib' => $existing->maghrib,
                    'isha'    => $existing->isha,
                ]
            ]);
        }

        // Ambil dari API Aladhan
        $response = Http::withoutVerifying()->get('https://api.aladhan.com/v1/timingsByCity', [
            'city'    => $city,
            'country' => 'Indonesia',
            'method'  => 2
        ]);

        if ($response->successful()) {
            $data = $response->json()['data']['timings'];

            // Simpan ke DB
            PrayerTime::create([
                'date'     => $dbDate,
                'imsak'    => $data['Imsak'],
                'fajr'     => $data['Fajr'],
                'dhuhr'    => $data['Dhuhr'],
                'asr'      => $data['Asr'],
                'maghrib'  => $data['Maghrib'],
                'isha'     => $data['Isha'],
                'location' => $city,
            ]);

            return response()->json([
                'status' => 'from_api',
                'data' => [
                    'tanggal' => $displayDate,
                    'imsak'   => $data['Imsak'],
                    'fajr'    => $data['Fajr'],
                    'dhuhr'   => $data['Dhuhr'],
                    'asr'     => $data['Asr'],
                    'maghrib' => $data['Maghrib'],
                    'isha'    => $data['Isha']
                ]
            ]);
        }

        return response()->json(['error' => 'Gagal mengambil jadwal shalat dari API'], 500);
    }

    public function showJadwal()
    {
        return view('jadwal');
    }
}
