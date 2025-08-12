{{-- resources/views/donatur.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Data Donatur</title>
  <link href="{{ asset('css/dash.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>

    <!-- Header -->
    <div class="header">
        <button class="back-button" onclick="window.location.href='/dashben'">
            <i class="fas fa-arrow-left"></i>
        </button>
        <div class="header-title">Data Donatur</div>
    </div>

    <!-- Container -->
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <button onclick="window.location.href='/donatur'">Donatur</button>
        </div>

        <div class="content">
            <h2>Daftar Donatur</h2>

            <table id="donaturTable" border="1" cellpadding="5" cellspacing="0" style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Metode</th>
                        <th>Bukti</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($donatur as $index => $d)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $d->nama }}</td>
                        <td>{{ $d->tanggal }}</td>
                        <td>Rp{{ number_format($d->jumlah, 0, ',', '.') }}</td>
                        <td>{{ $d->metode }}</td>
                        <td>
                            @if($d->bukti)
                                <a href="{{ asset('storage/' . $d->bukti) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $d->bukti) }}" alt="Bukti Donasi" style="width: 80px; height: auto; border-radius: 5px; box-shadow: 0 0 3px rgba(0,0,0,0.3);">
                                </a>
                            @else
                                Tidak Ada
                            @endif
                        </td>
                        <td>
                            @if($d->status === 'pending')
                                <span >Pending</span>
                            @elseif($d->status === 'selesai')
                                <span >Selesai</span>
                            @elseif($d->status === 'tolak')
                                <span >Tolak</span>
                            @else
                                {{ ucfirst($d->status) }}
                            @endif
                        </td>
                        <td>
                            @if ($d->status === 'pending')
                                <!-- Tombol Approve -->
                                <form action="{{ route('donatur.approve', $d->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" style="background-color:green; color:white; border:none; padding:5px 10px; border-radius:3px; margin-right:5px;">
                                        ✔ Approve
                                    </button>
                                </form>

                                <!-- Tombol Tolak -->
                                <form action="{{ route('donatur.reject', $d->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" style="background-color:orange; color:white; border:none; padding:5px 10px; border-radius:3px; margin-right:5px;">
                                        ✖ Tolak
                                    </button>
                                </form>
                            @endif

                            <!-- Tombol Hapus -->
                            <form action="{{ route('donatur.destroy', $d->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus donatur ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background-color:#e3342f; color:white; border:none; padding:5px 10px; border-radius:3px;">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">Belum ada donasi</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
