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
      <button class="menu" onclick="window.location.href='/'">Home</button>
      <button class="menu" onclick="window.location.href='/jadwal'">Jadwal</button>
      <button class="menu" onclick="window.location.href='/laporan'">Data Keuangan</button>

      <div class="dropdown-wrapper">
        <button class="menu dropdown-toggle" onclick="toggleDropdown(event)">Donasi ⯆</button>
        <div id="dropdownMenu" class="dropdown-menu">
          <button class="submenu" onclick="window.location.href='/deskripsi'">Donasi Toilet</button>
          <button class="submenu" onclick="showContent('DonasiKarpet', event)">Donasi Karpet</button>
        </div>
        <button class="menu" onclick="window.location.href='/zakat'">Zakat</button>
      </div>
    </div>

    <div class="main-content">
      <div class="donasi-hero">
        <h1>Mari berkontribusi dalam membangun dan memakmurkan Masjid Jami' Surau Gadang.</h1>
      </div>

      <!-- Form Tambah Donasi -->
      <div style="display: flex; justify-content: center; margin-bottom: 30px;">
        <div style="width: 100%; max-width: 500px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 5px rgba(0,0,0,0.1);">
          <h3 style="margin-bottom: 15px;">Form Tambah Donasi</h3>
          <form id="formDonasi">
            <input type="text" id="nama" placeholder="Nama Donatur" required style="width: 100%; margin-bottom: 10px; padding: 8px;">
            <input type="date" id="tanggal" required style="width: 100%; margin-bottom: 10px; padding: 8px;">
            <input type="text" id="jumlah" placeholder="Jumlah Donasi (Rp)" required style="width: 100%; margin-bottom: 10px; padding: 8px;">
            
            <select name="metode" id="metode" onchange="toggleQR()" required style="width: 100%; margin-bottom: 10px; padding: 8px;">
              <option value="">-- Pilih Metode --</option>
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
            </button>
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
              <td id="totalDonasi">Rp100.000</td>
              <td></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>

  <!-- Script -->
  <script>
    function toggleDropdown(event) {
      event.stopPropagation();
      const menu = document.getElementById("dropdownMenu");
      menu.style.display = (menu.style.display === "block") ? "none" : "block";
    }

    function showContent(target, event) {
      event.stopPropagation();
      alert("Menampilkan konten: " + target);
    }

    window.addEventListener("click", function (e) {
      const menu = document.getElementById("dropdownMenu");
      const toggle = document.querySelector(".dropdown-toggle");
      if (!toggle.contains(e.target) && !menu.contains(e.target)) {
        menu.style.display = "none";
      }
    });

  
  function toggleQR() {
    const metode = document.getElementById("metode").value;
    const qrSection = document.getElementById("qrDonasi");
    const buktiTransfer = document.getElementById("buktiTransferContainer");

    if (metode === "QR") {
      qrSection.style.display = "block";
      qrSection.classList.add("show"); // tambahkan class show
      buktiTransfer.style.display = "block";
    } else {
      qrSection.style.display = "none";
      qrSection.classList.remove("show"); // hapus class show
      buktiTransfer.style.display = "none";
    }
  }


    document.getElementById('formDonasi').addEventListener('submit', function (e) {
      e.preventDefault();
      alert("Data donasi berhasil disimpan secara lokal.");
      this.reset();
      document.getElementById('qrDonasi').style.display = 'none';
      document.getElementById('buktiTransferContainer').style.display = 'none';
    });
  </script>

</body>
</html>
