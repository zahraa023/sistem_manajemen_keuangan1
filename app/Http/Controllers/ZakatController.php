<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisZakat;
use App\Models\DonaturZakat;

class ZakatController extends Controller
{
    public function index()
    {
        $jenisZakats = JenisZakat::all();
        $donaturs = DonaturZakat::with('jenisZakat')
            ->where('status', 'selesai')
            ->get();

        return view('zakat', compact('jenisZakats', 'donaturs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'           => 'required|string|max:255',
            'tanggal'        => 'required|date',
            'jumlah'         => 'required|numeric|min:0',
            'jenis_zakat_id' => 'required|exists:jenis_zakats,id',
            'metode'         => 'required|string|max:50',
            'bukti'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $donatur = new DonaturZakat();
        $donatur->nama = $request->nama;
        $donatur->tanggal = $request->tanggal;
        $donatur->jumlah = $request->jumlah;
        $donatur->jenis_zakat_id = $request->jenis_zakat_id;
        $donatur->metode = $request->metode;

        if ($request->hasFile('bukti')) {
            $path = $request->file('bukti')->store('bukti_zakat', 'public');
            $donatur->bukti = $path;
        }

        $donatur->save();

        return redirect()->route('zakat.index')->with('success', 'Zakat berhasil disimpan.');
    }
}
