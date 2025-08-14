<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ADMIN - LAPORAN KEUANGAN MASJID</title>

  <link href="{{ asset('css/datalap.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

  <div class="header">
    <i class="fas fa-user-shield"></i> ADMIN - LAPORAN KEUANGAN
  </div>

  <div class="container">
    <div class="page-title">Kelola Laporan Keuangan</div>

    <div class="transactions">
      <h4>Daftar Transaksi</h4>

      <!-- Filter Waktu -->
      <form method="GET" action="{{ route('laporanadmin') }}">
        <label for="filter">Filter:</label>
        <select name="filter" id="filter" onchange="this.form.submit()">
          <option value="">Semua</option>
          <option value="minggu" {{ request('filter') === 'minggu' ? 'selected' : '' }}>Minggu Ini</option>
          <option value="bulan" {{ request('filter') === 'bulan' ? 'selected' : '' }}>Bulan Ini</option>
          <option value="tahun" {{ request('filter') === 'tahun' ? 'selected' : '' }}>Tahun Ini</option>
        </select>
      </form>

      <button class="btn-tambah" onclick="tambahBaris()">+ Tambah Data</button>
      <table class="transaction-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nama Transaksi</th>
            <th>Pemasukan</th>
            <th>Pengeluaran</th>
            <th>Tanggal Dibuat</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($transaksis as $index => $t)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $t->nama_transaksi }}</td>
            <td class="amount-green">{{ $t->pemasukan ? 'Rp ' . number_format($t->pemasukan,0,',','.') : '' }}</td>
            <td class="amount-red">{{ $t->pengeluaran ? 'Rp ' . number_format($t->pengeluaran,0,',','.') : '' }}</td>
            <td>{{ date('d M Y H:i', strtotime($t->created_at)) }}</td>
            <td>
              <button class="btn-delete" onclick="hapusData({{ $t->id }}, this)">Hapus</button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal -->
  <div id="formModal" style="display:none;">
    <div class="modal-content">
      <h3>Tambah Data</h3>
      <form id="tambahForm">
        <label>Nama Transaksi:</label>
        <input type="text" id="formTransaksi" required />

        <label>Pemasukan:</label>
        <input type="number" id="formPemasukan" />

        <label>Pengeluaran:</label>
        <input type="number" id="formPengeluaran" />

        <button type="submit" class="btn-save">Simpan</button>
        <button type="button" class="btn-delete" onclick="tutupForm()">Batal</button>
      </form>
    </div>
  </div>

  <script>
    let targetTableBody = document.querySelector(".transaction-table tbody");

    function tambahBaris() {
      document.getElementById("formModal").style.display = "flex";
    }

    function tutupForm() {
      document.getElementById("formModal").style.display = "none";
      document.getElementById("tambahForm").reset();
    }

    document.getElementById("tambahForm").addEventListener("submit", function(e) {
      e.preventDefault();
      const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      const formData = new FormData();
      formData.append("nama_transaksi", document.getElementById("formTransaksi").value);
      formData.append("pemasukan", document.getElementById("formPemasukan").value || 0);
      formData.append("pengeluaran", document.getElementById("formPengeluaran").value || 0);

      fetch("{{ route('transaksi.store') }}", {
        method: "POST",
        headers: { "X-CSRF-TOKEN": token },
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === "success") {
          const newRow = document.createElement("tr");
          newRow.innerHTML = `
            <td>-</td>
            <td>${formData.get("nama_transaksi")}</td>
            <td class="amount-green">${formData.get("pemasukan") > 0 ? "Rp " + Number(formData.get("pemasukan")).toLocaleString() : ""}</td>
            <td class="amount-red">${formData.get("pengeluaran") > 0 ? "Rp " + Number(formData.get("pengeluaran")).toLocaleString() : ""}</td>
            <td>${new Date().toLocaleString()}</td>
            <td><button class="btn-delete" onclick="hapusData(${data.id}, this)">Hapus</button></td>
          `;
          targetTableBody.appendChild(newRow);
          tutupForm();
        }
        alert(data.message);
      })
      .catch(err => alert("Terjadi kesalahan: " + err));
    });

    function hapusData(id, button) {
      if (confirm("Yakin ingin menghapus data ini?")) {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/transaksi/${id}`, {
          method: "DELETE",
          headers: { "X-CSRF-TOKEN": token }
        })
        .then(res => res.json())
        .then(data => {
          if (data.status === "success") {
            button.closest("tr").remove();
          }
          alert(data.message);
        })
        .catch(err => alert("Terjadi kesalahan: " + err));
      }
    }
  </script>
</body>
</html>
