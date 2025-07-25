<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/jadwal.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

  <!-- ========== HEADER ========== -->
  <div class="header">
    MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI
  </div>

  <!-- ========== LAYOUT ========== -->
  <div class="layout">
    
  <!-- SIDEBAR -->
<div class="sidebar">
  <button class="menu" onclick="window.location.href='/'">Home</button>
  <button class="menu" onclick="window.location.href='/jadwal'">Jadwal</button>
  <button class="menu" onclick="window.location.href='/laporan'">Data Keuangan</button>
  <button class="menu" onclick="window.location.href='/donasi'">Donasi</button>
</div>


    <!-- ========== KONTEN UTAMA ========== -->
    <div class="main-content">
      <h2>Jadwal Adzan Harian Masjid Jami’</h2>
      <img src="{{ asset('asset/jadwal.png') }}" alt="Jadwal Shalat Masjid Jami’">
    </div>
  </div>

  <!-- ========== FOOTER ========== -->
  <div class="footer">
    <div class="info">
      <p><i class="fas fa-map-marker-alt icon"></i>Canduang Koto Laweh, Kec. Candung, Kabupaten Agam, Sumatera Barat 26192</p>
      <p><i class="fas fa-phone icon"></i>0812 6690 970</p>
      <p><i class="fab fa-facebook icon"></i>MuhammadIdrusRamli</p>
    </div>

    <div class="maps">
      <p>Lokasi MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI</p>
      <iframe
        src="https://www.google.com/maps?q=PF38%2BC3P%2C+Canduang+Koto+Laweh%2C+Kec.+Candung%2C+Kabupaten+Agam%2C+Sumatera+Barat+26192&output=embed"
        allowfullscreen="" loading="lazy">
      </iframe>
    </div>
  </div>

  <!-- ========== SCRIPT INTERAKSI ========== -->
  <script>
    // Tampilkan / sembunyikan submenu keuangan
    function toggleSubmenu() {
      const submenu = document.getElementById('submenu');
      submenu.style.display = submenu.style.display === 'flex' ? 'none' : 'flex';
    }
  </script>

</body>
</html>
