<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login & Register User</title>
  <link href="{{ asset('css/loginuser.css') }}" rel="stylesheet" />
  <style>
    .hidden { display: none; }
    .toggle-link span { color: blue; cursor: pointer; }
  </style>
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
        {{-- Flash Message --}}
        @if(session('success'))
          <div style="color: green; margin-bottom: 10px;">{{ session('success') }}</div>
        @endif

        @if($errors->any())
          <div style="color: red; margin-bottom: 10px;">
            <ul>
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        {{-- Form login hanya template jika nanti kamu sambungkan ke Laravel --}}
        <form method="POST" action="'/'">
          @csrf
          <label for="email">Email</label>
          <input type="email" name="email" placeholder="Masukkan Email" required />

          <label for="password">Password</label>
          <input type="password" name="password" placeholder="Masukkan Password" required />

          <button type="submit">LOGIN</button>
        </form>
        <div class="toggle-link">Belum punya akun? <span onclick="showRegister()">Daftar</span></div>
      </div>

      <!-- Register Form -->
      <div class="login-box hidden" id="registerBox">
        <h2>Register User</h2>
        <form method="POST" action="/registeruser">
          @csrf
          <label for="newUsername">Username Baru</label>
          <input type="text" name="name" placeholder="Username Baru" required />

          <label for="newEmail">Email Baru</label>
          <input type="email" name="email" placeholder="Email Baru" required />

          <label for="newPassword">Password Baru</label>
          <input type="password" name="password" placeholder="Password Baru" required />

          <button type="submit">DAFTAR</button>
        </form>
        <div class="toggle-link">Sudah punya akun? <span onclick="showLogin()">Login</span></div>
      </div>
    </div>
  </div>

  <script>
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
