<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Donasi - Masjid Jami'</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/don.css') }}" rel="stylesheet">
</head>
<body>

<div class="header">MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI</div>

<div class="layout">
  <div class="sidebar">
    <button class="menu" onclick="window.location.href='/'">Home</button>
    <button class="menu" onclick="window.location.href='/jadwal'">Jadwal</button>
    <button class="menu" onclick="window.location.href='/laporan'">Data Keuangan</button>
    <button class="menu" onclick="window.location.href='/don'">Donasi</button>
  </div>

  <div class="main-content">
    <div class="don-hero" style="opacity: 0;">
      <h1>Mari berkontribusi dalam membangun dan memakmurkan Masjid Jami' Surau Gadang.</h1>
    </div>

    <div class="form-wrapper" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; margin-bottom: 30px;">
      <div class="donation-form" style="flex: 1; min-width: 300px; max-width: 500px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 5px rgba(0,0,0,0.1);">
        <h3 style="margin-bottom: 15px;">Form Donasi</h3>
        <form id="formDonasi" action="{{ route('don.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="text" name="nama" placeholder="Nama Donatur" required style="width: 100%; margin-bottom: 10px; padding: 8px;">
          <input type="date" name="tanggal" required style="width: 100%; margin-bottom: 10px; padding: 8px;">
          <input type="number" name="jumlah" placeholder="Jumlah Donasi (Rp)" required style="width: 100%; margin-bottom: 10px; padding: 8px;">

          <select name="metode" id="metode" onchange="toggleQR()" required style="width: 100%; margin-bottom: 10px; padding: 8px;">
            <option value="">-- Pilih Metode --</option>
            <option value="QR">QR</option>
            <option value="Cash">Cash</option>
          </select>

          <div id="qrDonasi" class="qr-box" style="display: none; opacity: 0;">
            <h3>Scan QR untuk Donasi</h3>
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=Donasi+Masjid+Jami" alt="QR Code">
            <p>Silakan scan menggunakan aplikasi e-wallet Anda</p>
          </div>

          <div style="margin-top: 10px;">
            <label>Upload Bukti Transfer</label>
            <input type="file" name="bukti" accept="image/*" required style="width: 100%; margin-top: 5px;">
          </div>

          <button type="submit" style="padding: 10px 20px; margin-top: 15px; background: #4CAF50; color: white; border: none; border-radius: 5px;">
            Kirim Donasi
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function toggleQR() {
    const metode = document.getElementById('metode').value;
    const qrBox = document.getElementById('qrDonasi');
    if (metode === 'QR') {
      qrBox.style.display = 'block';
      setTimeout(() => qrBox.style.opacity = 1, 100);
    } else {
      qrBox.style.opacity = 0;
      setTimeout(() => qrBox.style.display = 'none', 300);
    }
  }

  window.addEventListener('DOMContentLoaded', () => {
    const hero = document.querySelector('.don-hero');
    hero.style.transition = 'opacity 1s ease';
    setTimeout(() => {
      hero.style.opacity = 1;
    }, 200);
  });
</script>

</body>
</html>
