<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;

class DonasiController extends Controller
{
    public function index()
    {
        // Ambil semua donasi dengan status selesai atau tolak
        $donasis = Donasi::whereIn('status', ['selesai', 'tolak'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('donasi', compact('donasis'));
    }

    public function create()
    {
        // Ambil semua data donasi dari database
        $donasis = Donasi::all();

        // Kirim data ke view 'donasi'
        return view('donasi', compact('donasis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jumlah'  => 'required|numeric',
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
