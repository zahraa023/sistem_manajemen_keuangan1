<?php

namespace App\Http\Controllers;

use App\Models\DonaturZakat;
use Illuminate\Http\Request;

class DonaturZakatController extends Controller
{
    public function index()
    {
        $donaturs = DonaturZakat::orderBy('created_at', 'desc')->get();
        return view('donatur_zakat', compact('donaturs'));
    }

    public function approve($id)
    {
        $donatur = DonaturZakat::findOrFail($id);
        $donatur->status = 'selesai';
        $donatur->save();

        return back()->with('success', 'Donatur berhasil di-approve.');
    }

    public function reject($id)
    {
        $donatur = DonaturZakat::findOrFail($id);
        $donatur->status = 'ditolak';
        $donatur->save();

        return back()->with('success', 'Donatur berhasil ditolak.');
    }

    public function destroy($id)
    {
        DonaturZakat::destroy($id);
        return back()->with('success', 'Donatur berhasil dihapus.');
    }
}
