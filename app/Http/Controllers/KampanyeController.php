<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KampanyeController extends Controller
{
    public function index()
    {
        // Tidak kirim data ke view, cukup tampilkan saja
        return view('admin.keldonasi');
    }
}
