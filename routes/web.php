<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\JadwalShalatController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonasisdController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KampanyeController;
use App\Http\Controllers\DonaturZakatController;
use App\Http\Controllers\ZakatController;
use App\Http\Controllers\KelompokDonasiController;
use App\Http\Controllers\DonaturController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('landingpage');
});

// Static Pages
Route::view('/laporan', 'laporan');
Route::view('/deskripsi', 'deskripsi');
Route::view('/zakat', 'zakat');
Route::view('/login', 'admin.login');
Route::view('/loginuser', 'loginuser');

Route::view('/donatur', 'admin.donatur');
Route::view('/welcome', 'welcome');
Route::view('/akun', 'akun');
Route::view('/kellanding', 'admin.kellanding');
Route::view('/laporanadmin', 'admin.laporanadmin');
// Jadwal Shalat
Route::get('/jadwal', [JadwalShalatController::class, 'showJadwal']);

// Autentikasi User
Route::post('/loginuser', [AuthUserController::class, 'login']);
Route::post('/registeruser', [AuthUserController::class, 'register']);


// Donasi
Route::get('/donasi', [DonasiController::class, 'create']);
Route::post('/donasi', [DonasiController::class, 'store'])->name('donasi.store');
Route::get('/donatur', [DashboardController::class, 'donatur'])->name('dashboard.donatur');
Route::post('/donatur', [DashboardController::class, 'storeDonatur'])->name('dashboard.donatur.store');
Route::put('/donatur/approve/{id}', [DashboardController::class, 'approve'])->name('donatur.approve');
Route::delete('/donatur/{id}', [DashboardController::class, 'destroy'])->name('donatur.destroy'); // ✅ tambahkan ini

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/dashben', function () {
    return view('admin.dashben');
});
Route::get('/keldonasi', [KampanyeController::class, 'index'])->name('kelompok.donasi');

Route::get('/donatur_zakat', [DonaturZakatController::class, 'index'])->name('donatur_zakat.index');
Route::get('/donatur_zakat/create', [DonaturZakatController::class, 'create'])->name('donatur_zakat.create');
Route::post('/donatur_zakat', [DonaturZakatController::class, 'store'])->name('donatur_zakat.store');
Route::put('/donatur_zakat/approve/{id}', [DonaturZakatController::class, 'approve'])->name('donatur_zakat.approve');
Route::delete('/donatur_zakat/{id}', [DonaturZakatController::class, 'destroy'])->name('donatur_zakat.destroy');

Route::get('/donatur_zakat', [DonaturZakatController::class, 'index'])->name('donatur_zakat.index');
Route::post('/donatur_zakat', [DonaturZakatController::class, 'store'])->name('donatur_zakat.store');

Route::get('/zakat', [ZakatController::class, 'index'])->name('zakat.index');
Route::post('/zakat', [ZakatController::class, 'store'])->name('donatur_zakat.store');

Route::get('/donatur_zakat', [DonaturZakatController::class, 'index'])->name('donatur.zakat');
Route::get('/donatur_zakat/approve/{id}', [DonaturZakatController::class, 'approve'])->name('donatur.approve');
Route::get('/donatur_zakat/reject/{id}', [DonaturZakatController::class, 'reject'])->name('donatur.reject');
Route::delete('/donatur_zakat/delete/{id}', [DonaturZakatController::class, 'destroy'])->name('donatur.delete');


Route::get('/keldonasi', [KelompokDonasiController::class, 'index'])->name('kelompok-donasi.index');
Route::post('/keldonasi', [KelompokDonasiController::class, 'store'])->name('kelompok-donasi.store');
Route::get('/keldonasi/{id}/edit', [KelompokDonasiController::class, 'edit'])->name('kelompok-donasi.edit');
Route::put('/keldonasi/{id}', [KelompokDonasiController::class, 'update'])->name('kelompok-donasi.update');
Route::delete('/keldonasi/{id}', [KelompokDonasiController::class, 'destroy'])->name('kelompok-donasi.destroy');

// Halaman Donatur
Route::get('/donatur', [DonaturController::class, 'index'])->name('donatur.index');

Route::get('/donatur', [DonaturController::class, 'index'])->name('donatur.index');
Route::put('/donatur/{id}/approve', [DonaturController::class, 'approve'])->name('donatur.approve');
Route::put('/donatur/{id}/reject', [DonaturController::class, 'reject'])->name('donatur.reject');
Route::delete('/donatur/{id}', [DonaturController::class, 'destroy'])->name('donatur.destroy');

Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');
Route::put('/donatur/{id}/approve', [DonaturController::class, 'approve'])->name('donatur.approve');
