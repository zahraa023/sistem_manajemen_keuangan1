<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;

class DonasiController extends Controller
{
    public function create()
    {
        return view('donasi');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'metode'  => 'required|string|in:QR,Cash',
            'bukti'   => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nama', 'tanggal', 'jumlah', 'metode']);

        if ($request->hasFile('bukti')) {
            $data['bukti'] = $request->file('bukti')->store('bukti_donasi', 'public');
        }

        $data['status'] = 'pending';

        Donasi::create($data);

        return redirect('/donasi')->with('success', 'Donasi berhasil disimpan dan menunggu konfirmasi.');
    }
}
