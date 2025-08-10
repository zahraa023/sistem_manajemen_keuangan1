<?php

namespace App\Http\Controllers;

use App\Models\DonaturZakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonaturZakatController extends Controller
{
    public function index()
    {
        $donaturs = DonaturZakat::with('jenisZakat')->orderBy('created_at', 'desc')->get();
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
        $donatur = DonaturZakat::findOrFail($id);

        if ($donatur->bukti && Storage::disk('public')->exists($donatur->bukti)) {
            Storage::disk('public')->delete($donatur->bukti);
        }

        $donatur->delete();
        return back()->with('success', 'Donatur berhasil dihapus.');
    }
}
