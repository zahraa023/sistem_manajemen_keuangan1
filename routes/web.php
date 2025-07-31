<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\JadwalShalatController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonasisdController;
use App\Http\Controllers\Auth\LoginController;


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
Route::view('/adminpanel', 'admin.adminpanel');

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


