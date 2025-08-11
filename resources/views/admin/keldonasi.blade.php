<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelompok Donasi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/keldonasi.css') }}">
</head>
<body>

<!-- HEADER -->
<div class="header">
    <button class="back-button" onclick="window.location.href='/dashboard'">
        <i class="fas fa-arrow-left"></i>
    </button>
    Kelompok Donasi
</div>


<div class="container">
    <!-- SIDEBAR -->
    <div class="sidebar">
        <button onclick="window.location.href='{{ url('/keldonasi') }}'" class="active"> Kelompok Donasi</button>
        <!-- Tambah tombol lain di sini kalau perlu -->
    </div>

    <!-- CONTENT -->
    <div class="content">
        @if(session('success'))
            <div style="color: green; margin-bottom: 10px;">
                {{ session('success') }}
            </div>
        @endif

        <button class="btn" onclick="toggleForm('formTambahData')">+ Tambah Data</button>

        <!-- FORM TAMBAH -->
<form 
    id="formTambahData" 
    class="form-tambah hidden"
    action="{{ route('kelompok-donasi.store') }}" 
    method="POST" 
    enctype="multipart/form-data"
>
    @csrf
    <h3>Tambah Data Donasi</h3>

    <div class="form-group">
        <label>Judul Donasi</label>
        <input type="text" name="judul" required>
    </div>

    <div class="form-group">
        <label>Target (Rp)</label>
        <input type="number" name="target" required min="0">
    </div>

    <div class="form-group">
        <label>Terkumpul (Rp)</label>
        <input type="number" name="terkumpul" value="0" min="0">
    </div>

    <div class="form-group">
        <label>Galeri (gambar)</label>
        <input type="file" name="galeri[]" multiple accept="image/*">
    </div>

    <div class="form-action">
        <button type="submit" class="btn">Simpan</button>
        <button type="button" class="btn btn-danger" onclick="toggleForm('formTambahData')">Batal</button>
    </div>
</form>

        <!-- TABEL DATA -->
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul Donasi</th>
                    <th>Target</th>
                    <th>Terkumpul</th>
                    <th>Galeri</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($donasi as $index => $d)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $d->judul }}</td>
                        <td>Rp {{ number_format($d->target,0,',','.') }}</td>
                        <td>Rp {{ number_format($d->terkumpul,0,',','.') }}</td>
                        <td>
                            @if($d->galeri)
                                <div class="galeri-container">
                                    @foreach(json_decode($d->galeri) as $g)
                                        <img src="{{ asset('storage/'.$g) }}">
                                    @endforeach
                                </div>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn-edit" onclick="toggleForm('editForm{{ $d->id }}')">Edit</button>
                            <form action="{{ route('kelompok-donasi.destroy', $d->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-hapus">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- FORM EDIT -->
                    <tr id="editForm{{ $d->id }}" class="hidden">
    <td colspan="6">
        <form 
            action="{{ route('kelompok-donasi.update', $d->id) }}" 
            method="POST" 
            enctype="multipart/form-data"
            class="form-edit"
        >
            @csrf
            @method('PUT')
            <h3>Edit Donasi</h3>

            <div class="form-group">
                <label>Judul Donasi</label>
                <input type="text" name="judul" value="{{ $d->judul }}" required>
            </div>

            <div class="form-group">
                <label>Target (Rp)</label>
                <input type="number" name="target" value="{{ $d->target }}" required>
            </div>

            <div class="form-group">
                <label>Terkumpul (Rp)</label>
                <input type="number" name="terkumpul" value="{{ $d->terkumpul }}">
            </div>

            <div class="form-group">
                <label>Tambah Galeri Baru</label>
                <input type="file" name="galeri[]" multiple accept="image/*">
            </div>

            @if($d->galeri)
                <div class="galeri-container">
                    @foreach(json_decode($d->galeri) as $g)
                        <img src="{{ asset('storage/'.$g) }}">
                    @endforeach
                </div>
            @endif

            <div class="form-action">
                <button type="submit" class="btn">Simpan</button>
                <button type="button" class="btn btn-danger" onclick="toggleForm('editForm{{ $d->id }}')">Batal</button>
            </div>
        </form>
    </td>
</tr>

                @empty
                    <tr>
                        <td colspan="6" style="text-align:center;">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
function toggleForm(id) {
    const form = document.getElementById(id);
    form.classList.toggle('hidden');
}
</script>

</body>
</html>
