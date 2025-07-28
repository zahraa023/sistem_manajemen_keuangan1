<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/datalap.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

  <!-- HEADER -->
  <div class="header">
    MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI
  </div>

<!-- TOMBOL BACK BULAT -->
<div class="circle-back-wrapper">
  <a href="/" class="circle-back-button" title="Kembali ke Beranda">
    <i class="fas fa-arrow-left"></i>
  </a>
</div>

  <!-- KONTEN UTAMA -->
  <div class="container">
    <!-- JUDUL -->
    <div class="page-title">LAPORAN KEUANGAN</div>

    <!-- KARTU -->
    <div class="summary-cards">
      <div class="card green">
        <h4>Saldo </h4>
        <small>Kamis, 1 Mei 2025</small>
        <div class="amount">Rp 101,25 jt</div>
        <div class="card-icon"><i class="fas fa-wallet"></i></div>
      </div>
      <div class="card green">
        <h4>Pemasukan</h4>
        <small>Sabtu, 31 Mei 2025</small>
        <div class="amount">Rp 24,64 jt</div>
        <div class="card-icon"><i class="fas fa-arrow-left"></i></div>
      </div>
      <div class="card red">
        <h4>Pengeluaran</h4>
        <small>Sabtu, 31 Mei 2025</small>
        <div class="amount">Rp 48,04 jt</div>
        <div class="card-icon"><i class="fas fa-arrow-up-right-from-square"></i></div>
      </div>
      <div class="card blue">
        <h4>Saldo Akhir</h4>
        <small>Sabtu, 31 Mei 2025</small>
        <div class="amount">Rp 77,85 jt</div>
        <div class="card-icon"><i class="fas fa-wallet"></i></div>
      </div>
    </div>
<!-- === FORM FILTER BULAN === -->
<div style="margin-bottom: 20px; text-align: left; padding-left: 40px;">
  <label for="bulanFilter" style="font-weight: bold; margin-right: 10px;">Pilih Bulan</label>
  <select id="bulanFilter" onchange="filterBulan()" style="padding: 8px 12px; border-radius: 6px; border: 1px solid #ccc;">
    <option value="2025-05" selected>Mei 2025</option>
    <option value="2025-04">April 2025</option>
  </select>
</div>

<!-- TOMBOL -->
<div class="filter-buttons">
  <button onclick="tampilkanKonten('mingguan')" id="btn-mingguan" class="active-tab">
    <i class="fas fa-file-alt"></i> PER MINGGU
  </button>
  <button onclick="tampilkanKonten('bulanan')" id="btn-bulanan">
    <i class="fas fa-calendar-alt"></i> PER BULAN
  </button>
  <button onclick="tampilkanKonten('rincian')" id="btn-rincian">
    <i class="fas fa-info-circle"></i> RINCIAN TRANSAKSI
  </button>
</div>

<!-- KONTEN MINGGUAN -->
<div class="konten" id="mingguan">
  <div class="transactions">
    <!-- Mei -->
    <h4 data-bulan="2025-05"><span class="week">Minggu 1</span> (1 - 7 Mei 2025)</h4>
    <table class="transaction-table" data-bulan="2025-05">
      <thead>
        <tr><th>Transaksi</th><th>Pemasukan</th><th>Pengeluaran</th><th>Saldo</th></tr>
      </thead>
      <tbody>
        <tr><td>Tanpa Kategori</td><td class="amount-green">Rp 6.156.000</td><td></td><td></td></tr>
        <tr><td>Tagihan Listrik</td><td></td><td class="amount-red">Rp 290.000</td><td></td></tr>
        <tr class="saldo-row"><td colspan="3"><strong>Saldo Akhir</strong></td><td class="amount-bold">Rp 5.866.000</td></tr>
      </tbody>
    </table>

    <!-- April -->
    <h4 data-bulan="2025-04"><span class="week">Minggu 1</span> (1 - 7 April 2025)</h4>
    <table class="transaction-table" data-bulan="2025-04">
      <thead>
        <tr><th>Transaksi</th><th>Pemasukan</th><th>Pengeluaran</th><th>Saldo</th></tr>
      </thead>
      <tbody>
        <tr><td>Donasi Umum</td><td class="amount-green">Rp 2.000.000</td><td></td><td></td></tr>
        <tr><td>Biaya Kebersihan</td><td></td><td class="amount-red">Rp 500.000</td><td></td></tr>
        <tr class="saldo-row"><td colspan="3"><strong>Saldo Akhir</strong></td><td class="amount-bold">Rp 1.500.000</td></tr>
      </tbody>
    </table>
  </div>
