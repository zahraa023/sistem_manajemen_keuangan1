<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Masjid</title>
  <!-- ICONS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="{{ asset('css/dash.css') }}" rel="stylesheet" />
  
  
<!-- LIBRARY CETAK PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<!-- HEADER -->
<div class="header">
  MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI
  <a href="/login" class="logout-button" title="Kembali ke landingpage">
    <i class="fas fa-arrow-left"></i>
  </a>
</div>

<!-- CONTAINER -->
<div class="container">
  <!-- SIDEBAR -->
  <div class="sidebar">
    <button class="active" onclick="showContent('dashben', event)">Dashboard</button>
    <button class="active" onclick="showContent('Zakat', event)">Zakat</button>
    <button onclick="toggleDropdown()">Laporan ⯆</button>
    <div id="dropdownMenu">
      <button onclick="showContent('ringkasankeuangan', event)">Ringkasan Keuangan</button>
      <button onclick="showContent('laporan', event)">Per Minggu</button>
      <button onclick="showContent('perbulan', event)">Per Bulan</button>
      <button onclick="showContent('rincian', event)">Rincian Transaksi</button>
      
    </div>
  </div>

  <!-- KONTEN UTAMA -->
  <div class="content" id="mainContent"></div>
</div>

<!-- SCRIPT -->
<script>
  const { jsPDF } = window.jspdf;

  function toggleDropdown() {
    const dropdown = document.getElementById("dropdownMenu");
    dropdown.style.display = dropdown.style.display === "flex" ? "none" : "flex";
  }
  function toggleForm(id) {
    const form = document.getElementById(id);
    form.style.display = "block";
  }

  // Fungsi hapusBaris
  function hapusBaris(button) {
    const row = button.closest('tr');
    if (row) row.remove();
  }

  // Fungsi umum: hapus baris
function hapusBaris(button) {
  const row = button.closest('tr');
  if (row) row.remove();
}

// Fungsi Ringkasan
function simpanRingkasan() {
  const saldoAwal = document.getElementById('saldoAwal');
  const pemasukan = document.getElementById('pemasukan');
  const pengeluaran = document.getElementById('pengeluaran');
  const tanggal = document.getElementById('tanggal');
  const saldoAkhir = document.getElementById('saldoAkhir');

  const t = document.getElementById('tableRingkasan').querySelector('tbody');

  t.innerHTML += `
    <tr>
      <td>${saldoAwal.value}</td>
      <td>${pemasukan.value}</td>
      <td>${pengeluaran.value}</td>
      <td>${tanggal.value}</td>
      <td>${saldoAkhir.value}</td>
      <td><button onclick="hapusBaris(this)">🗑️</button></td>
    </tr>
  `;

  // Sembunyikan form input
  document.getElementById('formRingkasan').style.display = 'none';

  // Bersihkan input
  saldoAwal.value = '';
  pemasukan.value = '';
  pengeluaran.value = '';
  tanggal.value = '';
  saldoAkhir.value = '';
}

// Fungsi Laporan
function simpanLaporan() {
  const ketLaporan = document.getElementById('ketLaporan');
  const pemasukanLaporan = document.getElementById('pemasukanLaporan');
  const pengeluaranLaporan = document.getElementById('pengeluaranLaporan');

  const t = document.getElementById('tableLaporan').querySelector('tbody');

  t.innerHTML += `
    <tr>
      <td>${ketLaporan.value}</td>
      <td>${mingguKe}</td>
      <td>${pemasukanLaporan.value}</td>
      <td>${pengeluaranLaporan.value}</td>
      <td><button onclick="hapusBaris(this)">🗑️</button></td>
    </tr>
  `;

  document.getElementById('formLaporan').style.display = 'none';

  ketLaporan.value = '';
  pemasukanLaporan.value = '';
  pengeluaranLaporan.value = '';
}

