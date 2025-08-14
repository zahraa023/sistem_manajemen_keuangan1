<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>ADMIN - LAPORAN KEUANGAN MASJID</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/datalap.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .btn-tambah {
      background: #17a2b8;
      border: none;
      color: white;
      padding: 6px 12px;
      border-radius: 5px;
      cursor: pointer;
      margin-bottom: 8px;
    }
    .btn-tambah:hover { background: #117a8b; }

    .btn-save {
      background: #28a745;
      border: none;
      color: white;
      padding: 4px 8px;
      border-radius: 4px;
      cursor: pointer;
      margin-right: 4px;
    }
    .btn-save:hover { background: #1e7e34; }

    .btn-delete {
      background: #dc3545;
      border: none;
      color: white;
      padding: 4px 8px;
      border-radius: 4px;
      cursor: pointer;
    }
    .btn-delete:hover { background: #a71d2a; }

    td[contenteditable="true"] {
      background-color: #fff8d6;
      outline: 1px solid #ffbb00;
    }
  </style>
</head>
<body>

<!-- HEADER -->
<div class="header">
  <i class="fas fa-user-shield"></i> ADMIN - LAPORAN KEUANGAN
</div>

<!-- Tombol Kembali -->
<div class="circle-back-wrapper">
  <a href="/dashboard-admin" class="circle-back-button" title="Kembali ke Dashboard">
    <i class="fas fa-arrow-left"></i>
  </a>
</div>

<div class="container">
  <div class="page-title">Kelola Laporan Keuangan</div>

  <!-- Filter Bulan -->
  <div style="margin-bottom: 20px; text-align: left; padding-left: 40px;">
    <label for="bulanFilter" style="font-weight: bold; margin-right: 10px;">Pilih Bulan</label>
    <select id="bulanFilter" onchange="filterBulan()" style="padding: 8px 12px; border-radius: 6px; border: 1px solid #ccc;">
      <option value="2025-05" selected>Mei 2025</option>
      <option value="2025-04">April 2025</option>
    </select>
  </div>

  <!-- Tombol Tab -->
  <div class="filter-buttons">
    <button onclick="tampilkanKonten('mingguan')" id="btn-mingguan" class="active-tab"><i class="fas fa-file-alt"></i> PER MINGGU</button>
    <button onclick="tampilkanKonten('bulanan')" id="btn-bulanan"><i class="fas fa-calendar-alt"></i> PER BULAN</button>
    <button onclick="tampilkanKonten('rincian')" id="btn-rincian"><i class="fas fa-info-circle"></i> RINCIAN TRANSAKSI</button>
  </div>

  <!-- KONTEN MINGGUAN -->
  <div class="konten" id="mingguan">
    <div class="transactions" data-bulan="2025-05">
      <h4>Minggu 1 (1 - 7 Mei 2025)</h4>
      <button class="btn-tambah" onclick="tambahBaris(this)">+ Tambah Data</button>
      <table class="transaction-table">
        <thead>
          <tr>
            <th>Transaksi</th><th>Pemasukan</th><th>Pengeluaran</th><th>Saldo</th><th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Tanpa Kategori</td><td class="amount-green">Rp 6.156.000</td><td></td><td></td>
            <td><button class="btn-delete" onclick="hapusBaris(this)">Hapus</button></td>
          </tr>
          <tr>
            <td>Tagihan Listrik</td><td></td><td class="amount-red">Rp 290.000</td><td></td>
            <td><button class="btn-delete" onclick="hapusBaris(this)">Hapus</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- KONTEN BULANAN -->
  <div class="konten" id="bulanan" style="display:none;">
    <div class="transactions" data-bulan="2025-05">
      <h4>Laporan Bulanan: Mei 2025</h4>
      <button class="btn-tambah" onclick="tambahBaris(this)">+ Tambah Data</button>
      <table class="transaction-table">
        <thead>
          <tr>
            <th>#</th><th>TRANSAKSI</th><th>PEMASUKAN</th><th>PENGELUARAN</th><th>SALDO</th><th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td><td>Sisa saldo per 30 Mei 2025</td><td></td><td></td><td class="amount-bold">101.248.468</td>
            <td><button class="btn-delete" onclick="hapusBaris(this)">Hapus</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- KONTEN RINCIAN -->
  <div class="konten" id="rincian" style="display:none;">
    <div class="transactions" data-bulan="2025-05">
      <h4>Pekan 1 (01 - 04 Mei 2025)</h4>
      <button class="btn-tambah" onclick="tambahBaris(this)">+ Tambah Data</button>
      <table class="transaction-table">
        <thead>
          <tr>
            <th>TANGGAL</th><th>TRANSAKSI</th><th>PEMASUKAN</th><th>PENGELUARAN</th><th>SALDO</th><th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>2025-05-02</td><td>AMPLOP KHOTIB</td><td></td><td class="amount-red">300.000</td><td></td>
            <td><button class="btn-delete" onclick="hapusBaris(this)">Hapus</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
function tampilkanKonten(id) {
  document.querySelectorAll('.konten').forEach(k => k.style.display = 'none');
  document.getElementById(id).style.display = 'block';
  document.querySelectorAll('.filter-buttons button').forEach(b => b.classList.remove('active-tab'));
  document.getElementById('btn-' + id).classList.add('active-tab');
  filterBulan();
}

function filterBulan() {
  const bulanDipilih = document.getElementById('bulanFilter').value;
  document.querySelectorAll('.transactions').forEach(el => {
    el.style.display = (el.dataset.bulan === bulanDipilih) ? '' : 'none';
  });
}

function tambahBaris(button) {
  const table = button.nextElementSibling;
  const tbody = table.querySelector("tbody");
  const newRow = document.createElement("tr");
  const colCount = table.querySelectorAll("thead th").length;

  for (let i = 0; i < colCount - 1; i++) {
    const td = document.createElement("td");
    td.contentEditable = "true";
    newRow.appendChild(td);
  }

  const tdAksi = document.createElement("td");
  tdAksi.innerHTML = `
    <button class="btn-save" onclick="simpanBaris(this)">Simpan</button>
    <button class="btn-delete" onclick="hapusBaris(this)">Hapus</button>
  `;
  newRow.appendChild(tdAksi);
  tbody.appendChild(newRow);
}

function simpanBaris(button) {
  const row = button.closest("tr");
  const data = [];

  row.querySelectorAll("td:not(:last-child)").forEach(td => {
    td.contentEditable = "false";
    data.push(td.innerText.trim());
  });

  console.log("Data baru:", data);
  alert("Data berhasil ditambahkan (simulasi)");
}

function hapusBaris(button) {
  if (confirm("Yakin ingin menghapus data ini?")) {
    button.closest("tr").remove();
    alert("Data berhasil dihapus (simulasi)");
  }
}

document.addEventListener('DOMContentLoaded', () => {
  tampilkanKonten('mingguan');
  filterBulan();
});
</script>
</body>
</html>
