<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Kelompok Donasi</title>
  <link href="{{ asset('css/dash.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    .container { padding: 20px; }
    table { width: 100%; border-collapse: collapse; background: #e5e5e5; margin-bottom: 20px; }
    th, td { border: 1px solid #444; padding: 10px; text-align: left; }
    .btn-group { display: flex; gap: 10px; }
    .btn-group button { background-color: #4CAF50; border: none; color: white; padding: 6px 12px; cursor: pointer; }
    .edit-form { display: none; margin-top: 10px; background: white; padding: 10px; border-radius: 8px; }
    .edit-form input { padding: 6px; margin-right: 10px; }
    .edit-form button { padding: 6px 12px; background-color: #4CAF50; color: white; border: none; }
    .masjid-title { font-size: 22px; text-align: center; margin: 20px 0; }
    .galeri-img { width: 80px; margin: 3px; border-radius: 5px; }
  </style>
</head>
<body>

  <div class="masjid-title">Kelompok Donasi</div>
  <div class="container">

    <!-- Donasi Toilet -->
    <h2>Donasi Untuk Toilet</h2>
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
            <img src="{{ asset('images/toilet1.jpg') }}" class="galeri-img" onerror="this.src='https://via.placeholder.com/80?text=Toilet1'">
            <img src="{{ asset('images/toilet2.jpg') }}" class="galeri-img" onerror="this.src='https://via.placeholder.com/80?text=Toilet2'">
          </td>
          <td>
            <div class="btn-group">
              <button onclick="toggleEditForm('form-toilet-1')">Edit</button>
              <button onclick="alert('Hapus data dummy Toilet 1')">Hapus</button>
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

    <!-- Donasi Karpet -->
    <h2>Donasi Untuk Karpet</h2>
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
            <img src="{{ asset('images/karpet1.jpg') }}" class="galeri-img" onerror="this.src='https://via.placeholder.com/80?text=Karpet1'">
          </td>
          <td>
            <div class="btn-group">
              <button onclick="toggleEditForm('form-karpet-1')">Edit</button>
              <button onclick="alert('Hapus data dummy Karpet 1')">Hapus</button>
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

  <script>
    function toggleEditForm(id) {
      const el = document.getElementById(id);
      el.style.display = (el.style.display === 'table-row') ? 'none' : 'table-row';
    }
  </script>

</body>
</html>
