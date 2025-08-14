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

      <!-- Filter -->
      <form method="GET" action="{{ route('laporanadmin') }}">
        <label for="filter">Filter:</label>
        <select name="filter" id="filter" onchange="this.form.submit()">
          <option value="">Semua</option>
          <option value="minggu" {{ request('filter') === 'minggu' ? 'selected' : '' }}>Minggu Ini</option>
          <option value="bulan" {{ request('filter') === 'bulan' ? 'selected' : '' }}>Bulan Ini</option>
          <option value="tahun" {{ request('filter') === 'tahun' ? 'selected' : '' }}>Tahun Ini</option>
        </select>
      </form>

      <!-- Tombol tambah -->
      <button class="btn-tambah" onclick="openForm()">+ Tambah Data</button>

      <!-- Judul filter otomatis -->
      <h3 id="judulFilter" style="margin-top: 10px; color: #333;">
        {{ $judul ?? '' }}
      </h3>

      <!-- Tabel -->
      <table class="transaction-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nama Transaksi</th>
            <th>Pemasukan</th>
            <th>Pengeluaran</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($transaksis as $index => $t)
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
      </table>
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

        <label>Pemasukan:</label>
        <input type="number" id="formPemasukan" />

        <label>Pengeluaran:</label>
        <input type="number" id="formPengeluaran" />

        <button type="submit" class="btn-save">Simpan</button>
        <button type="button" class="btn-delete" onclick="closeForm()">Batal</button>
      </form>
    </div>
  </div>

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

    // --- Judul otomatis sesuai filter ---
    function updateJudulFilter() {
      const filter = document.getElementById("filter").value;
      const judulElement = document.getElementById("judulFilter");

      switch(filter) {
        case "minggu":
          judulElement.innerText = "Minggu Ini";
          break;
        case "bulan":
          judulElement.innerText = "Bulan Ini";
          break;
        case "tahun":
          judulElement.innerText = "Tahun Ini";
          break;
        default:
          judulElement.innerText = "";
      }
    }

    // Jalankan saat halaman dimuat
    updateJudulFilter();

    // Update otomatis saat filter berubah
    document.getElementById("filter").addEventListener("change", updateJudulFilter);
  </script>

</body>
</html>
