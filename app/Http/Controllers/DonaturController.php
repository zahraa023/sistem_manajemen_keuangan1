<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donatur;
use App\Models\Donasi;
use Illuminate\Support\Facades\DB;

class DonaturController extends Controller
{
    // Tampilkan halaman donatur dengan data
    public function index()
    {
        $donatur = Donatur::orderBy('created_at', 'desc')->get();
        return view('donatur', compact('donatur'));
    }

    // Approve donatur: ubah status & simpan ke donasi
    public function approve($id)
    {
        DB::transaction(function () use ($id) {
            $donatur = Donatur::findOrFail($id);
            $donatur->status = 'selesai';
            $donatur->save();

            Donasi::create([
                'nama' => $donatur->nama,
                'tanggal' => $donatur->tanggal,
                'jumlah' => $donatur->jumlah,
                'metode' => $donatur->metode,
                'bukti' => $donatur->bukti,
                'status' => 'selesai',
            ]);
        });

        return redirect()->back()->with('success', 'Donatur berhasil di-approve dan disimpan ke donasi.');
    }

    // Tolak donatur, ubah status jadi ditolak
    public function tolak($id)
    {
        $donatur = Donatur::findOrFail($id);
        $donatur->status = 'ditolak';
        $donatur->save();

        return redirect()->back()->with('success', 'Donatur berhasil ditolak.');
    }

    // Hapus donatur
    public function destroy($id)
    {
        $donatur = Donatur::findOrFail($id);
        $donatur->delete();

        return redirect()->back()->with('success', 'Donatur berhasil dihapus.');
    }
}
