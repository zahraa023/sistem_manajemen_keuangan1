<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Admin - LAPORAN KEUANGAN MASJID JAMI'</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <style>
    body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f5f5f5; }
    .header {
      background-color: #005f73;
      color: white;
      font-weight: bold;
      padding: 20px;
      font-size: 20px;
      text-align: center;
      user-select: none;
    }
    .circle-back-wrapper {
      position: fixed;
      top: 20px;
      left: 20px;
      z-index: 100;
    }
    .circle-back-button {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 38px;
      height: 38px;
      border-radius: 50%;
      background: #0a9396;
      color: white;
      text-decoration: none;
      font-size: 18px;
      box-shadow: 0 0 5px #00000055;
    }
    .container {
      max-width: 1100px;
      margin: 90px auto 50px;
      background: white;
      padding: 25px 30px 40px;
      border-radius: 10px;
      box-shadow: 0 0 15px #00000022;
    }
    .page-title {
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 25px;
      color: #0a9396;
      text-align: center;
    }
    .summary-cards {
      display: flex;
      gap: 18px;
      margin-bottom: 25px;
      flex-wrap: wrap;
      justify-content: center;
    }
    .card {
      flex: 1 1 200px;
      min-width: 220px;
      background: #e0f2f1;
      border-radius: 10px;
      padding: 18px 25px;
      position: relative;
      box-shadow: 0 2px 6px #00000022;
      color: #004d40;
      user-select: none;
    }
    .card h4 {
      margin: 0 0 6px;
    }
    .card small {
      font-size: 12px;
      color: #004d4088;
    }
    .amount {
      font-size: 22px;
      font-weight: 700;
      margin-top: 10px;
    }
    .card-icon {
      position: absolute;
      top: 20px;
      right: 20px;
      font-size: 26px;
      opacity: 0.25;
    }
    .card.green { background: #b2dfdb; color: #004d40; }
    .card.red { background: #ef9a9a; color: #b71c1c; }
    .card.blue { background: #90caf9; color: #0d47a1; }

    /* Form input untuk summary cards */
    .card form {
      display: flex;
      flex-direction: column;
      gap: 6px;
      margin-top: 10px;
    }
    .card form input[type="text"],
    .card form input[type="date"],
    .card form input[type="number"] {
      padding: 6px 8px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 14px;
    }
    .card form button {
      margin-top: 6px;
      padding: 6px 12px;
      background-color: #00796b;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: 700;
      transition: background-color 0.3s ease;
    }
    .card form button:hover {
      background-color: #004d40;
    }

    /* Filter bulan */
    #bulanFilter {
      padding: 8px 12px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 16px;
    }
    .filter-buttons {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
      justify-content: center;
    }
    .filter-buttons button {
      padding: 10px 20px;
      border: none;
      background-color: #ccc;
      color: #222;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 6px;
      user-select: none;
      transition: background-color 0.3s ease;
    }
    .filter-buttons button.active-tab {
      background-color: #0a9396;
      color: white;
    }
    .filter-buttons button:hover:not(.active-tab) {
      background-color: #79b9b8;
      color: white;
    }

    /* Konten laporan */
    .konten {
      margin-top: 20px;
    }
    h4.week, h4 {
      margin-bottom: 6px;
      color: #0a9396;
    }
    table.transaction-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 30px;
      font-size: 14px;
    }
    table.transaction-table th,
    table.transaction-table td {
      border: 1px solid #ddd;
      padding: 8px 12px;
      text-align: center;
    }
    table.transaction-table th {
      background-color: #0a9396;
      color: white;
      user-select: none;
    }
    .amount-green {
      color: #2e7d32;
      font-weight: 700;
    }
    .amount-red {
      color: #c62828;
      font-weight: 700;
    }
    .amount-bold {
      font-weight: 700;
    }
    .saldo-row td {
      background-color: #f1f8e9;
      font-weight: 700;
    }
    .text-start {
      text-align: left !important;
      padding-left: 12px;
    }
    .text-end {
      text-align: right !important;
      padding-right: 12px;
    }
    .fw-bold {
      font-weight: 700;
    }

    /* Form transaksi */
    .transaction-form {
      margin-bottom: 20px;
      background: #e0f7fa;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 0 5px #00000022;
      max-width: 600px;
    }
    .transaction-form h5 {
      margin-top: 0;
      margin-bottom: 12px;
      color: #00796b;
    }
    .transaction-form label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
    }
    .transaction-form input[type="text"],
    .transaction-form input[type="date"],
    .transaction-form input[type="number"],
    .transaction-form select {
      width: 100%;
      padding: 6px 8px;
      margin-bottom: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
    }
    .transaction-form button {
      background-color: #00796b;
      color: white;
      border: none;
      padding: 8px 14px;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 700;
      transition: background-color 0.3s ease;
    }
    .transaction-form button:hover {
      background-color: #004d40;
    }
    .error-message {
      color: #b71c1c;
      font-weight: 600;
      margin-bottom: 10px;
    }

    /* Footer */
    .footer {
      margin-top: 40px;
      background-color: #0a9396;
      color: white;
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      padding: 20px 40px;
      border-radius: 10px 10px 0 0;
      user-select: none;
    }
    .footer .info p,
    .footer .maps p {
      margin: 6px 0;
      font-size: 14px;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .footer .icon {
      font-size: 18px;
    }
    .footer .maps iframe {
      border: none;
      border-radius: 8px;
      width: 300px;
      height: 180px;
    }
    @media (max-width: 768px) {
      .summary-cards {
        flex-direction: column;
        align-items: center;
      }
      .footer {
        flex-direction: column;
        align-items: center;
        gap: 20px;
      }
    }
  </style>
</head>
<body>

  <!-- HEADER -->
  <div class="header">MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI - ADMIN LAPORAN KEUANGAN</div>

  <!-- TOMBOL BACK -->
  <div class="circle-back-wrapper">
    <a href="/welcome" class="circle-back-button" title="Kembali ke Beranda">
      <i class="fas fa-arrow-left"></i>
    </a>
  </div>

  <div class="container">
    <div class="page-title">LAPORAN KEUANGAN</div>

    <!-- Summary Cards dengan Form Input -->
    <div class="summary-cards">

      <div class="card green">
        <h4>Saldo</h4>
        <small><span id="saldo-date-display">2025-05-01</span></small>
        <div class="amount" id="saldo-amount-display">Rp 101,25 jt</div>

        <form id="formSaldo">
          <label for="saldoDate">Tanggal</label>
          <input type="date" id="saldoDate" value="2025-05-01" required />

          <label for="saldoAmount">Jumlah (Rp)</label>
          <input type="number" id="saldoAmount" min="0" step="1000" value="101250000" required />

          <button type="submit">Simpan Saldo</button>
        </form>

        <div class="card-icon"><i class="fas fa-wallet"></i></div>
      </div>

      <div class="card green">
        <h4>Pemasukan</h4>
        <small><span id="pemasukan-date-display">2025-05-31</span></small>
        <div class="amount" id="pemasukan-amount-display">Rp 24,64 jt</div>

        <form id="formPemasukan">
          <label for="pemasukanDate">Tanggal</label>
          <input type="date" id="pemasukanDate" value="2025-05-31" required />

          <label for="pemasukanAmount">Jumlah (Rp)</label>
          <input type="number" id="pemasukanAmount" min="0" step="1000" value="24640000" required />

          <button type="submit">Simpan Pemasukan</button>
        </form>

        <div class="card-icon"><i class="fas fa-arrow-left"></i></div>
      </div>

      <div class="card red">
        <h4>Pengeluaran</h4>
        <small><span id="pengeluaran-date-display">2025-05-31</span></small>
        <div class="amount" id="pengeluaran-amount-display">Rp 48,04 jt</div>

        <form id="formPengeluaran">
          <label for="pengeluaranDate">Tanggal</label>
          <input type="date" id="pengeluaranDate" value="2025-05-31" required />

          <label for="pengeluaranAmount">Jumlah (Rp)</label>
          <input type="number" id="pengeluaranAmount" min="0" step="1000" value="48040000" required />

          <button type="submit">Simpan Pengeluaran</button>
        </form>

        <div class="card-icon"><i class="fas fa-arrow-up-right-from-square"></i></div>
      </div>

      <div class="card blue">
        <h4>Saldo Akhir</h4>
        <small><span id="saldoAkhir-date-display">2025-05-31</span></small>
        <div class="amount" id="saldoAkhir-amount-display">Rp 77,85 jt</div>

        <form id="formSaldoAkhir">
          <label for="saldoAkhirDate">Tanggal</label>
          <input type="date" id="saldoAkhirDate" value="2025-05-31" required />

          <label for="saldoAkhirAmount">Jumlah (Rp)</label>
          <input type="number" id="saldoAkhirAmount" min="0" step="1000" value="77850000" required />

          <button type="submit">Simpan Saldo Akhir</button>
        </form>

        <div class="card-icon"><i class="fas fa-wallet"></i></div>
      </div>
    </div>

    <!-- Filter Bulan -->
    <div style="margin-bottom: 20px; text-align: left; padding-left: 40px;">
      <label for="bulanFilter" style="font-weight: bold; margin-right: 10px;">Pilih Bulan</label>
      <select id="bulanFilter" onchange="filterBulan()" style="padding: 8px 12px; border-radius: 6px; border: 1px solid #ccc;">
        <option value="2025-05" selected>Mei 2025</option>
        <option value="2025-04">April 2025</option>
      </select>
    </div>

    <!-- Tab Tombol -->
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
      <!-- Form tambah transaksi mingguan -->
      <div class="transaction-form">
        <h5>Tambah/Edit Transaksi Mingguan</h5>
        <form id="formTransaksiMingguan">
          <label for="mingguanBulan">Bulan</label>
          <select id="mingguanBulan" required>
            <option value="2025-05" selected>Mei 2025</option>
            <option value="2025-04">April 2025</option>
          </select>

          <label for="mingguanMinggu">Minggu ke-</label>
          <input type="number" id="mingguanMinggu" min="1" max="5" value="1" required />

          <label for="mingguanKategori">Kategori Transaksi</label>
          <input type="text" id="mingguanKategori" placeholder="Misal: Tagihan Listrik" required />

          <label for="mingguanPemasukan">Pemasukan (Rp)</label>
          <input type="number" id="mingguanPemasukan" min="0" step="1000" value="0" required />

          <label for="mingguanPengeluaran">Pengeluaran (Rp)</label>
          <input type="number" id="mingguanPengeluaran" min="0" step="1000" value="0" required />

          <button type="submit">Tambah Transaksi Mingguan</button>
        </form>
      </div>

      <div id="dataMingguanContainer"></div>
    </div>

    <!-- KONTEN PER BULAN -->
    <div class="konten" id="bulanan" style="display:none;">
      <!-- Form tambah transaksi bulanan -->
      <div class="transaction-form">
        <h5>Tambah/Edit Transaksi Bulanan</h5>
        <form id="formTransaksiBulanan">
          <label for="bulananBulan">Bulan</label>
          <select id="bulananBulan" required>
            <option value="2025-05" selected>Mei 2025</option>
            <option value="2025-04">April 2025</option>
          </select>

          <label for="bulananTipe">Tipe</label>
          <select id="bulananTipe" required>
            <option value="Saldo">Saldo</option>
            <option value="Pemasukan">Pemasukan</option>
            <option value="Pengeluaran">Pengeluaran</option>
          </select>

          <label for="bulananKeterangan">Keterangan</label>
          <input type="text" id="bulananKeterangan" placeholder="Misal: Kotak Infaq Hari Jumat" required />

          <label for="bulananJumlah">Jumlah (Rp)</label>
          <input type="number" id="bulananJumlah" min="0" step="1000" value="0" required />

          <button type="submit">Tambah Transaksi Bulanan</button>
        </form>
      </div>

      <div id="dataBulananContainer"></div>
    </div>

    <!-- KONTEN RINCIAN -->
    <div class="konten" id="rincian" style="display:none;">
      <!-- Form tambah transaksi rincian -->
      <div class="transaction-form">
        <h5>Tambah/Edit Transaksi Rincian</h5>
        <form id="formTransaksiRincian">
          <label for="rincianBulan">Bulan</label>
          <select id="rincianBulan" required>
            <option value="2025-05" selected>Mei 2025</option>
            <option value="2025-04">April 2025</option>
          </select>

          <label for="rincianTanggal">Tanggal</label>
          <input type="date" id="rincianTanggal" value="2025-05-01" required />

          <label for="rincianHari">Hari</label>
          <select id="rincianHari" required>
            <option value="JUMAT">JUMAT</option>
            <option value="SABTU">SABTU</option>
            <option value="MINGGU">MINGGU</option>
            <option value="SENIN">SENIN</option>
            <option value="SELASA">SELASA</option>
            <option value="RABU">RABU</option>
            <option value="KAMIS">KAMIS</option>
          </select>

          <label for="rincianKategori">Kategori Transaksi</label>
          <input type="text" id="rincianKategori" placeholder="Misal: Amplit Khotib" required />

          <label for="rincianPemasukan">Pemasukan (Rp)</label>
          <input type="number" id="rincianPemasukan" min="0" step="1000" value="0" required />

          <label for="rincianPengeluaran">Pengeluaran (Rp)</label>
          <input type="number" id="rincianPengeluaran" min="0" step="1000" value="0" required />

          <button type="submit">Tambah Transaksi Rincian</button>
        </form>
      </div>

      <div id="dataRincianContainer"></div>
    </div>
  </div>

  <!-- FOOTER -->
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

<script>
  // Data dummy awal untuk demo (bisa diganti backend)
  let dataSaldo = {
    date: '2025-05-01',
    amount: 101250000
  };
  let dataPemasukan = {
    date: '2025-05-31',
    amount: 24640000
  };
  let dataPengeluaran = {
    date: '2025-05-31',
    amount: 48040000
  };
  let dataSaldoAkhir = {
    date: '2025-05-31',
    amount: 77850000
  };

  // Data transaksi mingguan, bulanan dan rincian disimpan di array
  let transaksiMingguan = [
    { bulan: '2025-05', minggu: 1, kategori: 'Tanpa Kategori', pemasukan: 6156000, pengeluaran: 0 },
    { bulan: '2025-05', minggu: 1, kategori: 'Tagihan Listrik', pemasukan: 0, pengeluaran: 290000 },
    { bulan: '2025-04', minggu: 1, kategori: 'Donasi Umum', pemasukan: 2000000, pengeluaran: 0 },
    { bulan: '2025-04', minggu: 1, kategori: 'Biaya Kebersihan', pemasukan: 0, pengeluaran: 500000 }
  ];

  let transaksiBulanan = [
    { bulan: '2025-05', tipe: 'Saldo', keterangan: 'Sisa saldo per 30 Mei 2025', jumlah: 101248468 },
    { bulan: '2025-05', tipe: 'Pemasukan', keterangan: 'Kotak Infaq Hari Jumat', jumlah: 11374004 },
    { bulan: '2025-05', tipe: 'Pengeluaran', keterangan: 'Insentif Hari Jumat', jumlah: 1550000 },
    { bulan: '2025-04', tipe: 'Saldo', keterangan: 'Sisa saldo per 30 April 2025', jumlah: 50000000 },
    { bulan: '2025-04', tipe: 'Pemasukan', keterangan: 'Donasi Ramadan', jumlah: 15000000 },
    { bulan: '2025-04', tipe: 'Pengeluaran', keterangan: 'Pembelian Sembako', jumlah: 5000000 }
  ];

  let transaksiRincian = [
    { bulan: '2025-05', tanggal: '2025-05-02', hari: 'JUMAT', kategori: 'AMPLOP KHOTIB', pemasukan: 0, pengeluaran: 300000 },
    { bulan: '2025-05', tanggal: '2025-05-02', hari: 'JUMAT', kategori: 'KOTAK AMAL JUMAT 1', pemasukan: 2180004, pengeluaran: 0 },
    { bulan: '2025-05', tanggal: '2025-05-04', hari: 'AHAD', kategori: 'SAWIT WAKAF 01', pemasukan: 5517000, pengeluaran: 0 },
    { bulan: '2025-05', tanggal: '2025-05-04', hari: 'AHAD', kategori: 'SAWIT WAKAF 02', pemasukan: 2823450, pengeluaran: 0 }
  ];

  // Fungsi untuk format angka ke Rupiah
  function formatRupiah(num) {
    return 'Rp ' + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  }

  // Fungsi update tampilan summary card
  function updateSummaryCard(idPrefix, data) {
    document.getElementById(idPrefix + '-date-display').textContent = data.date;
    document.getElementById(idPrefix + '-amount-display').textContent = formatRupiah(data.amount);
  }

  // Update semua summary card di awal
  updateSummaryCard('saldo', dataSaldo);
  updateSummaryCard('pemasukan', dataPemasukan);
  updateSummaryCard('pengeluaran', dataPengeluaran);
  updateSummaryCard('saldoAkhir', dataSaldoAkhir);

  // Handle form submit untuk summary card (saldo, pemasukan, pengeluaran, saldo akhir)
  document.getElementById('formSaldo').addEventListener('submit', function(e) {
    e.preventDefault();
    dataSaldo.date = this.saldoDate.value;
    dataSaldo.amount = Number(this.saldoAmount.value);
    updateSummaryCard('saldo', dataSaldo);
    alert('Data Saldo berhasil disimpan');
  });
  document.getElementById('formPemasukan').addEventListener('submit', function(e) {
    e.preventDefault();
    dataPemasukan.date = this.pemasukanDate.value;
    dataPemasukan.amount = Number(this.pemasukanAmount.value);
    updateSummaryCard('pemasukan', dataPemasukan);
    alert('Data Pemasukan berhasil disimpan');
  });
  document.getElementById('formPengeluaran').addEventListener('submit', function(e) {
    e.preventDefault();
    dataPengeluaran.date = this.pengeluaranDate.value;
    dataPengeluaran.amount = Number(this.pengeluaranAmount.value);
    updateSummaryCard('pengeluaran', dataPengeluaran);
    alert('Data Pengeluaran berhasil disimpan');
  });
  document.getElementById('formSaldoAkhir').addEventListener('submit', function(e) {
    e.preventDefault();
    dataSaldoAkhir.date = this.saldoAkhirDate.value;
    dataSaldoAkhir.amount = Number(this.saldoAkhirAmount.value);
    updateSummaryCard('saldoAkhir', dataSaldoAkhir);
    alert('Data Saldo Akhir berhasil disimpan');
  });

  // Fungsi render transaksi mingguan
  function renderMingguan() {
    const container = document.getElementById('dataMingguanContainer');
    const bulanFilter = document.getElementById('bulanFilter').value;
    container.innerHTML = '';

    // Filter data sesuai bulan terpilih
    let filtered = transaksiMingguan.filter(t => t.bulan === bulanFilter);
    if (filtered.length === 0) {
      container.innerHTML = '<p>Tidak ada data transaksi mingguan untuk bulan ini.</p>';
      return;
    }

    // Group by minggu
    let grouped = {};
    filtered.forEach(t => {
      if (!grouped[t.minggu]) grouped[t.minggu] = [];
      grouped[t.minggu].push(t);
    });

    // Render tabel per minggu
    Object.keys(grouped).sort().forEach(minggu => {
      let trs = grouped[minggu];
      let html = `<h4 data-bulan="${bulanFilter}"><span class="week">Minggu ${minggu}</span></h4>`;
      html += `<table class="transaction-table" data-bulan="${bulanFilter}"><thead><tr><th>Transaksi</th><th>Pemasukan</th><th>Pengeluaran</th><th>Aksi</th></tr></thead><tbody>`;
      let saldoAkhir = 0;
      trs.forEach((t, idx) => {
        saldoAkhir += t.pemasukan - t.pengeluaran;
        html += `<tr>
          <td contenteditable="true" data-field="kategori" data-index="${idx}" data-minggu="${minggu}">${t.kategori}</td>
          <td contenteditable="true" data-field="pemasukan" data-index="${idx}" data-minggu="${minggu}">${t.pemasukan}</td>
          <td contenteditable="true" data-field="pengeluaran" data-index="${idx}" data-minggu="${minggu}">${t.pengeluaran}</td>
          <td><button onclick="hapusMingguan(${idx}, '${minggu}', '${bulanFilter}')">Hapus</button></td>
        </tr>`;
      });
      html += `<tr class="saldo-row"><td colspan="3"><strong>Saldo Akhir Minggu ${minggu}</strong></td><td class="amount-bold">${formatRupiah(saldoAkhir)}</td></tr>`;
      html += `</tbody></table>`;
      container.innerHTML += html;
    });
  }

  // Fungsi render transaksi bulanan
  function renderBulanan() {
    const container = document.getElementById('dataBulananContainer');
    const bulanFilter = document.getElementById('bulanFilter').value;
    container.innerHTML = '';

    let filtered = transaksiBulanan.filter(t => t.bulan === bulanFilter);
    if (filtered.length === 0) {
      container.innerHTML = '<p>Tidak ada data transaksi bulanan untuk bulan ini.</p>';
      return;
    }

    let html = `<table class="transaction-table" data-bulan="${bulanFilter}"><thead><tr><th>#</th><th>TRANSAKSI</th><th>JUMLAH (Rp)</th><th>TIPE</th><th>Aksi</th></tr></thead><tbody>`;

    filtered.forEach((t, idx) => {
      html += `<tr>
        <td>${idx+1}</td>
        <td contenteditable="true" data-field="keterangan" data-index="${idx}">${t.keterangan}</td>
        <td contenteditable="true" data-field="jumlah" data-index="${idx}">${t.jumlah}</td>
        <td>${t.tipe}</td>
        <td><button onclick="hapusBulanan(${idx}, '${bulanFilter}')">Hapus</button></td>
      </tr>`;
    });

    html += `</tbody></table>`;
    container.innerHTML = html;
  }

  // Fungsi render transaksi rincian
  function renderRincian() {
    const container = document.getElementById('dataRincianContainer');
    const bulanFilter = document.getElementById('bulanFilter').value;
    container.innerHTML = '';

    let filtered = transaksiRincian.filter(t => t.bulan === bulanFilter);
    if (filtered.length === 0) {
      container.innerHTML = '<p>Tidak ada data transaksi rincian untuk bulan ini.</p>';
      return;
    }

    // Group by pekan (misal pekan 1, pekan 2) berdasarkan tanggal sederhana: 
    // (untuk demo, kita kelompokkan manual berdasarkan tanggal)
    // Agar sederhana, bagi tanggal ke pekan 1: 1-7, pekan 2: 8-14, dst
    let grouped = {};
    filtered.forEach(t => {
      const day = new Date(t.tanggal).getDate();
      let pekan = 'Pekan 1';
      if (day > 7 && day <= 14) pekan = 'Pekan 2';
      else if (day > 14 && day <= 21) pekan = 'Pekan 3';
      else if (day > 21 && day <= 28) pekan = 'Pekan 4';
      else if (day > 28) pekan = 'Pekan 5';

      if (!grouped[pekan]) grouped[pekan] = [];
      grouped[pekan].push(t);
    });

    // Render tiap pekan
    Object.keys(grouped).sort().forEach(pekan => {
      let trs = grouped[pekan];
      let html = `<h4>${pekan} (${trs[0].tanggal} dst)</h4>`;
      html += `<table class="transaction-table"><thead><tr><th>TANGGAL</th><th>TRANSAKSI</th><th>PEMASUKAN</th><th>PENGELUARAN</th><th>Aksi</th></tr></thead><tbody>`;
      trs.forEach((t, idx) => {
        html += `<tr>
          <td contenteditable="true" data-field="tanggal" data-index="${idx}" data-pekan="${pekan}">${t.tanggal}</td>
          <td contenteditable="true" data-field="kategori" data-index="${idx}" data-pekan="${pekan}">${t.kategori}</td>
          <td contenteditable="true" data-field="pemasukan" data-index="${idx}" data-pekan="${pekan}">${t.pemasukan}</td>
          <td contenteditable="true" data-field="pengeluaran" data-index="${idx}" data-pekan="${pekan}">${t.pengeluaran}</td>
          <td><button onclick="hapusRincian(${idx}, '${pekan}', '${bulanFilter}')">Hapus</button></td>
        </tr>`;
      });
      html += `</tbody></table>`;
      container.innerHTML += html;
    });
  }

  // Fungsi hapus transaksi mingguan
  function hapusMingguan(idx, minggu, bulan) {
    transaksiMingguan = transaksiMingguan.filter((t, i) => !(i === idx && t.minggu === Number(minggu) && t.bulan === bulan));
    renderMingguan();
  }

  // Fungsi hapus transaksi bulanan
  function hapusBulanan(idx, bulan) {
    transaksiBulanan = transaksiBulanan.filter((t, i) => !(i === idx && t.bulan === bulan));
    renderBulanan();
  }

  // Fungsi hapus transaksi rincian
  function hapusRincian(idx, pekan, bulan) {
    let filtered = transaksiRincian.filter(t => {
      const day = new Date(t.tanggal).getDate();
      let p = 'Pekan 1';
      if (day > 7 && day <= 14) p = 'Pekan 2';
      else if (day > 14 && day <= 21) p = 'Pekan 3';
      else if (day > 21 && day <= 28) p = 'Pekan 4';
      else if (day > 28) p = 'Pekan 5';
      return p === pekan && t.bulan === bulan;
    });
    // Cari index lokal berdasarkan pekan
    if (idx < filtered.length) {
      const itemToRemove = filtered[idx];
      transaksiRincian = transaksiRincian.filter(t => t !== itemToRemove);
      renderRincian();
    }
  }

  // Event listener untuk edit konten yang contenteditable
  document.addEventListener('input', function(e) {
    if (!e.target.hasAttribute('data-field')) return;

    const field = e.target.getAttribute('data-field');
    const idx = parseInt(e.target.getAttribute('data-index'));
    const minggu = e.target.getAttribute('data-minggu');
    const pekan = e.target.getAttribute('data-pekan');
    const bulanFilter = document.getElementById('bulanFilter').value;

    if (field && !isNaN(idx)) {
      if (minggu) {
        // Update data mingguan
        let item = transaksiMingguan.find((t, i) => i === idx && t.minggu === Number(minggu) && t.bulan === bulanFilter);
        if (item) {
          if (field === 'kategori') item.kategori = e.target.textContent.trim();
          else if (field === 'pemasukan') item.pemasukan = parseInt(e.target.textContent.replace(/\D/g, '')) || 0;
          else if (field === 'pengeluaran') item.pengeluaran = parseInt(e.target.textContent.replace(/\D/g, '')) || 0;
        }
        renderMingguan();
      } else if (pekan) {
        // Update data rincian
        let filtered = transaksiRincian.filter(t => {
          const day = new Date(t.tanggal).getDate();
          let p = 'Pekan 1';
          if (day > 7 && day <= 14) p = 'Pekan 2';
          else if (day > 14 && day <= 21) p = 'Pekan 3';
          else if (day > 21 && day <= 28) p = 'Pekan 4';
          else if (day > 28) p = 'Pekan 5';
          return p === pekan && t.bulan === bulanFilter;
        });
        if (idx < filtered.length) {
          let item = filtered[idx];
          if (field === 'tanggal') item.tanggal = e.target.textContent.trim();
          else if (field === 'kategori') item.kategori = e.target.textContent.trim();
          else if (field === 'pemasukan') item.pemasukan = parseInt(e.target.textContent.replace(/\D/g, '')) || 0;
          else if (field === 'pengeluaran') item.pengeluaran = parseInt(e.target.textContent.replace(/\D/g, '')) || 0;
        }
        renderRincian();
      } else {
        // Update data bulanan
        let item = transaksiBulanan.find((t, i) => i === idx && t.bulan === bulanFilter);
        if (item) {
          if (field === 'keterangan') item.keterangan = e.target.textContent.trim();
          else if (field === 'jumlah') item.jumlah = parseInt(e.target.textContent.replace(/\D/g, '')) || 0;
        }
        renderBulanan();
      }
    }
  });

  // Event form submit tambah transaksi mingguan
  document.getElementById('formTransaksiMingguan').addEventListener('submit', function(e) {
    e.preventDefault();
    const minggu = Number(this.minggu.value);
    const bulan = this.bulan.value;
    const kategori = this.kategori.value.trim();
    const pemasukan = Number(this.pemasukan.value);
    const pengeluaran = Number(this.pengeluaran.value);

    transaksiMingguan.push({ bulan, minggu, kategori, pemasukan, pengeluaran });
    this.reset();
    renderMingguan();
  });

  // Event form submit tambah transaksi bulanan
  document.getElementById('formTransaksiBulanan').addEventListener('submit', function(e) {
    e.preventDefault();
    const bulan = this.bulan.value;
    const tipe = this.tipe.value;
    const keterangan = this.keterangan.value.trim();
    const jumlah = Number(this.jumlah.value);

    transaksiBulanan.push({ bulan, tipe, keterangan, jumlah });
    this.reset();
    renderBulanan();
  });

  // Event form submit tambah transaksi rincian
  document.getElementById('formTransaksiRincian').addEventListener('submit', function(e) {
    e.preventDefault();
    const bulan = this.rincianBulan.value;
    const tanggal = this.rincianTanggal.value;
    const hari = this.rincianHari.value;
    const kategori = this.rincianKategori.value.trim();
    const pemasukan = Number(this.rincianPemasukan.value);
    const pengeluaran = Number(this.rincianPengeluaran.value);

    transaksiRincian.push({ bulan, tanggal, hari, kategori, pemasukan, pengeluaran });
    this.reset();
    renderRincian();
  });

  // Fungsi untuk menampilkan konten sesuai tombol dan filter bulan
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

  // Fungsi untuk filter bulan
  function filterBulan() {
    const bulanDipilih = document.getElementById('bulanFilter').value;
    document.querySelectorAll('[data-bulan]').forEach(el => {
      el.style.display = (el.getAttribute('data-bulan') === bulanDipilih) ? '' : 'none';
    });
  }

  // Inisialisasi tampilan awal
  document.addEventListener('DOMContentLoaded', () => {
    tampilkanKonten('mingguan');
    filterBulan();
  });
</script>

</body>
</html>
