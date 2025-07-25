<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/jadwal', function () {
    return view('jadwal');
});

Route::get('/laporan', function () {
    return view('laporan');
});

Route::get('/donasi', function () {
    return view('donasi');
});

Route::get('/login', function () {
    return view('admin.login'); 
});
Route::get('/loginuser', function () {
    return view('loginuser'); 
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});
Route::get('/dashben', function () {
    return view('admin.dashben');
});

Route::get('/landingpage', function () {
    return view('landingpage');
});

Route::get('/akun', function () {
    return view('akun');
});

Route::get('/adminpanel', function () {
    return view('admin.adminpanel');
});


