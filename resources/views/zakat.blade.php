<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="{{ asset('css/zakat.css') }}" rel="stylesheet" />
</head>
<body>

<!-- ========== HEADER ========== -->
  <div class="header">
    <div class="header-left">
      <button class="back-button" onclick="window.location.href='/welcome'">
        <i class="fas fa-arrow-left"></i>
      </button>
    </div>
    <div class="header-center">
      <h1 class="masjid-title">MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI</h1>
    </div>
  </div>

  <section class="hero-section">
    <h1>Form Pembayaran Zakat</h1>
    <p>Bayarkan zakat Anda dengan mudah melalui sistem online Masjid Jami'.</p>
  </section>

  <section class="jenis-zakat fade-in">
  <h2><i class="fas fa-book-quran"></i> Jenis-Jenis Zakat</h2>

  <ul class="zakat-list">
    <li>
      <strong>✨ Zakat Fitrah:</strong>  
      Dikeluarkan saat Ramadan, sebelum Idul Fitri. Bentuknya beras 2,5 kg atau uang senilai.
    </li>
    <li>
      <strong>💰 Zakat Mal:</strong>  
      Dari harta (emas, tabungan, usaha) yang telah mencapai nisab dan haul (1 tahun). Besaran 2,5%.
    </li>
    <li>
      <strong>🧾 Zakat Penghasilan:</strong>  
      Dari gaji atau pendapatan rutin bulanan. Besaran 2,5% dari penghasilan bersih.
    </li>
  </ul>
</section>


  <section class="form-container fade-in">
    <h3><i class="fas fa-hand-holding-heart"></i> Formulir Pembayaran Zakat</h3>
    <form id="formZakat">
      <input type="text" id="nama" name="nama" placeholder="🧕 Nama Muzakki" required>
      <input type="number" id="jumlah" name="jumlah" placeholder="💰 Jumlah Zakat (Rp)" required>

      <select id="jenisZakat" name="jenisZakat" required>
        <option value="">🗂️ Jenis Zakat</option>
        <option value="Zakat Fitrah">Zakat Fitrah</option>
        <option value="Zakat Mal">Zakat Mal</option>
        <option value="Zakat Penghasilan">Zakat Penghasilan</option>
      </select>

      <select id="metodeZakat" name="metodeZakat" onchange="toggleQRZakat()" required>
        <option value="">💳 Metode Pembayaran</option>
        <option value="QR">QR (e-Wallet)</option>
      </select>

      <div id="qrZakat" class="qr-section" style="display: none;">
        <h4>Scan QR untuk Membayar</h4>
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=Zakat+Masjid+Jami" alt="QR Zakat">
        <p>Gunakan aplikasi e-wallet Anda</p>
      </div>

      <div id="buktiZakatContainer" class="upload-section" style="display: none;">
        <label for="buktiTransfer">📤 Upload Bukti Transfer</label>
        <input type="file" id="buktiTransfer" name="buktiTransfer" accept="image/*">
      </div>

      <button type="submit"><i class="fas fa-paper-plane"></i> Bayar Zakat Sekarang</button>
    </form>
    
  </section>
 <!-- Tabel Donatur -->
      <div class="tabel-donatur">
        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Donatur</th>
              <th>Jumlah Zakat</th>
              <th>Jenis Zakat</th>
              <th>Metode</th>
            </tr>
          </thead>
          <tbody id="tabelDonatur">
            <tr>
              <td>1</td>
              <td>Ahmad Z</td>
              <td>Rp100.000</td>
              <td>Zakat Mal</td>
              <td>QR</td>
            </tr>
          </tbody>
          <tfoot>
            <tr style="background-color: #e0f7e0; font-weight: bold;">
              <td colspan="3" style="text-align: right;">Total Donasi</td>
              <td id="totalDonasi">Rp100.000</td>
              <td></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>

  <script>
    function toggleQRZakat() {
      const metode = document.getElementById("metodeZakat").value;
      const qrDiv = document.getElementById("qrZakat");
      const buktiDiv = document.getElementById("buktiZakatContainer");

      qrDiv.style.display = (metode === "QR") ? "block" : "none";
      buktiDiv.style.display = (metode === "QR") ? "block" : "none";
    }

    document.getElementById("formZakat").addEventListener("submit", function(e) {
      e.preventDefault();
      alert("✅ Terima kasih! Zakat Anda telah tercatat.");
    });
  </script>

</body>
</html>
