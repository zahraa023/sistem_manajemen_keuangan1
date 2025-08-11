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
      <a href='/' class="back-image-button" title="Kembali ke Home">&#8592;</a>
      <img src="{{ asset('asset/mimbar.png') }}" alt="Masjid">
    </div>

    <div class="right-side">
      <div class="login-box">
        <h2>Halaman Login</h2>

        <div class="role-tabs">
          <button type="button" class="role-tab active" onclick="switchTab('admin', event)">ADMIN</button>
          <button type="button" class="role-tab" onclick="switchTab('bendahara', event)">BENDAHARA</button>
        </div>

        <form method="POST" action="{{ route('login') }}">
          @csrf
          <input type="hidden" name="role" id="login-role" value="admin" />
          
          <label for="email">Email</label>
          <input type="text" name="email" id="email" placeholder="Masukkan Email" required />

          <label for="password">Password</label>
          <input type="password" name="password" id="password" placeholder="Masukkan Password" required />

          <button type="submit">LOGIN</button>
        </form>

        @if ($errors->any())
          <div style="color: red; margin-top: 10px;">
            @foreach ($errors->all() as $error)
              <div>{{ $error }}</div>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </div>

  <script>
  function switchTab(role, event) {
    document.getElementById("login-role").value = role;
    document.querySelectorAll('.role-tab').forEach(tab => tab.classList.remove('active'));
    event.target.classList.add('active');
  }
  </script>
</body>
</html>
