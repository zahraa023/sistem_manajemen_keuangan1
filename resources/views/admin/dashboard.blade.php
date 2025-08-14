<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Admin</title>
  <link href="{{ asset('css/dash.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    #popupPassword {
      display: none;
      position: fixed;
      top:0; left:0; right:0; bottom:0;
      background: rgba(0,0,0,0.5);
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }
    #popupPassword .popup-content {
      background:white;
      padding:20px;
      border-radius:8px;
      width:300px;
    }
    #popupPassword .popup-footer {
      display:flex;
      justify-content:space-between;
      margin-top:15px;
    }
    #userTable button {
      padding: 4px 8px;
      font-size:13px;
      cursor:pointer;
      border-radius:4px;
      border:none;
      background-color:#4CAF50;
      color:white;
    }
    #userTable button:hover { background-color:#45a049; }
  </style>
</head>
<body>

  <div class="header" style="background-color:#2f2f2f; color:white; padding:15px; font-weight:bold; text-align:center; position:relative;">
    MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI
    <a class="logout-button" href="/login" title="Kembali ke landingpage" style="position:absolute; right:20px; top:50%; transform:translateY(-50%); background-color:#e74c3c; color:white; border:none; padding:8px 14px; border-radius:6px; font-weight:bold; cursor:pointer; font-size:13px;">
      <i class="fas fa-arrow-left"></i>
    </a>
  </div>

  <div class="container" style="display:flex; height:calc(100vh - 50px);">
    <div class="sidebar" style="background-color:#2f2f2f; width:200px; display:flex; flex-direction:column; padding-top:10px;">
      <button class="active">Dashboard Admin</button>
    </div>

    <div class="content" style="flex:1; padding:20px;">
      <h2>DASHBOARD ADMIN</h2>
      <div style="display:flex; gap:20px; margin-top:20px;">
        <div class="dashboard-card" style="flex:1; border-left:4px solid #4CAF50; padding:10px; background:#fff; border-radius:6px;">
          <h3 style="margin-bottom:8px; color:#2f2f2f; font-size:16px;">
            <i class="fa fa-users" style="margin-right:6px; color:#4caf50; font-size:14px;"></i> Jumlah User
          </h3>
          <p style="font-size:1.5rem; font-weight:bold; color:#333; margin:0;">{{ $users->count() }} Orang</p>
          <p style="color:#666; margin-top:3px; font-size:13px;">Data pengguna aktif yang terdaftar saat ini</p>
        </div>
      </div>

      <h2 style="margin-top:40px;">Data User</h2>
      <input type="text" id="searchUser" onkeyup="filterUser()" placeholder="Cari..." style="margin-top:10px; padding:8px; width:100%; max-width:300px;">
      <table id="userTable" border="1" cellspacing="0" cellpadding="5" style="width:100%; margin-top:10px; border-collapse:collapse;">
        <thead>
          <tr style="background-color:#f0f0f0;">
            <th>No</th>
            <th>Nama User</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $index => $user)
            <tr>
              <td>{{ $index+1 }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->role }}</td>
              <td>
                <button onclick="bukaPopupPassword({{ $user->id }}, '{{ $user->name }}')">Edit Password</button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div id="popupPassword">
    <div class="popup-content">
      <h3>Edit Password User</h3>
      <form id="formEditPassword" method="POST" action="">
    @csrf
    @method('PUT')

    <label>Password Baru</label>
    <input type="password" name="password" required>
    <div class="popup-footer">
        <button type="submit">Simpan</button>
        <button type="button" onclick="tutupPopupPassword()">Batal</button>
    </div>
</form>

    </div>
  </div>

  <script>
    function filterUser() {
      const filter = document.getElementById('searchUser').value.toLowerCase();
      const rows = document.querySelectorAll('#userTable tbody tr');
      rows.forEach(row => {
        const nama = row.cells[1].textContent.toLowerCase();
        const email = row.cells[2].textContent.toLowerCase();
        const role = row.cells[3].textContent.toLowerCase();
        row.style.display = (nama.includes(filter) || email.includes(filter) || role.includes(filter)) ? '' : 'none';
      });
    }

  function bukaPopupPassword(userId, userName) {
    const form = document.getElementById('formEditPassword');
    form.action = `/user/${userId}/update-password`;
    form.reset();
    document.getElementById('popupPassword').style.display = 'flex';
}



    function tutupPopupPassword() {
      document.getElementById('popupPassword').style.display = 'none';
    }
  </script>

</body>
</html>
