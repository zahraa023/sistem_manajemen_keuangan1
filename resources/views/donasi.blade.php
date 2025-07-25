<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/donasi.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

  <div class="header">
    MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI
  </div>

  <div class="layout">
    <div class="sidebar">
      <button class="menu" onclick="window.location.href='/'">Home</button>
      <button class="menu" onclick="window.location.href='/jadwal'">Jadwal</button>
      <button class="menu" onclick="window.location.href='/laporan'">Data Keuangan</button>
      <button class="menu" id="btnDonasi">Donasi</button>
    </div>

    <div class="main-content">

      <div class="donasi-hero">
        <h1>Mari berkontribusi dalam membangun dan memakmurkan Masjid Jami' Surau Gadang.</h1>
      </div>

      <!-- Container Donasi Form -->
<div style="display: flex; justify-content: center; margin-bottom: 30px;">
  <div style="width: 100%; max-width: 500px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 5px rgba(0,0,0,0.1);">
    <h3 style="margin-bottom: 15px;">Form Tambah Donasi</h3>
    <form id="formDonasi">
      <input type="text" id="nama" placeholder="Nama Donatur" required style="width: 100%; margin-bottom: 10px; padding: 8px;">
      <input type="date" id="tanggal" required style="width: 100%; margin-bottom: 10px; padding: 8px;">
      <input type="text" id="jumlah" placeholder="Jumlah Donasi (Rp)" required style="width: 100%; margin-bottom: 10px; padding: 8px;">
      
      <select name="metode" id="metode" onchange="toggleQR()" required style="width: 100%; margin-bottom: 10px; padding: 8px;">
  <option value="Pilih metode">-- Pilih Metode --</option>
  <option value="QR">QR</option>
  <option value="Cash">Cash</option>
</select>

<!-- QR Section -->
<div id="qrDonasi" class="qr-box" style="display: none;">
  <h3>Scan QR untuk Donasi</h3>
  <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=Donasi+Masjid+Jami" alt="QR Code">
  <p>Silakan scan menggunakan aplikasi e-wallet Anda</p>
</div>

<!-- Upload Bukti -->
<div id="buktiTransferContainer" style="display: none; margin-top: 10px;">
  <label>Upload Bukti Transfer</label>
  <input type="file" name="bukti" id="buktiTransfer" accept="image/*" style="width: 100%; margin-top: 5px;">
</div>


          <button type="submit" style="padding: 10px 20px; margin-top: 15px; background: #4CAF50; color: white; border: none; border-radius: 5px;">
            Kirim Donasi
    </form>
  </div>
</div>

<!-- Tabel Donatur -->
<div class="tabel-donatur">
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Donatur</th>
        <th>Tanggal</th>
        <th>Jumlah</th>
        <th>Metode</th>
      </tr>
    </thead>
    <tbody id="tabelDonatur">
      <tr>
        <td>1</td>
        <td>Ahmad Z</td>
        <td>10 Juli 2025</td>
        <td>Rp100.000</td>
        <td>QR</td>
      </tr>
      
    </tbody>
    <tfoot>
      <tr style="background-color: #e0f7e0; font-weight: bold;">
        <td colspan="3" style="text-align: right;">Total Donasi</td>
        <td id="totalDonasi">Rp10000</td>
        <td></td>
      </tr>
    </tfoot>
  </table>
</div>

<!-- Script Donasi -->
<script>
  // Fade-in animasi
  window.addEventListener('DOMContentLoaded', () => {
    const hero = document.querySelector('.donasi-hero');
    const qrBox = document.querySelector('.qr-box');

    setTimeout(() => {
      hero.style.transition = 'opacity 1s ease';
      hero.style.opacity = 1;
    }, 200);

    setTimeout(() => {
      qrBox.style.transition = 'opacity 1s ease';
      qrBox.style.opacity = 1;
    }, 600);
  });

  // Konfirmasi sebelum masuk halaman donasi
  document.getElementById('btnDonasi').addEventListener('click', function (e) {
    const confirmDonasi = confirm("Anda akan menuju halaman Donasi. Lanjutkan?");
    if (confirmDonasi) {
      window.location.href = '/donasi';
    }
  });

  // Simpan Donasi (tanpa tambah ke tabel, hanya notifikasi)
  document.getElementById('formDonasi').addEventListener('submit', function (e) {
    e.preventDefault();

    const nama = document.getElementById('nama').value;
    const tanggal = document.getElementById('tanggal').value;
    const jumlah = document.getElementById('jumlah').value;
    const metode = document.getElementById('metode').value;

    if (!nama || !tanggal || !jumlah || !metode) {
      alert('Mohon lengkapi semua data');
      return;
    }

    // Hanya tampilkan notifikasi, tidak masukkan ke tabel
    alert('Data donasi berhasil disimpan secara lokal (simulasi).');

    // Reset form
    document.getElementById('formDonasi').reset();
  });

  // Tampilkan QR dan upload bukti transfer jika pilih metode QR
  document.getElementById('metode').addEventListener('change', function () {
    const metode = this.value;
    const qrDonasi = document.getElementById('qrDonasi');
    const buktiContainer = document.getElementById('buktiTransferContainer');

    if (metode === 'QR') {
      qrDonasi.style.display = 'block';
      buktiContainer.style.display = 'block';
    } else {
      qrDonasi.style.display = 'none';
      buktiContainer.style.display = 'none';
    }
  });

</script>
</body>
</html>
