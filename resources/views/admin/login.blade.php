<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link href="{{ asset('css/loginadmin.css') }}" rel="stylesheet" />
  
</head>
<body>
  <div class="container">
    <div class="left-side">
      <a href="/landingpage" class="back-image-button" title="Kembali ke Home">&#8592;</a>
      <img src="{{ asset('asset/mimbar.png') }}" alt="Masjid">
    </div>
    <div class="right-side">
      <div class="login-box">
        <h2>Halaman Login</h2>

        <!-- Tab Pilihan Role -->
        <div class="role-tabs">
          <button class="role-tab active" onclick="switchTab('admin')">ADMIN</button>
          <button class="role-tab" onclick="switchTab('bendahara')">BENDAHARA</button>
        </div>

        <!-- Form Admin -->
        <div class="login-section active" id="admin">
          <h3>Login Ke Halaman Admin</h3>
          <form onsubmit="return handleLogin(event, 'admin')">
            <label for="admin-email">Email</label>
            <input type="text" id="admin-email" placeholder="Masukkan Email" required />
            <label for="admin-password">Password</label>
            <input type="password" id="admin-password" placeholder="Masukkan Password" required />
            <button type="submit">LOGIN</button>
          </form>
        </div>

        <!-- Form Bendahara -->
        <div class="login-section" id="bendahara">
          <h3>Login Ke Halaman Bendahara</h3>
          <form onsubmit="return handleLogin(event, 'bendahara')">
            <label for="bendahara-email">Email</label>
            <input type="text" id="bendahara-email" placeholder="Masukkan Email" required />
            <label for="bendahara-password">Password</label>
            <input type="password" id="bendahara-password" placeholder="Masukkan Password" required />
            <button type="submit">LOGIN</button>
          </form>
        </div>

      </div>
    </div>
  </div>

  <script>
    function switchTab(role) {
      const tabs = document.querySelectorAll('.role-tab');
      const sections = document.querySelectorAll('.login-section');

      tabs.forEach(tab => tab.classList.remove('active'));
      sections.forEach(section => section.classList.remove('active'));

      document.querySelector(`.role-tab[onclick="switchTab('${role}')"]`).classList.add('active');
      document.getElementById(role).classList.add('active');
    }

    function handleLogin(event, role) {
      event.preventDefault();

      const username = document.getElementById(role + '-email').value.trim();
      const password = document.getElementById(role + '-password').value.trim();

      if (role === "admin" && username === "admin@gmail.com" && password === "admin123") {
        alert("Login Admin Berhasil!");
        window.location.href = "/dashboard";
      } else if (role === "bendahara" && username === "bendahara@gmail.com" && password === "bendahara123") {
        alert("Login Bendahara Berhasil!");
        window.location.href = "/dashben";
      } else {
        alert("Username atau Password salah!");
      }
    }
  </script>
</body>
</html>
