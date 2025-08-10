<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Kelompok Donasi</title>

  <!-- CSS Utama -->
  <link rel="stylesheet" href="{{ asset('css/keldonasi.css') }}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>

  <!-- Header -->
  <div class="header">
    <button class="back-button" onclick="window.location.href='/dashben'">
      <i class="fas fa-arrow-left"></i>
    </button>
    Manajemen Donasi Masjid
  </div>

  <!-- Container -->
  <div class="container">

    <!-- Sidebar -->
    <div class="sidebar">
      
      <button class="active">Kelompok Donasi</button>
    </div>

    <!-- Content -->
    <div class="content">
      <h2>Kelompok Donasi</h2>

      <!-- Donasi Toilet -->
      <div class="dashboard-card">
        <h3>Donasi Untuk Toilet</h3>
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Target</th>
              <th>Terkumpul</th>
              <th>Galeri</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Rp 10.000.000</td>
              <td>Rp 4.500.000</td>
              <td>
                <img src="{{ asset('asset/image.png') }}" class="galeri-img" onerror="this.src='https://via.placeholder.com/80?text=Toilet1'">
                <img src="{{ asset('asset/bg3.jpg') }}" class="galeri-img" onerror="this.src='https://via.placeholder.com/80?text=Toilet2'">
              </td>
              <td>
                <div class="btn-group">
                  <button onclick="toggleEditForm('form-toilet-1')">Edit</button>
                  <button class="hapus-btn" onclick="alert('Hapus data dummy Toilet 1')">Hapus</button>
                </div>
              </td>
            </tr>
            <tr id="form-toilet-1" class="edit-form">
              <td colspan="5">
                <form onsubmit="alert('Data dummy Toilet diperbarui'); return false;">
                  <input type="number" name="target" placeholder="Target" value="10000000" required>
                  <input type="number" name="terkumpul" placeholder="Terkumpul" value="4500000" required>
                  <input type="file" name="galeri[]" multiple accept="image/*">
                  <button type="submit">Simpan</button>
                </form>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Donasi Karpet -->
      <div class="dashboard-card">
        <h3>Donasi Untuk Karpet</h3>
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Target</th>
              <th>Terkumpul</th>
              <th>Galeri</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Rp 20.000.000</td>
              <td>Rp 6.000.000</td>
              <td>
                <img src="{{ asset('asset/bg3.jpg') }}" class="galeri-img" onerror="this.src='https://via.placeholder.com/80?text=Karpet1'">
              </td>
              <td>
                <div class="btn-group">
                  <button onclick="toggleEditForm('form-karpet-1')">Edit</button>
                  <button class="hapus-btn" onclick="alert('Hapus data dummy Karpet 1')">Hapus</button>
                </div>
              </td>
            </tr>
            <tr id="form-karpet-1" class="edit-form">
              <td colspan="5">
                <form onsubmit="alert('Data dummy Karpet diperbarui'); return false;">
                  <input type="number" name="target" placeholder="Target" value="20000000" required>
                  <input type="number" name="terkumpul" placeholder="Terkumpul" value="6000000" required>
                  <input type="file" name="galeri[]" multiple accept="image/*">
                  <button type="submit">Simpan</button>
                </form>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>

  <!-- JS -->
  <script>
    function toggleEditForm(id) {
      const el = document.getElementById(id);
      el.style.display = (el.style.display === 'table-row') ? 'none' : 'table-row';
    }
  </script>

</body>
</html>
