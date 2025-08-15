<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="{{ asset('css/donasi.css') }}" rel="stylesheet" />
</head>
<body>

  <div class="header">
    MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI
  </div>

  <div class="layout">
    <div class="sidebar">
      <button class="menu" onclick="window.location.href='/welcome'">Home</button>
      <button class="menu" onclick="window.location.href='/jadwal'">Jadwal</button>
      <button class="menu" onclick="window.location.href='/laporan'">Data Keuangan</button>
      <button class="menu" onclick="window.location.href='/donasi'">Donasi</button>
      <button class="menu" onclick="window.location.href='/zakat'">Zakat</button>
    </div>

    <div class="main-content">
      <div class="donasi-hero">
        <h1>Mari berkontribusi dalam membangun dan memakmurkan Masjid Jami' Surau Gadang.</h1>
      </div>

      <!-- Form Tambah Donasi -->
      <div style="display: flex; justify-content: center; margin-bottom: 30px;">
        <div style="width: 100%; max-width: 500px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 5px rgba(0,0,0,0.1);">
          <h3 style="margin-bottom: 15px;">Form Tambah Donasi</h3>

          @if(session('success'))
            <div style="color: green; margin-bottom: 10px;">{{ session('success') }}</div>
          @endif

          @if($errors->any())
            <div style="color: red; margin-bottom: 10px;">
              <ul>
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form id="formDonasi" action="{{ route('donasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="text" name="nama" placeholder="Nama Donatur" value="{{ old('nama') }}" required style="width: 100%; margin-bottom: 10px; padding: 8px;">
            
            <input type="date" name="tanggal" value="{{ old('tanggal') }}" required style="width: 100%; margin-bottom: 10px; padding: 8px;">
            
            <input 
              type="text" 
              name="jumlah" 
              id="jumlah" 
              placeholder="Jumlah Donasi (Rp)" 
              value="{{ old('jumlah') }}" 
              required 
              style="width: 100%; margin-bottom: 10px; padding: 8px;" 
              oninput="formatRupiah(this)"
            >

            <script>
              function formatRupiah(input) {
                let value = input.value.replace(/\D/g, '');
                if (value) {
                  input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                } else {
                  input.value = '';
                }
              }

              document.querySelector('form').addEventListener('submit', function(e) {
                const jumlah = document.getElementById('jumlah');
                jumlah.value = jumlah.value.replace(/\./g, '');
              });
            </script>

            <select name="metode" id="metode" onchange="toggleQR()" required style="width: 100%; margin-bottom: 10px; padding: 8px;">
              <option value="">-- Pilih Metode --</option>
              <option value="QR" {{ old('metode') == 'QR' ? 'selected' : '' }}>Qris</option>
            </select>

            <div id="qrDonasi" class="qr-box" style="opacity: {{ old('metode') == 'QR' ? '1' : '0' }}; max-height: {{ old('metode') == 'QR' ? '500px' : '0' }};">
              <h3>Scan Qris untuk Donasi</h3>
              <img src="{{ asset('asset/Qris.png') }}" alt="QR Code" width="200" height="200">
              <p>Silakan scan menggunakan aplikasi e-wallet Anda</p>
            </div>

            <div id="buktiTransferContainer" style="opacity: {{ old('metode') == 'QR' ? '1' : '0' }}; max-height: {{ old('metode') == 'QR' ? '200px' : '0' }}; overflow: hidden;">
              <label>Upload Bukti Transfer</label>
              <input type="file" name="bukti" id="buktiTransfer" accept="image/*" style="width: 100%; margin-top: 5px;">
            </div>

            <button type="submit" style="padding: 10px 20px; margin-top: 15px; background: #4CAF50; color: white; border: none; border-radius: 5px;">
              Kirim Donasi
            </button>
          </form>
        </div>
      </div>

      <!-- Tabel Donasi -->
      <div class="tabel-donatur">
        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Donatur</th>
              <th>Tanggal</th>
              <th>Jumlah Donasi</th>
              <th>Metode</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($donasis as $i => $donasi)
              <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $donasi->nama }}</td>
                <td>{{ \Carbon\Carbon::parse($donasi->tanggal)->format('d M Y') }}</td>
                <td>Rp{{ number_format($donasi->jumlah, 0, ',', '.') }}</td>
                <td>{{ $donasi->metode }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="5">Belum ada data donasi.</td>
              </tr>
            @endforelse
          </tbody>
          <tfoot>
            <tr style="background-color: #e0f7e0; font-weight: bold;">
              <td colspan="3" style="text-align: right;">Total Donasi</td>
              <td colspan="2">Rp{{ number_format(($donasis->sum('jumlah') ?? 0), 0, ',', '.') }}</td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>

  <script>
    function toggleQR() {
      const metode = document.getElementById("metode").value;
      const qrSection = document.getElementById("qrDonasi");
      const buktiTransfer = document.getElementById("buktiTransferContainer");

      if(metode === "QR") {
        qrSection.style.opacity = "1";
        qrSection.style.maxHeight = "500px";
        buktiTransfer.style.opacity = "1";
        buktiTransfer.style.maxHeight = "200px";
      } else {
        qrSection.style.opacity = "0";
        qrSection.style.maxHeight = "0";
        buktiTransfer.style.opacity = "0";
        buktiTransfer.style.maxHeight = "0";
      }
    }
// jalankan saat halaman pertama kali dimuat untuk menyesuaikan old('metode')
    window.addEventListener('DOMContentLoaded', (event) => {
      toggleQR();
    });
  </script>

</body>
</html>