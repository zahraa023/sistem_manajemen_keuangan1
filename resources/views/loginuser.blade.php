<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login & Register User</title>
  <link href="{{ asset('css/loginuser.css') }}" rel="stylesheet" />
</head>
<body>
  <div class="container">
    <div class="left-side">
      <a href="/landingpage" class="back-image-button" title="Kembali ke landingpage">&#8592;</a>
      <img src="{{ asset('asset/mimbar.png') }}" alt="Masjid">
    </div>

    <div class="right-side">
      <!-- Login Form -->
      <div class="login-box" id="loginBox">
        <h2>Login User</h2>
        <form onsubmit="return handleLogin(event)">
          <label for="username">Username</label>
          <input type="text" id="username" placeholder="Masukkan Username" required />

          <label for="email">Email</label>
          <input type="email" id="email" placeholder="Masukkan Email" required />

          <label for="password">Password</label>
          <input type="password" id="password" placeholder="Masukkan Password" required />

          <button type="submit">LOGIN</button>
        </form>
        <div class="toggle-link">Belum punya akun? <span onclick="showRegister()">Daftar</span></div>
      </div>

      <!-- Register Form -->
      <div class="login-box hidden" id="registerBox">
        <h2>Register User</h2>
        <form onsubmit="return handleRegister(event)">
          <label for="newUsername">Username Baru</label>
          <input type="text" id="newUsername" placeholder="Username Baru" required />

          <label for="newEmail">Email Baru</label>
          <input type="email" id="newEmail" placeholder="Email Baru" required />

          <label for="newPassword">Password Baru</label>
          <input type="password" id="newPassword" placeholder="Password Baru" required />

          <button type="submit">DAFTAR</button>
        </form>
        <div class="toggle-link">Sudah punya akun? <span onclick="showLogin()">Login</span></div>
      </div>
    </div>
  </div>

  <script>
    const users = [
      { username: "zahra", email: "zahra234@gmail.com", password: "123456" }
    ];

    function handleLogin(event) {
      event.preventDefault();
      const username = document.getElementById("username").value.trim();
      const email = document.getElementById("email").value.trim();
      const password = document.getElementById("password").value.trim();

      const user = users.find(u => u.username === username && u.email === email && u.password === password);

      if (user) {
        alert("Login berhasil. Selamat datang, " + username + "!");
        window.location.href = "/"; // arahkan ke halaman utama
      } else {
        alert("Username, Email, atau Password salah!");
      }
    }

    function handleRegister(event) {
      event.preventDefault();
      const newUsername = document.getElementById("newUsername").value.trim();
      const newEmail = document.getElementById("newEmail").value.trim();
      const newPassword = document.getElementById("newPassword").value.trim();

      const usernameExists = users.some(u => u.username === newUsername);
      const emailExists = users.some(u => u.email === newEmail);

      if (usernameExists) {
        alert("Username sudah terdaftar!");
        return;
      }

      if (emailExists) {
        alert("Email sudah terdaftar!");
        return;
      }

      users.push({
        username: newUsername,
        email: newEmail,
        password: newPassword
      });

      alert("Pendaftaran berhasil! Silakan login.");
      showLogin();
    }

    function showRegister() {
      document.getElementById("loginBox").classList.add("hidden");
      document.getElementById("registerBox").classList.remove("hidden");
    }

    function showLogin() {
      document.getElementById("registerBox").classList.add("hidden");
      document.getElementById("loginBox").classList.remove("hidden");
    }
  </script>
</body>
</html>
