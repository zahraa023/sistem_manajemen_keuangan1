<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Landingpage Masjid</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/panel.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

  <div class="header">
    <button class="back-button" onclick="window.location.href='/dashboard'">
      <i class="fas fa-arrow-left"></i> 
    </button>
    <h1>Kelola Landingpage - Masjid Jami' (Surau Gadang)</h1>
  </div>

  <div class="layout">
    <div class="sidebar">
      <button onclick="showSection('landingpage')">Kelola Landingpage</button>
    </div>

    <div class="content">
      <!-- Landingpage -->
      <div id="landingpage" class="section">
        <h2>Kelola Landingpage</h2>

        <div class="form-group">
          <label>Judul Hero Section</label>
          <input type="text" placeholder="Masjid Jami' Surau Gadang">
        </div>

        <div class="form-group">
          <label>Deskripsi Hero Section</label>
          <textarea rows="3" placeholder="Selamat Datang di Website Resmi Masjid Jami' Surau Gadang..."></textarea>
        </div>

        <div class="form-group">
          <label>Gambar Utama</label>
          <input type="file" accept="image/*">
        </div>

        <div class="form-group">
          <label>Judul Tentang</label>
          <input type="text" placeholder="Tentang Masjid">
        </div>

        <div class="form-group">
          <label>Deskripsi Tentang</label>
          <textarea rows="4" placeholder="Isi tentang sejarah, fungsi, dan keistimewaan masjid..."></textarea>
        </div>

        <div class="form-group">
          <label>Judul Layanan</label>
          <input type="text" placeholder="Layanan">
        </div>

        <div class="form-group">
          <label>Deskripsi Layanan</label>
          <textarea rows="4" placeholder="Sebutkan layanan yang tersedia seperti donasi, jadwal shalat, dll."></textarea>
        </div>

        <div class="form-group">
          <label>Kontak WhatsApp / Facebook</label>
          <input type="text" placeholder="0812xxxxxx / Nama FB">
        </div>

        <button class="btn">Simpan Landingpage</button>
      </div>
    </div>
  </div>

  <script>
    function showSection(id) {
      document.querySelectorAll('.section').forEach(s => s.style.display = 'none');
      document.getElementById(id).style.display = 'block';
    }
    showSection('landingpage');
  </script>

</body>
</html>
