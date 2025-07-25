<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Masjid Jami' Surau Gadang</title>
  <link href="{{ asset('css/land.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

  <header>
    <h1>Masjid Jami' Surau Gadang</h1>
    <div class="top-login-buttons">
      <a href="/loginuser" class="btn">Login User</a>
      <a href="/login" class="btn">Login Admin</a>
    </div>
    <nav>
      <a href="#about">Tentang</a>
      <a href="#about">Layanan</a>
      <a href="#contact">Kontak</a>
    </nav>
  </header>

  <main>
  <div class="highlight-box">
    <h2>Selamat Datang di Website Resmi</h2>
    <p><strong>Masjid Jami' Surau Gadang</strong><br>
    Dikenal sebagai "Sidang Sebuah Balai", pusat ibadah, budaya, dan kebersamaan masyarakat Minangkabau.</p>
    <img src="{{ asset('asset/images.png') }}" alt="Masjid Jami' Surau Gadang" style="max-width:100%; border-radius:10px; margin-bottom:20px;">
  </div>

  <div id="about" class="section">
    <h2>Tentang Masjid</h2>
    <p>Merupakan masjid jami' yang dipakai sebagai pusat berkumpul jamaah, mengadopsi arsitektur tradisional Minangkabau dengan atap bertingkat dan nuansa lokal.</p>
  </div>

  <div id="about" class="section">
  <h2>Layanan</h2>
  <p><strong>Informasi Beranda (Home)</strong><br>
    Menyajikan sambutan dan informasi umum tentang Masjid Jami’ Surau Gadang.
  </p>
  <p><strong>Jadwal</strong><br>
    Menyediakan jadwal kegiatan ibadah, seperti waktu salat berjamaah dan jadwal.
  </p>
  <p><strong>Data Keuangan</strong><br>
    Menyajikan laporan keuangan masjid secara transparan, seperti pemasukan, pengeluaran, saldo, atau laporan bulanan.
  </p>
  <p><strong>Donasi</strong><br>
    Fitur bagi jamaah atau masyarakat yang ingin memberikan donasi secara online. Bisa terhubung ke metode pembayaran tertentu.
  </p>
</div>

  <div id="contact" class="section">
    <h2>Kontak & Lokasi</h2>
    <div class="info">
      <p><i class="fas fa-map-marker-alt icon"></i>Canduang Koto Laweh, Kec. Candung, Kabupaten Agam, Sumatera Barat 26192</p>
      <p><i class="fas fa-phone icon"></i>0812 6690 970</p>
      <p><i class="fab fa-facebook icon"></i>MuhammadIdrusRamli</p>
    </div>
      <a href="https://www.google.com/maps?q=PF38%2BC3P%2C+Canduang+Koto+Laweh%2C+Kec.+Candung%2C+Kabupaten+Agam%2C+Sumatera+Barat+26192&output=embed" class="btn" target="_blank">Lihat di Maps</a>
    </div>
  </main>

  <footer>
    <p>© 2025 Masjid Jami' Surau Gadang - Sidang Sebuah Balai</p>
  </footer>

  <script>
    // Scroll smooth
    document.querySelectorAll('a[href^="#"]').forEach(a => {
      a.addEventListener('click', e => {
        e.preventDefault();
        document.querySelector(a.getAttribute('href'))
          .scrollIntoView({ behavior: 'smooth' });
      });
    });
  </script>

</body>
</html>
