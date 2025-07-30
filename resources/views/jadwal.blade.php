<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="{{ asset('css/jadwal.css') }}" rel="stylesheet" />
</head>
<body>

  <!-- HEADER -->
  <div class="header">
    MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI
  </div>

  <!-- LAYOUT -->
  <div class="layout">
    <!-- SIDEBAR -->
    <div class="sidebar">
      <button class="menu" onclick="window.location.href='/welcome'">Home</button>
      <button class="menu" onclick="window.location.href='/jadwal'">Jadwal</button>
      <button class="menu" onclick="window.location.href='/laporan'">Data Keuangan</button>
      <button class="menu" onclick="window.location.href='/donasi'">Donasi</button>
      <button class="menu" onclick="window.location.href='/zakat'">Zakat</button>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
      <div id="tanggal-jam-realtime" style="font-weight: bold; margin-bottom: 10px;"></div>
      <h1>Jadwal Adzan Hari Ini (Agam)</h1>
      <div id="tanggal-shalat"></div>
      <div id="jadwal-shalat"></div>
    </div>
  </div>

  <!-- FOOTER -->
  <div class="footer">
    <div class="info">
      <p><i class="fas fa-map-marker-alt icon"></i> Canduang Koto Laweh, Kec. Candung, Kabupaten Agam, Sumatera Barat 26192</p>
      <p><i class="fas fa-phone icon"></i> 0812 6690 970</p>
      <p><i class="fab fa-facebook icon"></i> MuhammadIdrusRamli</p>
    </div>

    <div class="maps">
      <p>Lokasi MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI</p>
      <iframe src="https://www.google.com/maps?q=PF38%2BC3P%2C+Canduang+Koto+Laweh%2C+Kec.+Candung%2C+Kabupaten+Agam%2C+Sumatera+Barat+26192&output=embed" allowfullscreen loading="lazy"></iframe>
    </div>
  </div>

  <!-- SCRIPT -->
  <script>
    // Tampilkan tanggal dan jam real-time
    function updateTanggalWaktu() {
      const now = new Date();
      const hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
      const bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

      const namaHari = hari[now.getDay()];
      const tanggal = now.getDate();
      const namaBulan = bulan[now.getMonth()];
      const tahun = now.getFullYear();
      const jam = String(now.getHours()).padStart(2, '0');
      const menit = String(now.getMinutes()).padStart(2, '0');
      const detik = String(now.getSeconds()).padStart(2, '0');

      const teksTanggal = `${namaHari}, ${tanggal} ${namaBulan} ${tahun}`;
      const teksJam = `${jam}:${menit}:${detik}`;
      document.getElementById("tanggal-jam-realtime").innerText = `${teksTanggal} | ${teksJam}`;
    }

    updateTanggalWaktu();
    setInterval(updateTanggalWaktu, 1000);

    // Ambil jadwal shalat dari API
    async function loadJadwal() {
      try {
        const res = await fetch('/api/jadwal');
        const data = await res.json();

        if (!data.data) throw new Error("Data kosong");

        const jadwal = data.data;
        document.getElementById("tanggal-shalat").innerText = `Tanggal: ${jadwal.tanggal}`;

        const container = document.getElementById("jadwal-shalat");
        container.innerHTML = `
          <div class="jadwal-box"><div class="label">Imsak</div><div class="waktu">${jadwal.imsak}</div></div>
          <div class="jadwal-box"><div class="label">Subuh</div><div class="waktu">${jadwal.fajr}</div></div>
          <div class="jadwal-box"><div class="label">Dzuhur</div><div class="waktu">${jadwal.dhuhr}</div></div>
          <div class="jadwal-box"><div class="label">Ashar</div><div class="waktu">${jadwal.asr}</div></div>
          <div class="jadwal-box"><div class="label">Maghrib</div><div class="waktu">${jadwal.maghrib}</div></div>
          <div class="jadwal-box"><div class="label">Isya</div><div class="waktu">${jadwal.isha}</div></div>
        `;
      } catch (error) {
        document.getElementById("jadwal-shalat").innerText = "Gagal memuat data.";
        document.getElementById("tanggal-shalat").innerText = "";
        console.error("Terjadi kesalahan:", error);
      }
    }

    loadJadwal();
  </script>

</body>
</html>
