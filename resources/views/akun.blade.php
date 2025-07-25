<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Halaman Akun</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/akun.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

  <!-- ========== HEADER ========== -->
  <div class="header">
  <!-- Tombol panah kembali -->
  <button class="back-button" onclick="window.location.href='/'">
    <i class="fas fa-arrow-left"></i>
  </button>
    <div class="header-title">MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI</div>
    <button class="logout-btn" onclick="window.location.href='/loginuser'">
      <i class="fas fa-sign-out-alt"></i> Logout
    </button>
  </div>

  <!-- KONTAINER UTAMA -->
  <div class="container">
    <h2>Data Akun</h2>
    <div class="akun-info">
      <p><strong>Username:</strong> zahra</p>
      <p><strong>Password:</strong> 123456</p>
      <p><strong>Email:</strong> zahra234@gmail.com</p>
    </div>

    <button class="edit-btn" onclick="bukaPopupAkun()">Edit Akun</button>
  </div>

  <!-- POPUP EDIT AKUN -->
  <div id="popupAkun">
    <div class="popup-content">
      <h3>Edit Akun</h3>

      <label>Nama</label>
      <input type="text" id="namaAkun" placeholder="Masukkan nama">
      <label>Email</label>
      <input type="text" id="namaEmail" placeholder="Masukkan email">

      <label>Password</label>
      <input type="password" id="passwordAkun" placeholder="Masukkan password">

      <div class="popup-footer">
        <button class="simpan-btn" onclick="simpanAkun()">Simpan</button>
        <button class="batal-btn" onclick="tutupPopup()">Batal</button>
      </div>
    </div>
  </div>

  <!-- JAVASCRIPT -->
  <script>
    function bukaPopupAkun() {
      document.getElementById('popupAkun').style.display = 'flex';
    }

    function tutupPopup() {
      document.getElementById('popupAkun').style.display = 'none';
    }

    function simpanAkun() {
      const nama = document.getElementById('namaAkun').value;
      const password = document.getElementById('passwordAkun').value;

      if (nama && password) {
        alert("Data akun disimpan:\nNama: " + nama);
        tutupPopup();
      } else {
        alert("Semua kolom harus diisi.");
      }
    }
  </script>

</body>
</html>
