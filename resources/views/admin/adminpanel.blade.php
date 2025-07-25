<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin Masjid - Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/panel.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

  <div class="header">
    <button class="back-button" onclick="window.location.href='/dashboard'">
      <i class="fas fa-arrow-left"></i>
    </button>
    <h1>Admin Panel - Masjid Jami' (Surau Gadang)</h1>
  </div>

  <div class="layout">
    <div class="sidebar">
      <button onclick="showSection('profil')">Kelola Profil Masjid</button>
      <button onclick="showSection('jadwal')">Kelola Jadwal Kegiatan</button>
      <button onclick="showSection('donasi')">Kelola Donasi</button>
      <button onclick="showSection('landingpage')">Kelola Landingpage</button>
    </div>

    <div class="content">
      <!-- Profil -->
      <div id="profil" class="section">
        <h2>Profil Masjid</h2>
        <div class="form-group"><label>Nama Masjid</label><input type="text" placeholder="Masjid Jami' Surau Gadang"></div>
        <div class="form-group"><label>Deskripsi</label><textarea rows="5" placeholder="Tuliskan profil dan sejarah masjid..."></textarea></div>
        <div class="form-group"><label>Alamat</label><input type="text" placeholder="Canduang Koto Laweh, Agam, Sumatera Barat"></div>
        <button class="btn">Simpan Profil</button>
      </div>

      <!-- Jadwal -->
      <div id="jadwal" class="section">
        <h2>Jadwal Kegiatan Masjid</h2>
        <div class="form-group"><label>Nama Kegiatan</label><input type="text" placeholder="Contoh: Pengajian Akbar"></div>
        <div class="form-group"><label>Upload Poster/Foto</label><input type="file" accept="image/*"></div>
        <button class="btn">Simpan Jadwal</button>
      </div>

      <!-- Donasi -->
      <div id="donasi" class="section">
        <h2>Data Donasi</h2>
        <div class="form-group"><label>Nama Donatur</label><input type="text" id="donatur" placeholder="Contoh: Hamba Allah"></div>
        <div class="form-group"><label>Jumlah Donasi</label><input type="number" id="jumlah" placeholder="Contoh: 100000"></div>
        <div class="form-group"><label>Tanggal Donasi</label><input type="date" id="tanggal"></div>
        <div class="form-group">
          <label>Metode Donasi</label>
          <select id="metode">
            <option value="">-- Pilih Metode --</option>
            <option value="QR">QR</option>
            <option value="Cash">Cash</option>
          </select>
        </div>
        <button class="btn" onclick="simpanDonasi()">Simpan Donasi</button>

        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Donatur</th>
              <th>Tanggal</th>
              <th>Jumlah</th>
              <th>Metode</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="tabelDonatur"></tbody>
        </table>
      </div>

      <!-- Landingpage -->
      <div id="landingpage" class="section">
        <h2>Kelola Landingpage</h2>
        <div class="form-group"><label>Judul Hero Section</label><input type="text" placeholder="Masjid Jami' Surau Gadang"></div>
        <div class="form-group"><label>Deskripsi Hero Section</label><textarea rows="3" placeholder="Selamat Datang di Website Resmi Masjid Jami' Surau Gadang..."></textarea></div>
        <div class="form-group"><label>Gambar Utama</label><input type="file" accept="image/*"></div>

        <div class="form-group"><label>Judul Tentang</label><input type="text" placeholder="Tentang Masjid"></div>
        <div class="form-group"><label>Deskripsi Tentang</label><textarea rows="4" placeholder="Isi tentang sejarah, fungsi, dan keistimewaan masjid..."></textarea></div>

        <div class="form-group"><label>Judul Layanan</label><input type="text" placeholder="Layanan"></div>
        <div class="form-group"><label>Deskripsi Layanan</label><textarea rows="4" placeholder="Sebutkan layanan yang tersedia seperti donasi, jadwal shalat, dll."></textarea></div>

        <div class="form-group"><label>Kontak WhatsApp / Facebook</label><input type="text" placeholder="0812xxxxxx / Nama FB"></div>
        <button class="btn">Simpan Landingpage</button>
      </div>
    </div>
  </div>

  <script>
    function showSection(id) {
      document.querySelectorAll('.section').forEach(s => s.style.display = 'none');
      document.getElementById(id).style.display = 'block';
    }

    showSection('profil');

    function simpanDonasi() {
      const nama = document.getElementById('donatur').value;
      const jumlah = document.getElementById('jumlah').value;
      const tanggal = document.getElementById('tanggal').value;
      const metode = document.getElementById('metode').value;

      if (!nama || !jumlah || !tanggal || !metode) {
        alert("Semua data harus diisi!");
        return;
      }

      const tbody = document.getElementById("tabelDonatur");
      const rowCount = tbody.rows.length + 1;

      const row = document.createElement("tr");
      row.innerHTML = `
        <td>${rowCount}</td>
        <td>${nama}</td>
        <td>${tanggal}</td>
        <td>Rp${parseInt(jumlah).toLocaleString('id-ID')}</td>
        <td>${metode}</td>
        <td><button onclick="hapusBaris(this)" style="background-color:red; color:white; border:none; padding:5px 10px; border-radius:4px; cursor:pointer;">🗑️</button></td>
      `;
      tbody.appendChild(row);

      document.getElementById('donatur').value = '';
      document.getElementById('jumlah').value = '';
      document.getElementById('tanggal').value = '';
      document.getElementById('metode').value = '';
    }

    function hapusBaris(button) {
      const row = button.parentElement.parentElement;
      row.remove();
      updateNomorUrut();
    }

    function updateNomorUrut() {
      const rows = document.querySelectorAll("#tabelDonatur tr");
      rows.forEach((row, index) => {
        row.cells[0].textContent = index + 1;
      });
    }
  </script>

</body>
</html>