</div>

<!-- KONTEN PER BULAN -->
<div class="konten" id="bulanan" style="display: none;">
  <div class="transactions">
    <!-- Mei -->
    <div data-bulan="2025-05">
      <h4 class="mb-3">Laporan Bulanan: Mei 2025</h4>
      <table class="transaction-table">
        <thead>
          <tr><th>#</th><th>TRANSAKSI</th><th>PEMASUKAN</th><th>PENGELUARAN</th><th>SALDO</th></tr>
        </thead>
        <tbody>
          <tr><td colspan="5" class="text-start fw-bold">Saldo</td></tr>
          <tr><td>1</td><td>Sisa saldo per 30 Mei 2025</td><td></td><td></td><td class="amount-bold">101.248.468</td></tr>
          <tr><td colspan="5" class="text-start fw-bold">Pemasukan</td></tr>
          <tr><td>1</td><td>Kotak Infaq Hari Jumat</td><td class="amount-bold">11.374.004</td><td>-</td><td></td></tr>
          <tr><td colspan="5" class="text-start fw-bold">Pengeluaran</td></tr>
          <tr><td>1</td><td>Insentif Hari Jumat</td><td>-</td><td class="amount-bold">1.550.000</td><td></td></tr>
          <tr class="saldo-row">
            <td colspan="2" class="text-end fw-bold">Pemasukan/Pengeluaran hingga 31 Mei 2025</td>
            <td class="amount-bold">24.640.454</td><td class="amount-bold">48.041.000</td><td class="amount-red">- 23.400.546</td>
          </tr>
          <tr class="saldo-row">
            <td colspan="4" class="text-end fw-bold">Total saldo akhir per 31 Mei 2025</td>
            <td class="amount-bold">77.847.922</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- April -->
    <div data-bulan="2025-04">
      <h4 class="mb-3">Laporan Bulanan: April 2025</h4>
      <table class="transaction-table">
        <thead>
          <tr><th>#</th><th>TRANSAKSI</th><th>PEMASUKAN</th><th>PENGELUARAN</th><th>SALDO</th></tr>
        </thead>
        <tbody>
          <tr><td colspan="5" class="text-start fw-bold">Saldo</td></tr>
          <tr><td>1</td><td>Sisa saldo per 30 April 2025</td><td></td><td></td><td class="amount-bold">50.000.000</td></tr>
          <tr><td colspan="5" class="text-start fw-bold">Pemasukan</td></tr>
          <tr><td>1</td><td>Donasi Ramadan</td><td class="amount-bold">15.000.000</td><td>-</td><td></td></tr>
          <tr><td colspan="5" class="text-start fw-bold">Pengeluaran</td></tr>
          <tr><td>1</td><td>Pembelian Sembako</td><td>-</td><td class="amount-bold">5.000.000</td><td></td></tr>
          <tr class="saldo-row">
            <td colspan="2" class="text-end fw-bold">Pemasukan/Pengeluaran hingga 30 April 2025</td>
            <td class="amount-bold">15.000.000</td><td class="amount-bold">5.000.000</td><td class="amount-green">10.000.000</td>
          </tr>
          <tr class="saldo-row">
            <td colspan="4" class="text-end fw-bold">Total saldo akhir per 30 April 2025</td>
            <td class="amount-bold">60.000.000</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>


