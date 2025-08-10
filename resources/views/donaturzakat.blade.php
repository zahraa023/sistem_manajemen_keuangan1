{{-- resources/views/donaturzakat.blade.php --}}
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

      <h2>Daftar Zakat</h2>

      <table id="donaturTable">
        <thead>
          <tr>
            <th>#</th>
            <th>Muzakki</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Metode</th>
            <th>Bukti</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Updated At</th>
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
                    <img src="{{ asset('storage/' . $d->bukti) }}" alt="Bukti Zakat" style="width: 80px; border-radius: 4px;">
                  </a>
                @else
                  <em>Tidak Ada</em>
                @endif
              </td>
              <td>{{ ucfirst($d->status) }}</td>
              <td>{{ $d->created_at }}</td>
              <td>{{ $d->updated_at }}</td>
              <td>
                @if ($d->status === 'pending')
                  <form action="{{ route('donaturzakat.approve', $d->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn-approve">✔️ Approve</button>
                  </form>
                @endif

                <form action="{{ route('donaturzakat.destroy', $d->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data zakat ini?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-delete">🗑️ Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="10">Belum ada data zakat.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
