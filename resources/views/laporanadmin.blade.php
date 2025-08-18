<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ADMIN - LAPORAN KEUANGAN MASJID</title>

  <link href="{{ asset('css/datalap.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- jsPDF & autoTable -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.29/jspdf.plugin.autotable.min.js"></script>

   <style>
  /* Container utama daftar transaksi + filter + tombol tambah */
  .transactions {
    display: flex;
    justify-content: space-between; /* Filter di kiri, tombol tambah di kanan */
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 15px;
  }

  /* Filter */
  .transactions form {
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .transactions label {
    font-weight: bold;
  }
  .transactions select {
    padding: 5px;
    border-radius: 4px;
    border: 1px solid #ccc;
  }

  /* Tombol tambah */
  .btn-tambah {
    padding: 6px 12px;
    background: #4CAF50;
    border: none;
    color: white;
    border-radius: 4px;
    cursor: pointer;
  }
  .btn-tambah:hover {
    background: #45a049;
  }

  /* Modal form */
  #formModal {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.5);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 999;
  }
  .modal-content {
    background: white;
    padding: 20px 25px;
    border-radius: 8px;
    width: 300px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.3);
  }
  .modal-content label {
    display: block;
    margin-top: 10px;
    font-weight: bold;
  }
  .modal-content input {
    width: 100%;
    padding: 5px;
    margin-top: 4px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
  .modal-content button {
    margin-top: 12px;
  }

  /* Hapus panah input number */
  input[type=number]::-webkit-inner-spin-button,
  input[type=number]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
  }
  input[type=number] {
      -moz-appearance: textfield; /* Firefox */
  }

  /* Tabel */
  .transaction-table {
    width: 80%;
    margin: 0 auto;
    border-collapse: collapse;
    text-align: center;
  }
  .transaction-table th, .transaction-table td {
    border: 1px solid #ddd;
    padding: 8px;
  }
  .transaction-table th {
    background-color: #f2f2f2;
    font-weight: bold;
  }
.transaction-table td:nth-child(2),
.transaction-table th:nth-child(2) {
  text-align: left;
}

  /* Tombol PDF */
  .pdf-buttons {
    width: 80%;
    margin: 10px auto;
    display: flex;
    justify-content: flex-end;
    gap: 8px;
  }
</style>

</head>
<body>

  <div class="header">
    <i class="fas fa-user-shield"></i> ADMIN - LAPORAN KEUANGAN
  </div>

  <!-- TOMBOL BACK -->
  <div class="circle-back-wrapper">
    <a href="/dashben" class="circle-back-button" title="Kembali ke Beranda">
      <i class="fas fa-arrow-left"></i>
    </a>
  </div>

  <div class="container">
    <div class="page-title">Kelola Laporan Keuangan</div>

    <div class="transactions">
      <h4>Daftar Transaksi</h4>

      <!-- Filter -->
      <form method="GET" action="{{ route('laporanadmin') }}">
        <label for="filter">Filter:</label>
        <select name="filter" id="filter" onchange="this.form.submit()">
          <option value="">Semua</option>
          <option value="minggu" {{ request('filter') === 'minggu' ? 'selected' : '' }}>Input Per Minggu </option>
          <option value="bulan" {{ request('filter') === 'bulan' ? 'selected' : '' }}>Input PerBulan </option>
          <option value="tahun" {{ request('filter') === 'tahun' ? 'selected' : '' }}>Input Per Tahun</option>
        </select>
      </form>

      <!-- Tombol tambah -->
      <button class="btn-tambah" onclick="openForm()">+ Tambah Data</button>
    </div>
  </div>

  <!-- Modal Form -->
  <div id="formModal" style="display:none;">
    <div class="modal-content">
      <h3 id="modalTitle">Tambah Data</h3>
      <form id="dataForm">
        <input type="hidden" id="formId" />
        <label>Nama Transaksi:</label>
        <input type="text" id="formTransaksi" required />

        <label>Debet:</label>
        <input type="number" id="formPemasukan" />

        <label>Kredit:</label>
        <input type="number" id="formPengeluaran" />

        <button type="submit" class="btn-save">Simpan</button>
        <button type="button" class="btn-delete" onclick="closeForm()">Batal</button>
      </form>
    </div>
  </div>

  <!-- Tombol cetak PDF (posisi kanan) -->
  <div class="pdf-buttons">
    <button id="btnMinggu" onclick="cetakPDF('minggu')" class="btn-tambah" style="display:none;">
      <i class="fa fa-file-pdf"></i> Cetak PDF Per Minggu 
    </button>
    <button id="btnBulan" onclick="cetakPDF('bulan')" class="btn-tambah" style="display:none;">
      <i class="fa fa-file-pdf"></i> Cetak PDF Per Bulan 
    </button>
    <button id="btnTahun" onclick="cetakPDF('tahun')" class="btn-tambah" style="display:none;">
      <i class="fa fa-file-pdf"></i> Cetak PDF Per Tahun 
    </button>
  </div>

  <!-- Judul filter otomatis -->
  <h3 id="judulFilter" style="margin-top: 10px; color: #333; text-align:center;">
    {{ $judul ?? '' }}
  </h3>

  <!-- Tabel -->
