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

  <div class="header">Data Donatur</div>

  <!-- CONTAINER -->
  <div class="container" style="display:flex; height:calc(100vh - 50px);">
    <!-- SIDEBAR -->
    <div class="sidebar" style="background-color:#2f2f2f; width:200px; display:flex; flex-direction:column; padding-top:10px;">
      <button class="active" onclick="showContent('dashboard', event)">Dashboard Admin</button>
      <button onclick="window.location.href='/adminpanel'">Admin Panel</button>
      <button onclick="window.location.href='/donatur'">Donatur</button>
      <button onclick="showContent('kelompok donasi', event)">Kelompok Donasi</button>
    </div>

    <div class="content">
      <h2>Daftar Donatur</h2>

      <div class="filter-buttons">
        <button onclick="cetakPDFDonatur()">Cetak PDF</button>
      </div>

      <table id="donaturTable">
        <thead>
          <tr>
            <th>#</th>
            <th>Donatur</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Metode</th>
            <th>Bukti</th>
            <th>Status</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="bodyDonatur">
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
      <td>{{ ucfirst($d->status) }}</td>
      <td>{{ $d->created_at }}</td>
      <td>{{ $d->updated_at }}</td>
      <td>
        @if ($d->status === 'pending')
          <form action="{{ route('donatur.approve', $d->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('PUT')
            <button type="submit" class="approve-btn" style="background-color:green; color:white; border:none; padding:5px 10px; border-radius:3px; margin-right:5px;">
              ✔ Approve
            </button>
          </form>
        @endif

        <form action="{{ route('donatur.destroy', $d->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus donatur ini?');">
          @csrf
          @method('DELETE')
          <button type="submit" class="hapus-btn" style="background-color:#e3342f; color:white; border:none; padding:5px 10px; border-radius:3px;">
            🗑️ Hapus
          </button>
        </form>
      </td>
    </tr>
  @empty
    <tr>
      <td colspan="10">Belum ada donasi</td>
    </tr>
  @endforelse
</tbody>

  <!-- Script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script>
    function toggleFormDonatur() {
      const form = document.getElementById('formDonatur');
      form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
    }

    function hapusBaris(button) {
      if (confirm('Yakin ingin menghapus donatur ini?')) {
        const row = button.closest('tr');
        row.remove();
        // Kirim request DELETE ke server jika perlu
      }
    }

    function cetakPDFDonatur() {
      const element = document.getElementById('donaturTable');
      html2canvas(element).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        const pdf = new jspdf.jsPDF('p', 'mm', 'a4');
        const pdfWidth = pdf.internal.pageSize.getWidth();
        const pdfHeight = (canvas.height * pdfWidth) / canvas.width;
        pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
        pdf.save('donatur.pdf');
      });
    }
  </script>

</body>
</html>
