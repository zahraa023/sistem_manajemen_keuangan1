<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Donatur Zakat</title>
    <link href="{{ asset('css/donzak.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>

<div class="header">
    <button class="back-button" onclick="window.location.href='/dashben'">
        <i class="fas fa-arrow-left"></i>
    </button>
    <div class="header-title">Data Donatur</div>
</div>

<div class="container">
    <div class="sidebar">
        <button onclick="window.location.href='/donatur_zakat'">Donatur Zakat</button>
    </div>

    <div class="content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Donatur</th>
                    <th>Tanggal</th>
                    <th>Jenis Zakat</th>
                    <th>Jumlah</th>
                    <th>Metode</th>
                    <th>Bukti</th>
                    <th>Status</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($donaturs as $donatur)
                    <tr>
                        <td>{{ $donatur->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($donatur->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ $donatur->jenisZakat->nama ?? '-' }}</td>
                        <td>Rp {{ number_format($donatur->jumlah, 0, ',', '.') }}</td>
                        <td>{{ $donatur->metode }}</td>
                        <td>
                            @if($donatur->bukti)
                                <a href="{{ asset('storage/' . $donatur->bukti) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $donatur->bukti) }}" alt="Bukti" width="80" style="cursor: pointer;" />
                                </a>
                            @else
                                <span class="text-muted">Tidak ada</span>
                            @endif
                        </td>
                        <td>
                            @if($donatur->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($donatur->status == 'selesai')
                                <span class="badge bg-success">Selesai</span>
                            @elseif($donatur->status == 'ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>
                        <td>{{ $donatur->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $donatur->updated_at->format('d/m/Y H:i') }}</td>
                        <td>
                            @if($donatur->status == 'pending')
                                <a href="{{ route('donatur.approve', $donatur->id) }}" class="btn btn-tambah">Approve</a>
                                <a href="{{ route('donatur.reject', $donatur->id) }}" class="btn btn-tambah" style="background:#e74c3c; color:#fff;">Tolak</a>
                            @endif
                            <form action="{{ route('donatur.delete', $donatur->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="hapus-btn" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted">Belum ada data donatur zakat</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
