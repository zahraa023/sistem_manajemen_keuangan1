<?php

namespace App\Http\Controllers;

use App\Models\KelompokDonasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KelompokDonasiController extends Controller
{
    public function index()
    {
        $donasi = KelompokDonasi::latest()->get();
        return view('admin.keldonasi', compact('donasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'target' => 'required|numeric|min:0',
            'terkumpul' => 'nullable|numeric|min:0',
            'galeri.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $galeriPaths = [];
        if ($request->hasFile('galeri')) {
            foreach ($request->file('galeri') as $file) {
                $galeriPaths[] = $file->store('galeri_donasi', 'public');
            }
        }

        KelompokDonasi::create([
            'judul' => $request->judul,
            'target' => $request->target,
            'terkumpul' => $request->terkumpul ?? 0,
            'galeri' => $galeriPaths ? json_encode($galeriPaths) : null
        ]);

        return redirect()->back()->with('success', 'Data donasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $donasi = KelompokDonasi::findOrFail($id);
        return view('admin.keldonasi_edit', compact('donasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'target' => 'required|numeric|min:0',
            'terkumpul' => 'nullable|numeric|min:0',
            'galeri.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $donasi = KelompokDonasi::findOrFail($id);

        $galeriPaths = $donasi->galeri ? json_decode($donasi->galeri, true) : [];

        if ($request->hasFile('galeri')) {
            foreach ($request->file('galeri') as $file) {
                $galeriPaths[] = $file->store('galeri_donasi', 'public');
            }
        }

        $donasi->update([
            'judul' => $request->judul,
            'target' => $request->target,
            'terkumpul' => $request->terkumpul ?? 0,
            'galeri' => $galeriPaths ? json_encode($galeriPaths) : null
        ]);

        return redirect()->route('kelompok-donasi.index')->with('success', 'Data donasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $donasi = KelompokDonasi::findOrFail($id);

        if ($donasi->galeri) {
            foreach (json_decode($donasi->galeri) as $file) {
                Storage::disk('public')->delete($file);
            }
        }

        $donasi->delete();

        return redirect()->back()->with('success', 'Data donasi berhasil dihapus.');
    }
}
