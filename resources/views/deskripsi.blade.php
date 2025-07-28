
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="{{ asset('css/desk.css') }}" rel="stylesheet" />
</head>
<body>

  <!-- ========== HEADER ========== -->
  <div class="header">
    <div class="header-left">
      <button class="back-button" onclick="window.location.href='/donasi'">
        <i class="fas fa-arrow-left"></i>
      </button>
    </div>
    <div class="header-center">
      <h1 class="masjid-title">MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI</h1>
    </div>
  </div>

  <!-- Hero Section -->
  <div class="hero"></div>

  <!-- Tombol DONASI -->
  <div class="container">
    <h1 class="title">Donasi Untuk Pembangunan Toilet</h1>
    <div class="donation-summary">
      <h2>Terkumpul</h2>
      <h1>Rp 852.000</h1>
      <div class="progress-bar">
        <div class="fill"></div>
      </div>
      <p style="font-size: 13px;">128 hari lagi - 0% target Rp 132.400.000</p>
      <button class="btn-donasi" onclick="toggleForm()">DONASI SEKARANG</button>
    </div>
  </div>

  <!-- ========== POPUP MODAL FORM DONASI ========== -->
  <div id="formPopup" class="modal-popup">
    <div class="modal-content">
      <span class="close-btn" onclick="closePopup()">&times;</span>
      <h3>Form Donasi Pembangunan Toilet</h3>
      <form>
        <input type="text" placeholder="Nama Donatur" required>
        <input type="date" required>
        <input type="text" placeholder="Jumlah Donasi (Rp)" required>
        <select id="metode" onchange="toggleQR()" required>
          <option value="">-- Pilih Metode --</option>
          <option value="QR">QR</option>
          <option value="Cash">Cash</option>
        </select>

        <div id="qrDonasi" class="qr-box" style="display: none;">
          <h4>Scan QR untuk Donasi</h4>
          <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=Donasi+Masjid+Jami" alt="QR Code">
          <p>Gunakan aplikasi e-wallet Anda</p>
        </div>

        <div id="buktiTransferContainer" style="display: none; margin-top: 10px;">
          <label>Upload Bukti Transfer</label>
          <input type="file" accept="image/*">
        </div>

        <button type="submit">Kirim Donasi</button>
      </form>
    </div>
  </div>

  <!-- ========== ULASAN KOMENTAR ========== -->
  <div class="review-section">
    <div class="review-container">
      <div class="review-header">
        <h2 class="review-title">Komentar</h2>
        <button class="toggle-review-btn" onclick="toggleReview()">+ Komentar</button>
      </div>

      <div class="review-form" id="reviewForm" style="display: none;">
        <label class="review-label" for="comment">Komentar Anda</label>
        <textarea id="comment" placeholder="Tulis komentar Anda di sini..." class="review-textarea"></textarea>

        <div class="review-buttons">
          <button class="review-cancel" onclick="handleCancel()">Batal</button>
          <button class="review-submit" onclick="handleSave()">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <!-- ========== FOOTER ========== -->
  <div class="footer">
    <div class="info">
      <p><i class="fas fa-map-marker-alt icon"></i> Canduang Koto Laweh, Kec. Candung, Kabupaten Agam, Sumatera Barat 26192</p>
      <p><i class="fas fa-phone icon"></i> 0812 6690 970</p>
      <p><i class="fab fa-facebook icon"></i> MuhammadIdrusRamli</p>
    </div>
    <div class="maps">
      <p>Lokasi MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI</p>
      <iframe src="https://www.google.com/maps?q=PF38%2BC3P%2C+Canduang+Koto+Laweh%2C+Kec.+Candung%2C+Kabupaten+Agam%2C+Sumatera+Barat+26192&output=embed" allowfullscreen="" loading="lazy"></iframe>
    </div>
  </div>

  <!-- ========== SCRIPT ========== -->
  <script>
    function toggleForm() {
      const popup = document.getElementById("formPopup");
      popup.style.display = "block";
    }

    function closePopup() {
      const popup = document.getElementById("formPopup");
      popup.style.display = "none";
    }

    function toggleQR() {
      const metode = document.getElementById("metode").value;
      const qr = document.getElementById("qrDonasi");
      const bukti = document.getElementById("buktiTransferContainer");

      qr.style.display = metode === "QR" ? "block" : "none";
      bukti.style.display = metode === "QR" ? "block" : "none";
    }

    function toggleReview() {
      const form = document.getElementById("reviewForm");
      const btn = document.querySelector(".toggle-review-btn");

      if (form.style.display === "none") {
        form.style.display = "block";
        btn.textContent = "Tutup";
      } else {
        form.style.display = "none";
        btn.textContent = "+ Komentar";
      }
    }

    function handleSave() {
      const comment = document.getElementById("comment").value.trim();

      if (!comment) {
        alert("Mohon isi komentar terlebih dahulu.");
        return;
      }

      alert("Terima kasih atas komentar Anda!");
      document.getElementById("comment").value = "";
      toggleReview();
    }

    function handleCancel() {
      if (confirm("Yakin ingin membatalkan?")) {
        document.getElementById("comment").value = "";
        toggleReview();
      }
    }

    // Tutup popup jika klik di luar modal
    window.onclick = function (e) {
      const popup = document.getElementById("formPopup");
      if (e.target === popup) {
        closePopup();
      }
    }
  </script>

</body>
</html>
