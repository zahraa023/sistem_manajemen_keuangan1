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

      <select id="jenisZakat" name="jenis_zakat_id" required onchange="hitungZakat()">
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
        <img src="{{ asset('asset/Qris.png') }}" alt="QR Code" width="200" height="200">
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
<section class="tabel-donatur">
  <h3>Daftar Donatur Zakat</h3>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Donatur</th>
        <th>Jumlah Zakat</th>
        <th>Jenis Zakat</th>
        <th>Metode</th>
        <th>Status</th> <!-- ✅ Tambahan kolom status -->
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
          <td>
            @if($donatur->status == 'selesai')
              <span style="color: green; font-weight: bold;">Selesai</span>
            @elseif($donatur->status == 'ditolak')
              <span style="color: red; font-weight: bold;">Ditolak</span>
            @else
              <span style="color: orange;">Pending</span>
            @endif
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6">Belum ada data donatur zakat.</td>
        </tr>
      @endforelse
    </tbody>
    @if ($donaturs->count() > 0)
      <tfoot>
        <tr>
          <td colspan="4" class="total-label">Total Donasi</td>
          <td colspan="2" class="total-amount">
            Rp{{ number_format($donaturs->where('status','selesai')->sum('jumlah'), 0, ',', '.') }}
          </td>
        </tr>
      </tfoot>
    @endif
  </table>
</section>

<script>
  // Format input jumlah
  const jumlahInput = document.getElementById('jumlah');
  const jenisZakatSelect = document.getElementById('jenisZakat');

  jumlahInput.addEventListener('input', function(e) {
    let value = this.value.replace(/\D/g, '');
    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    this.value = value;
  });

  document.getElementById('formZakat').addEventListener('submit', function(e) {
    jumlahInput.value = jumlahInput.value.replace(/\./g, '');
  });

  function hitungZakat() {
    const jenis = jenisZakatSelect.options[jenisZakatSelect.selectedIndex].text;
    let jumlah = 0;

    if (jenis.includes("Fitrah")) {
      jumlah = 40000;
    } 
    else if (jenis.includes("Mal") || jenis.includes("Penghasilan")) {
      let penghasilan = prompt("Masukkan total harta/penghasilan (Rp):", "0");
      penghasilan = penghasilan.replace(/\D/g, '') || 0;
      jumlah = penghasilan * 0.025;
    }

    if (jumlah > 0) {
      jumlahInput.value = Math.round(jumlah).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }
  }

  const tanggalInput = document.getElementById("tanggal");
  const today = new Date().toISOString().split("T")[0];
  tanggalInput.setAttribute("max", today);

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
