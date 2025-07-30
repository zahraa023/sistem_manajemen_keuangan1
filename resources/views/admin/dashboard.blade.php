<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Admin</title>
  <link href="{{ asset('css/dash.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .btn-white {
      background-color: white;
      color: black;
      border: 1px solid #ccc;
      padding: 8px 16px;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
    }
    .sidebar button.active {
      background-color: #4CAF50;
      color: white;
    }
  </style>
</head>
<body>

  <!-- HEADER -->
  <div class="header" style="background-color:#2f2f2f; color:white; padding:15px; font-weight:bold; text-align:center; position:relative;">
    MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI
    <a class="logout-button" href="/login" title="Kembali ke landingpage" style="position:absolute; right:20px; top:50%; transform:translateY(-50%); background-color:#e74c3c; color:white; border:none; padding:8px 14px; border-radius:6px; font-weight:bold; cursor:pointer; font-size:13px;">
      <i class="fas fa-arrow-left"></i>
    </a>
  </div>

  <!-- CONTAINER -->
  <div class="container" style="display:flex; height:calc(100vh - 50px);">
    <!-- SIDEBAR -->
    <div class="sidebar" style="background-color:#2f2f2f; width:200px; display:flex; flex-direction:column; padding-top:10px;">
      <button class="active" onclick="showContent('dashboard', event)">Dashboard Admin</button>
      <button onclick="window.location.href='/adminpanel'">Admin Panel</button>
      <button onclick="window.location.href='/donatur'">Donatur</button>
      <button onclick="showContent('kelompok donasi', event)">Kelompok Donasi</button>
    </div>

    <!-- MAIN CONTENT -->
    <div class="content" id="mainContent" style="flex:1; padding: 20px;"></div>
  </div>

  <!-- LIBRARIES -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

  <!-- SCRIPT -->
  <script>
    function showContent(page, event = null) {
      const buttons = document.querySelectorAll('.sidebar button');
      buttons.forEach(btn => btn.classList.remove('active'));
      if (event) event.target.classList.add('active');

      const main = document.getElementById('mainContent');

      if (page === 'dashboard') {
        main.innerHTML = `
          <h2>DASHBOARD ADMIN</h2>
          <div style="display: flex; gap: 20px; margin-top: 20px;">
            <div class="dashboard-card" style="flex: 1; border-left: 4px solid #4CAF50; padding: 10px; background: #fff; border-radius: 6px;">
              <h3 style="margin-bottom: 8px; color:#2f2f2f; font-size: 16px;">
                <i class="fa fa-users" style="margin-right: 6px; color:#4caf50; font-size: 14px;"></i> Jumlah User
              </h3>
              <p style="font-size: 1.5rem; font-weight: bold; color: #333; margin: 0;">20 Orang</p>
              <p style="color: #666; margin-top: 3px; font-size: 13px;">Data pengguna aktif yang terdaftar saat ini</p>
            </div>
            <div class="dashboard-card" style="flex: 1; border-left: 4px solid #4CAF50; padding: 10px; background: #fff; border-radius: 6px;">
              <h3 style="margin-bottom: 8px; color:#2f2f2f; font-size: 16px;">
                <i class="fa fa-hand-holding-heart" style="margin-right: 6px; color:#4caf50; font-size: 14px;"></i> Jumlah Donatur
              </h3>
              <p style="font-size: 1.5rem; font-weight: bold; color: #333; margin: 0;">15 Orang</p>
              <p style="color: #666; margin-top: 3px; font-size: 13px;">Total donatur yang telah berkontribusi</p>
            </div>
          </div>

          <h2 style="margin-top: 40px;">Data User</h2>
          <input type="text" id="searchUser" onkeyup="filterUser()" placeholder="Cari..." style="margin-top: 10px; padding: 8px; width: 100%; max-width: 300px;">
          <table id="userTable" border="1" cellspacing="0" cellpadding="5" style="width: 100%; margin-top: 10px; border-collapse: collapse;">
            <thead>
              <tr style="background-color: #f0f0f0;">
                <th>No</th>
                <th>Nama User</th>
                <th>Email</th>
                <th>Role</th>
              </tr>
            </thead>
            <tbody id="userTableBody"></tbody>
          </table>
        `;

        const users = [
          { nama: 'admin', email: '-', role: 'admin' },
          { nama: 'bendahara', email: '-', role: 'admin' },
          { nama: 'zahra', email: 'zahra123@gmail.com', role: 'user' }
        ];

        const tbody = document.getElementById('userTableBody');
        tbody.innerHTML = '';
        users.forEach((user, index) => {
          const row = document.createElement('tr');
          row.innerHTML = `
            <td>${index + 1}</td>
            <td>${user.nama}</td>
            <td>${user.email}</td>
            <td>${user.role}</td>
          `;
          tbody.appendChild(row);
        });

      } else if (page === 'kelompok donasi') {
        main.innerHTML = `
          <h2>Kelompok Donasi</h2>
          <p>Konten tentang kelompok donasi akan ditampilkan di sini.</p>
        `;
      }
    }

    function filterUser() {
      const filter = document.getElementById('searchUser').value.toLowerCase();
      const rows = document.querySelectorAll('#userTableBody tr');
      rows.forEach(row => {
        const nama = row.cells[1].textContent.toLowerCase();
        const email = row.cells[2].textContent.toLowerCase();
        const role = row.cells[3].textContent.toLowerCase();
        row.style.display = (nama.includes(filter) || email.includes(filter) || role.includes(filter)) ? '' : 'none';
      });
    }

    window.onload = function () {
      showContent('dashboard');
    };
  </script>

</body>
</html>
