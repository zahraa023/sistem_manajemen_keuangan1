<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelompokDonasi;
use Illuminate\Support\Facades\Storage;

class KelompokDonasiController extends Controller
{
    public function index()
    {
        $kelompokDonasi = KelompokDonasi::all();
        return view('kelompok_donasi.index', compact('kelompokDonasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelompok' => 'required|string|max:255',
            'target' => 'required|integer|min:0',
            'terkumpul' => 'nullable|integer|min:0',
            'galeri.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $galeriFiles = [];
        if ($request->hasFile('galeri')) {
            foreach ($request->file('galeri') as $file) {
                $path = $file->store('kelompok_galeri', 'public');
                $galeriFiles[] = $path;
            }
        }

        KelompokDonasi::create([
            'nama_kelompok' => $request->nama_kelompok,
            'target' => $request->target,
            'terkumpul' => $request->terkumpul ?? 0,
            'galeri' => $galeriFiles,
        ]);

        return redirect()->back()->with('success', 'Data Kelompok Donasi berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $kd = KelompokDonasi::findOrFail($id);

        $request->validate([
            'nama_kelompok' => 'required|string|max:255',
            'target' => 'required|integer|min:0',
            'terkumpul' => 'nullable|integer|min:0',
            'galeri.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle upload baru, gabungkan dengan galeri lama jika ada
        $galeriFiles = $kd->galeri ?? [];

        if ($request->hasFile('galeri')) {
            foreach ($request->file('galeri') as $file) {
                $path = $file->store('kelompok_galeri', 'public');
                $galeriFiles[] = $path;
            }
        }

        $kd->update([
            'nama_kelompok' => $request->nama_kelompok,
            'target' => $request->target,
            'terkumpul' => $request->terkumpul ?? 0,
            'galeri' => $galeriFiles,
        ]);

        return redirect()->back()->with('success', 'Data Kelompok Donasi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kd = KelompokDonasi::findOrFail($id);

        // Hapus file galeri dari storage
        if ($kd->galeri) {
            foreach ($kd->galeri as $file) {
                Storage::disk('public')->delete($file);
            }
        }

        $kd->delete();

        return redirect()->back()->with('success', 'Data Kelompok Donasi berhasil dihapus');
    }
}