<table class="transaction-table">
  <thead>
    <tr>
      <th>#</th>
      <th>Nama Transaksi</th>
      <th>Debet</th>
      <th>Kredit</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @php
      $mingguSekarang = null;
      $bulanSekarang = null;
      $tahunSekarang = null;
      $totalDebet = 0;
      $totalKredit = 0;
      $namaBulanList = [
          1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni',
          7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'
      ];
    @endphp
    @foreach($transaksis as $index => $t)
        @php
            $timestamp = strtotime($t->created_at);
            $tahun = date('Y', $timestamp);
            $bulan = date('n', $timestamp);
            $hari = (int) date('j', $timestamp);
            $mingguKe = ceil($hari / 7);

            // Hitung total
            $totalDebet += $t->pemasukan ?? 0;
            $totalKredit += $t->pengeluaran ?? 0;

            // Untuk Tahun
            if ($tahunSekarang !== $tahun && request('filter') === 'tahun') {
                $tahunSekarang = $tahun;
                echo "<tr>
                        <td colspan='5' style='background:#ccc;font-weight:bold;text-align:center'>
                            Tahun {$tahunSekarang}
                        </td>
                      </tr>";
            }

            // Untuk Bulan
            if ($bulanSekarang !== $bulan && (request('filter') === 'bulan' || request('filter') === 'tahun')) {
                $bulanSekarang = $bulan;
                $namaBulan = $namaBulanList[$bulan];
                echo "<tr>
                        <td colspan='5' style='background:#ddd;font-weight:bold;text-align:center'>
                            {$namaBulan} {$tahun}
                        </td>
                      </tr>";
            }

            // Untuk Minggu
            if ($mingguSekarang !== $mingguKe && request('filter') === 'minggu') {
                $mingguSekarang = $mingguKe;
                $awal = ($mingguKe - 1) * 7 + 1;
                $akhir = min($awal + 6, cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun));
                $namaBulan = $namaBulanList[$bulan];
                echo "<tr>
                        <td colspan='5' style='background:#eee;font-weight:bold;text-align:center'>
                            Minggu {$mingguKe} ({$awal}-{$akhir} {$namaBulan} {$tahun})
                        </td>
                      </tr>";
            }
        @endphp
        <tr data-id="{{ $t->id }}">
            <td>{{ $index + 1 }}</td>
            <td>{{ $t->nama_transaksi }}</td>
            <td class="amount-green">
                {{ $t->pemasukan ? 'Rp ' . number_format($t->pemasukan,0,',','.') : '' }}
            </td>
            <td class="amount-red">
                {{ $t->pengeluaran ? 'Rp ' . number_format($t->pengeluaran,0,',','.') : '' }}
            </td>
            <td>
                <button class="btn-edit" onclick="editData({{ $t->id }}, '{{ $t->nama_transaksi }}', '{{ $t->pemasukan }}', '{{ $t->pengeluaran }}')">Edit</button>
                <button class="btn-delete" onclick="hapusData({{ $t->id }}, this)">Hapus</button>
            </td>
        </tr>
    @endforeach
  </tbody>

  <!-- Tambahkan bagian total -->
  <tfoot>
    <tr style="background:#f2f2f2;font-weight:bold;">
      <td colspan="2">TOTAL</td>
      <td class="amount-green">Rp {{ number_format($totalDebet, 0, ',', '.') }}</td>
      <td class="amount-red">Rp {{ number_format($totalKredit, 0, ',', '.') }}</td>
      <td></td>
    </tr>
  </tfoot>
