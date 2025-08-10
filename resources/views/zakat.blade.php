<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link href="{{ asset('css/zakat.css') }}" rel="stylesheet" />
</head>
<body>

  <!-- HEADER -->
  <div class="header">
    <div class="header-left">
      <button class="back-button" onclick="window.location.href='{{ url('/welcome') }}'">
        <i class="fas fa-arrow-left"></i>
      </button>
    </div>
    <div class="header-center">
      <h1 class="masjid-title">MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI</h1>
    </div>
  </div>

  <section class="hero-section">
    <h1>Form Pembayaran Zakat</h1>
    <p>Bayarkan zakat Anda dengan mudah melalui sistem online Masjid Jami'.</p>
  </section>

  <section class="jenis-zakat fade-in">
    <h2><i class="fas fa-book-quran"></i> Jenis-Jenis Zakat</h2>
    <ul class="zakat-list">
      <li><strong>✨ Zakat Fitrah:</strong> Dikeluarkan saat Ramadan, sebelum Idul Fitri. Bentuknya beras 2,5 kg atau uang senilai.</li>
      <li><strong>💰 Zakat Mal:</strong> Dari harta (emas, tabungan, usaha) yang telah mencapai nisab dan haul (1 tahun). Besaran 2,5%.</li>
      <li><strong>🧾 Zakat Penghasilan:</strong> Dari gaji atau pendapatan rutin bulanan. Besaran 2,5% dari penghasilan bersih.</li>
    </ul>
  </section>

  <section class="form-container fade-in">
    <h3><i class="fas fa-hand-holding-heart"></i> Formulir Pembayaran Zakat</h3>

    @if ($errors->any())
      <div style="color:red; margin-bottom: 1rem;">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if(session('success'))
      <div style="color:green; margin-bottom: 1rem;">
        {{ session('success') }}
      </div>
    @endif

    <form id="formZakat" action="{{ route('donatur_zakat.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="text" id="nama" name="nama" placeholder="Nama Muzakki" value="{{ old('nama') }}" required>

      <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required
             style="width: 100%; margin-bottom: 10px; padding: 8px; font-family: inherit; border: 1px solid #ccc; border-radius: 4px; color: #555;">

      <!-- ubah type number jadi text untuk formatting -->
      <input type="text" id="jumlah" name="jumlah" placeholder="Jumlah Zakat (Rp)" value="{{ old('jumlah') }}" required>

      <select id="jenisZakat" name="jenis_zakat_id" required>
        <option value="">Pilih Jenis Zakat</option>
        @foreach($jenisZakats as $jenis)
          <option value="{{ $jenis->id }}" {{ old('jenis_zakat_id') == $jenis->id ? 'selected' : '' }}>
            {{ $jenis->nama }}
          </option>
        @endforeach
      </select>

      <select id="metodeZakat" name="metode" onchange="toggleQRZakat()" required>
        <option value="">Metode Pembayaran</option>
        <option value="QR" {{ old('metode') == 'QR' ? 'selected' : '' }}>QR (e-Wallet)</option>
      </select>

      <div id="qrZakat" class="qr-section" style="display: none; margin-top: 10px;">
        <h4>Scan QR untuk Membayar</h4>
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=Zakat+Masjid+Jami" alt="QR Zakat">
        <p>Gunakan aplikasi e-wallet Anda</p>
      </div>

      <div id="buktiZakatContainer" class="upload-section" style="display: none; margin-top: 10px;">
        <label for="buktiTransfer">📤 Upload Bukti Transfer</label>
        <input type="file" id="buktiTransfer" name="bukti" accept="image/*">
      </div>

      <button type="submit" style="margin-top: 15px;">
        <i class="fas fa-paper-plane"></i> Bayar Zakat Sekarang
      </button>
    </form>
  </section>

  <!-- Tabel Donatur -->
  <section class="tabel-donatur" style="margin-top: 30px;">
    <h3>Daftar Donatur Zakat</h3>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
      <thead>
        <tr style="background-color: #e0f7e0; font-weight: bold;">
          <th>No</th>
          <th>Nama Donatur</th>
          <th>Jumlah Zakat</th>
          <th>Jenis Zakat</th>
          <th>Metode</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($donaturs as $index => $donatur)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $donatur->nama }}</td>
            <td>Rp{{ number_format($donatur->jumlah, 0, ',', '.') }}</td>
            <td>{{ $donatur->jenisZakat->nama }}</td>
            <td>{{ $donatur->metode }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="5" style="text-align:center;">Belum ada data donatur zakat.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </section>

  <script>
    // Format input jumlah dengan titik sebagai pemisah ribuan saat ketik
    const jumlahInput = document.getElementById('jumlah');

    jumlahInput.addEventListener('input', function(e) {
      // Hapus karakter yang bukan angka
      let value = this.value.replace(/\D/g, '');
      // Format dengan titik setiap 3 digit
      value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
      this.value = value;
    });

    // Saat submit, hilangkan titik agar backend dapat angka bersih
    document.getElementById('formZakat').addEventListener('submit', function(e) {
      jumlahInput.value = jumlahInput.value.replace(/\./g, '');
    });

    // Fungsi toggle QR dan upload bukti
    function toggleQRZakat() {
      const metode = document.getElementById("metodeZakat").value;
      const qrDiv = document.getElementById("qrZakat");
      const buktiDiv = document.getElementById("buktiZakatContainer");

      if (metode === "QR") {
        qrDiv.style.display = "block";
        buktiDiv.style.display = "block";
      } else {
        qrDiv.style.display = "none";
        buktiDiv.style.display = "none";
      }
    }

    document.addEventListener("DOMContentLoaded", function() {
      toggleQRZakat();
    });
  </script>

</body>
</html>
