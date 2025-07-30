<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\JadwalShalatController;

// Biarkan ini tetap ada
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/jadwal', [JadwalShalatController::class, 'getJadwal']);