// Fungsi Perbulan
function simpanPerbulan() {
  const transaksiPerbulan = document.getElementById('transaksiPerbulan');
  const pemasukanPerbulan = document.getElementById('pemasukanPerbulan');
  const pengeluaranPerbulan = document.getElementById('pengeluaranPerbulan');
  const saldoPerbulan = document.getElementById('saldoPerbulan');

  const t = document.getElementById('tablePerbulan').querySelector('tbody');
  const no = t.rows.length + 1;

  t.innerHTML += `
    <tr>
      <td>${no}</td>
      <td>${transaksiPerbulan.value}</td>
      <td>${pemasukanPerbulan.value}</td>
      <td>${pengeluaranPerbulan.value}</td>
      <td>${saldoPerbulan.value}</td>
      <td><button onclick="hapusBaris(this)">🗑️</button></td>
    </tr>
  `;

  document.getElementById('formPerbulan').style.display = 'none';

  transaksiPerbulan.value = '';
  pemasukanPerbulan.value = '';
  pengeluaranPerbulan.value = '';
  saldoPerbulan.value = '';
}

// Fungsi Rincian
function simpanRincian() {
  const tglRincian = document.getElementById('tglRincian');
  const transaksiRincian = document.getElementById('transaksiRincian');
  const pemasukanRincian = document.getElementById('pemasukanRincian');
  const pengeluaranRincian = document.getElementById('pengeluaranRincian');

  const t = document.getElementById('tableRincian').querySelector('tbody');

  t.innerHTML += `
    <tr>
      <td>${tglRincian.value}</td>
      <td>${transaksiRincian.value}</td>
      <td>${pemasukanRincian.value}</td>
      <td>${pengeluaranRincian.value}</td>
      <td><button onclick="hapusBaris(this)">🗑️</button></td>
    </tr>
  `;

  document.getElementById('formRincian').style.display = 'none';

  tglRincian.value = '';
  transaksiRincian.value = '';
  pemasukanRincian.value = '';
  pengeluaranRincian.value = '';
}

  function cetakPDFByElementId(elementId, namaFile = "laporan.pdf") {
    const element = document.getElementById(elementId);
    if (!element) return alert("Elemen tidak ditemukan.");
    html2canvas(element).then((canvas) => {
      const imgData = canvas.toDataURL("image/png");
      const pdf = new jsPDF("p", "mm", "a4");
      const imgProps = pdf.getImageProperties(imgData);
      const pdfWidth = pdf.internal.pageSize.getWidth();
      const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
      pdf.addImage(imgData, "PNG", 0, 0, pdfWidth, pdfHeight);
      pdf.save(namaFile);
    });
  }

  function showContent(page, event = null) {
    const buttons = document.querySelectorAll('.sidebar button');
    buttons.forEach(btn => btn.classList.remove('active'));
    if (event) event.target.classList.add('active');

    const main = document.getElementById('mainContent');

    if (page === 'dashben') {
      main.innerHTML = `
        <h2>DASHBOARD BENDAHARA</h2>
        <div style="display:flex; gap:20px; margin-top:20px;">
          <div class="dashboard-card">
            <h3><i class="fa fa-hand-holding-heart" style="color:#4CAF50;"></i> Jumlah Donatur</h3>
            <p>15 Orang</p>
          </div>
        </div>
      `;
    }

    else if (page === 'ringkasankeuangan') {
    main.innerHTML = `
      <h2>Ringkasan Keuangan</h2>
      <button class="btn" onclick="toggleForm('formRingkasan')">+ Tambah Data</button>
      <button class="btn" onclick="cetakPDFByElementId('mainContent')">Cetak PDF</button>
      <table id="tableRingkasan">
        <thead><tr><th>Saldo Awal</th><th>Pemasukan</th><th>Pengeluaran</th><th>Tanggal</th><th>Saldo Akhir</th><th>Aksi</th></tr></thead>
        <tbody><tr><td>Rp 1.010.009.909.090</td><td>Rp 200.000</td><td>Rp 56.568</td><td>Kamis, 1 Mei 2025</td><td>-</td><td><button onclick="hapusBaris(this)">🗑️</button></td></tr></tbody>
      </table>
      <div id="formRingkasan" class="form-section">
        <input id="saldoAwal" placeholder="Saldo Awal">
        <input id="pemasukan" placeholder="Pemasukan">
        <input id="pengeluaran" placeholder="Pengeluaran">
        <input id="tanggal" placeholder="Tanggal">
        <input id="saldoAkhir" placeholder="Saldo Akhir">
        <button class="btn" onclick="simpanRingkasan()">Simpan</button>
      </div>`;
  }

  else if (page === 'laporan') {
  main.innerHTML = `
    <h2>Per Minggu</h2>
    <button class="btn" onclick="toggleForm('formLaporan')">+ Tambah Data</button>
    <button class="btn" onclick="cetakPDFByElementId('mainContent')">Cetak PDF</button>

    <!-- Tabel Data Default -->
    <table id="tableLaporan">
      <thead>
        <tr>
          <th>Keterangan</th>
          <th>Minggu ke</th>
          <th>Pemasukan</th>
          <th>Pengeluaran</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Kotak Infaq Hari Jumat</td>
          <td>5</td>
          <td>Rp 6.156.000</td>
          <td></td>
          <td><button onclick="hapusBaris(this)">🗑️</button></td>
        </tr>
        <tr>
          <td>Insentif Hari Jumat</td>
          <td>5</td>
          <td></td>
          <td>Rp 250.000</td>
          <td><button onclick="hapusBaris(this)">🗑️</button></td>
        </tr>
      </tbody>
    </table>

    <!-- Form Input Data -->
    <div id="formLaporan" class="form-section" style="display: none;">
      <input id="ketLaporan" placeholder="Keterangan">
      <input id="mingguKe" placeholder="Minggu ke ">
      <input id="pemasukanLaporan" placeholder="Pemasukan">
      <input id="pengeluaranLaporan" placeholder="Pengeluaran">
      <button class="btn" onclick="simpanLaporan()">Simpan</button>
    </div>

    <!-- Container Tambahan untuk Tabel-Tabel Dinamis -->
    <div id="tablesContainer"></div>
  `;
}



 else if (page === 'perbulan') {
  main.innerHTML = `
    <h2>Per Bulan</h2>
    <button class="btn" onclick="toggleForm('formPerbulan')">+ Tambah Transaksi</button>
    <button class="btn" onclick="cetakPDFByElementId('mainContent')">Cetak PDF</button>

    <table id="tablePerbulan">
      <thead>
        <tr>
          <th>#</th>
          <th>Transaksi</th>
          <th>Pemasukan</th>
          <th>Pengeluaran</th>
          <th>Saldo</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Saldo April</td>
          <td>Rp 6.156.000</td>
          <td>Rp 600.000</td>
          <td>Rp 101.248.468</td>
          <td><button onclick="hapusBaris(this)">🗑️</button></td>
        </tr>
      </tbody>
    </table>

    <!-- Form Input Data -->
    <div id="formPerbulan" class="form-section" style="display: none;">
      <input id="transaksiPerbulan" placeholder="Transaksi">
      <input id="pemasukanPerbulan" placeholder="Pemasukan">
      <input id="pengeluaranPerbulan" placeholder="Pengeluaran">
      <input id="saldoPerbulan" placeholder="Saldo">
      <button class="btn" onclick="simpanPerbulan()">Simpan</button>
    </div>
  `;
}


  else if (page === 'rincian') {
    main.innerHTML = `
      <h2>Rincian Transaksi</h2>
      <button class="btn" onclick="toggleForm('formRincian')">+ Tambah Rincian</button>
      <button class="btn" onclick="cetakPDFByElementId('mainContent')">Cetak PDF</button>
      <table id="tableRincian">
        <thead><tr><th>Tanggal</th><th>Transaksi</th><th>Pemasukan</th><th>Pengeluaran</th><th>Aksi</th></tr></thead>
        <tbody><tr><td>2025-05-02</td><td>Amplop Khotib</td><td></td><td>300.000</td><td><button onclick="hapusBaris(this)">🗑️</button></td></tr></tbody>
      </table>
      <div id="formRincian" class="form-section">
        <input id="tglRincian" type="date">
        <input id="transaksiRincian" placeholder="Transaksi">
        <input id="pemasukanRincian" placeholder="Pemasukan">
        <input id="pengeluaranRincian" placeholder="Pengeluaran">
        <button class="btn" onclick="simpanRincian()">Simpan</button>
      </div>`;
  }
}

  window.onload = () => showContent('dashben');
</script>
</body>
</html>