<!-- KONTEN RINCIAN -->
<div class="konten" id="rincian" style="display: none;">
  <div class="transactions">
    <!-- PEKAN 1 -->
    <div data-bulan="2025-05">
      <h4>Pekan 1 (01 - 04 Mei 2025)</h4>
      <table class="transaction-table">
        <thead>
          <tr>
            <th>TANGGAL</th>
            <th>TRANSAKSI</th>
            <th>PEMASUKAN</th>
            <th>PENGELUARAN</th>
            <th>SALDO</th>
          </tr>
        </thead>
        <tbody>
          <tr><td colspan="4"><strong>Sisa saldo per 30 April 2025</strong></td><td class="amount-green">101.248.468</td></tr>
          
          <!-- Hari JUMAT -->
          <tr><td colspan="5"><strong>JUMAT</strong></td></tr>
          <tr><td>2025-05-02</td><td>AMPLOP KHOTIB</td><td></td><td class="amount-red">300.000</td><td></td></tr>
          <tr><td>2025-05-02</td><td>KOTAK AMAL JUMAT 1</td><td class="amount-green">2.180.004</td><td></td><td></td></tr>
          
          <!-- Hari AHAD -->
          <tr><td colspan="5"><strong>AHAD</strong></td></tr>
          <tr><td>2025-05-04</td><td>SAWIT WAKAF 01</td><td class="amount-green">5.517.000</td><td></td><td></td></tr>
          <tr><td>2025-05-04</td><td>SAWIT WAKAF 02</td><td class="amount-green">2.823.450</td><td></td><td></td></tr>
          
          <!-- Rekap Pekan 1 -->
          <tr><td colspan="2"><strong>Pemasukan/Pengeluaran Pekan 1</strong></td><td class="amount-green">10.520.454</td><td class="amount-red">300.000</td><td class="amount-green">10.220.454</td></tr>
          <tr><td colspan="4"><strong>Saldo Akhir Pekan 1</strong></td><td class="amount-green">111.468.922</td></tr>
        </tbody>
      </table>
    </div>

    <!-- PEKAN 2 -->
    <div data-bulan="2025-05">
      <h4>Pekan 2 (05 - 11 Mei 2025)</h4>
      <table class="transaction-table">
        <thead>
          <tr>
            <th>TANGGAL</th>
            <th>TRANSAKSI</th>
            <th>PEMASUKAN</th>
            <th>PENGELUARAN</th>
            <th>SALDO</th>
          </tr>
        </thead>
        <tbody>
          <tr><td colspan="4"><strong>Sisa saldo per 4 Mei 2025</strong></td><td class="amount-green">111.468.922</td></tr>
          
          <!-- Hari SENIN -->
          <tr><td colspan="5"><strong>SENIN</strong></td></tr>
          <tr><td>2025-05-05</td><td>PEMBANGUNAN TAMAN DAN HALAMAN MASJID</td><td></td><td class="amount-red">10.000.000</td><td></td></tr>
          
          <!-- Hari JUMAT -->
          <tr><td colspan="5"><strong>JUMAT</strong></td></tr>
          <tr><td>2025-05-09</td><td>Kebersihan</td><td></td><td class="amount-red">2.000.000</td><td></td></tr>
          <tr><td>2025-05-09</td><td>AMPLOP KHOTIB</td><td></td><td class="amount-red">350.000</td><td></td></tr>
          
          <!-- Hari SABTU -->
          <tr><td colspan="5"><strong>SABTU</strong></td></tr>
          <tr><td>2025-05-10</td><td>BAYAR LISTRIK</td><td class="amount-green">2.422.000</td><td></td><td></td></tr>
          
          <!-- Rekap Pekan 2 -->
          <tr><td colspan="2"><strong>Pemasukan/Pengeluaran Pekan 2</strong></td><td class="amount-green">3.276.000</td><td class="amount-red">28.903.000</td><td class="amount-red">-25.627.000</td></tr>
          <tr><td colspan="4"><strong>Saldo Akhir Pekan 2</strong></td><td class="amount-green">85.841.922</td></tr>
        </tbody>
      </table>
    </div>
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


 <!-- SCRIPT TOMBOL + FILTER BULAN -->
<script>
  function tampilkanKonten(id) {
    const semuaKonten = document.querySelectorAll('.konten');
    semuaKonten.forEach(konten => konten.style.display = 'none');

    const kontenAktif = document.getElementById(id);
    if (kontenAktif) kontenAktif.style.display = 'block';

    const semuaTombol = document.querySelectorAll('.filter-buttons button');
    semuaTombol.forEach(btn => btn.classList.remove('active-tab'));
    const tombolAktif = document.getElementById('btn-' + id);
    if (tombolAktif) tombolAktif.classList.add('active-tab');

    filterBulan();
  }

  function filterBulan() {
    const bulanDipilih = document.getElementById('bulanFilter').value;
    document.querySelectorAll('[data-bulan]').forEach(el => {
      el.style.display = (el.getAttribute('data-bulan') === bulanDipilih) ? '' : 'none';
    });
  }

  document.addEventListener('DOMContentLoaded', () => {
    tampilkanKonten('mingguan');
    filterBulan();
  });
</script>
</body>
</html>