</table>

  <script>
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const modal = document.getElementById("formModal");
    const form = document.getElementById("dataForm");

    function openForm() {
      document.getElementById("modalTitle").innerText = "Tambah Data";
      form.reset();
      document.getElementById("formId").value = "";
      modal.style.display = "flex";
    }

    function closeForm() {
      modal.style.display = "none";
      form.reset();
    }

    function editData(id, nama, pemasukan, pengeluaran) {
      document.getElementById("modalTitle").innerText = "Edit Data";
      document.getElementById("formId").value = id;
      document.getElementById("formTransaksi").value = nama;
      document.getElementById("formPemasukan").value = pemasukan;
      document.getElementById("formPengeluaran").value = pengeluaran;
      modal.style.display = "flex";
    }

    form.addEventListener("submit", function(e) {
      e.preventDefault();

      const id = document.getElementById("formId").value;
      const formData = new FormData();
      formData.append("nama_transaksi", document.getElementById("formTransaksi").value);
      formData.append("pemasukan", document.getElementById("formPemasukan").value || 0);
      formData.append("pengeluaran", document.getElementById("formPengeluaran").value || 0);

      const url = id ? `/transaksi/${id}` : `{{ route('transaksi.store') }}`;
      const method = id ? "POST" : "POST";

      if (id) {
        formData.append("_method", "PUT");
      }

      fetch(url, {
        method: method,
        headers: { "X-CSRF-TOKEN": token },
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        alert(data.message);
        if (data.status === "success") {
          location.reload();
        }
      })
      .catch(err => alert("Terjadi kesalahan: " + err));
    });

    function hapusData(id, button) {
      if (confirm("Yakin ingin menghapus data ini?")) {
        fetch(`/transaksi/${id}`, {
          method: "DELETE",
          headers: { "X-CSRF-TOKEN": token }
        })
        .then(res => res.json())
        .then(data => {
          alert(data.message);
          if (data.status === "success") {
            button.closest("tr").remove();
          }
        })
        .catch(err => alert("Terjadi kesalahan: " + err));
      }
    }

    function updateJudulFilter() {
      const filter = document.getElementById("filter").value;
      const judulElement = document.getElementById("judulFilter");

      switch(filter) {
        case "minggu":
          judulElement.innerText;
          break;
        case "bulan":
          judulElement.innerText;
          break;
        case "tahun":
          judulElement.innerText;
          break;
        default:
          judulElement.innerText = "";
      }
    }

    function updatePDFButtons() {
      const filter = document.getElementById("filter").value;
      document.getElementById("btnMinggu").style.display = (filter === "minggu") ? "inline-block" : "none";
      document.getElementById("btnBulan").style.display = (filter === "bulan") ? "inline-block" : "none";
      document.getElementById("btnTahun").style.display = (filter === "tahun") ? "inline-block" : "none";
    }

    updateJudulFilter();
    updatePDFButtons();

    document.getElementById("filter").addEventListener("change", function() {
      updateJudulFilter();
      updatePDFButtons();
    });

    function cetakPDF(jenis) {
      const { jsPDF } = window.jspdf;
      const doc = new jsPDF();

      let judul = '';
      const bulanNama = [
        'Januari','Februari','Maret','April','Mei','Juni',
        'Juli','Agustus','September','Oktober','November','Desember'
      ];

      const now = new Date();
      const tahun = now.getFullYear();
      const bulan = bulanNama[now.getMonth()];

      if (jenis === 'minggu') {
        const mingguKe = Math.ceil(now.getDate() / 7);
        const awal = (mingguKe - 1) * 7 + 1;
        const akhir = Math.min(awal + 6, new Date(tahun, now.getMonth() + 1, 0).getDate());
        judul = `Laporan Keuangan - Minggu ${mingguKe} (${awal}–${akhir} ${bulan} ${tahun})`;
      }
      if (jenis === 'bulan') judul = `Laporan Keuangan - Bulan ${bulan} ${tahun}`;
      if (jenis === 'tahun') judul = `Laporan Keuangan - Tahun ${tahun}`;

      doc.setFontSize(14);
      doc.text(judul, 14, 15);

      const tableData = [];
      document.querySelectorAll(".transaction-table tbody tr").forEach(tr => {
        const row = [];
        tr.querySelectorAll("td").forEach((td, index) => {
          if (index < 4) row.push(td.innerText.trim());
        });
        if(row.length) tableData.push(row);
      });

      doc.autoTable({
        head: [['#', 'Nama Transaksi', 'Pemasukan', 'Pengeluaran']],
        body: tableData,
        startY: 25,
      });

      doc.save(`${judul}.pdf`);
    }
  </script>

</body>
</html>
