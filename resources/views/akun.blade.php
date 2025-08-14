<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Halaman Akun</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/akun.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    /* Contoh style popup */
    #popupAkun {
      display: none;
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.5);
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }
    .popup-content {
      background: white;
      padding: 20px;
      border-radius: 8px;
      width: 300px;
    }
    .popup-footer {
      display: flex;
      justify-content: space-between;
      margin-top: 15px;
    }
  </style>
</head>
<body>

  <!-- HEADER -->
  <div class="header">
    <button class="back-button" onclick="window.location.href='/'">
      <i class="fas fa-arrow-left"></i>
    </button>
    <div class="header-title">MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI</div>
    <form method="POST" action="{{ route('akun.destroy') }}" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="logout-btn">
      <i class="fas fa-sign-out-alt"></i> Logout
    </button>
</form>

  </div>

  <!-- KONTAINER -->
  <div class="container">
    <h2>Data Akun</h2>
    <div class="akun-info">
      <p><strong>Username:</strong> {{ $user->name }}</p>
      <p><strong>Password:</strong> ******</p>
      <p><strong>Email:</strong> {{ $user->email }}</p>
    </div>

    <button class="edit-btn" onclick="bukaPopupAkun()">Edit Akun</button>
  </div>

  <!-- POPUP EDIT AKUN -->
  <div id="popupAkun">
    <div class="popup-content">
      <h3>Edit Akun</h3>
      <form id="formEditAkun" method="POST" action="{{ route('akun.update') }}">
        @csrf
        @method('PUT')

        <label>Nama</label>
        <input type="text" name="name" value="{{ $user->name }}" required>

        <label>Email</label>
        <input type="email" name="email" value="{{ $user->email }}" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Kosongkan jika tidak diubah">

        <div class="popup-footer">
          <button type="submit" class="simpan-btn">Simpan</button>
          <button type="button" class="batal-btn" onclick="tutupPopup()">Batal</button>
        </div>
      </form>
    </div>
  </div>

  <!-- JS -->
  <script>
    function bukaPopupAkun() {
      document.getElementById('popupAkun').style.display = 'flex';
    }
    function tutupPopup() {
      document.getElementById('popupAkun').style.display = 'none';
    }
  </script>

</body>
</html>
