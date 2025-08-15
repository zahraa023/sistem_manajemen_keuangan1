<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Keuangan Masjid</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/datalap.css') }}" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

  <!-- HEADER -->
  <div class="header">
    MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI
  </div>

  <!-- TOMBOL BACK -->
  <div class="circle-back-wrapper">
    <a href="/welcome" class="circle-back-button" title="Kembali ke Beranda">
      <i class="fas fa-arrow-left"></i>
    </a>
  </div>

  <!-- KONTEN UTAMA -->
  <div class="container">
    <div class="page-title">LAPORAN KEUANGAN</div>

    <!-- FORM FILTER BULAN -->
    <div style="margin-bottom: 20px; text-align: left; padding-left: 40px;">
      <label for="bulanFilter" style="font-weight: bold; margin-right: 10px;">Pilih Bulan</label>
      <select id="bulanFilter" onchange="filterBulan()" style="padding: 8px 12px; border-radius: 6px; border: 1px solid #ccc;">
        <option value="">Semua</option>
        @foreach($bulan as $b)
          @php
            $val = $b->tahun . '-' . str_pad($b->bulan, 2, '0', STR_PAD_LEFT);
            $label = date('F Y', strtotime($val.'-01'));
          @endphp
          <option value="{{ $val }}">{{ $label }}</option>
        @endforeach
      </select>
    </div>

    <!-- TOMBOL TAB -->
    <div class="filter-buttons">
      <button onclick="tampilkanKonten('mingguan')" id="btn-mingguan" class="active-tab">
        <i class="fas fa-file-alt"></i> PER MINGGU
      </button>
      <button onclick="tampilkanKonten('bulanan')" id="btn-bulanan">
        <i class="fas fa-calendar-alt"></i> PER BULAN
      </button>
      <button onclick="tampilkanKonten('rincian')" id="btn-rincian">
        <i class="fas fa-info-circle"></i> RINCIAN TRANSAKSI
      </button>
    </div>

    <!-- === KONTEN MINGGUAN === -->
    <div class="konten" id="mingguan">
      <div class="transactions">
        @php
          $saldo = 0;
        @endphp
        @foreach($transaksis as $t)
          @php
            $saldo += $t->pemasukan - $t->pengeluaran;
          @endphp
          <h4 data-bulan="{{ $t->created_at->format('Y-m') }}">
            {{ $t->created_at->format('d-m-Y') }}
          </h4>
          <table class="transaction-table" data-bulan="{{ $t->created_at->format('Y-m') }}">
            <thead>
              <tr><th>Transaksi</th><th>Pemasukan</th><th>Pengeluaran</th><th>Saldo</th></tr>
            </thead>
            <tbody>
              <tr>
                <td>{{ $t->nama_transaksi }}</td>
                <td class="amount-green">{{ $t->pemasukan ? 'Rp '.number_format($t->pemasukan,0,',','.') : '' }}</td>
                <td class="amount-red">{{ $t->pengeluaran ? 'Rp '.number_format($t->pengeluaran,0,',','.') : '' }}</td>
                <td class="amount-bold">{{ 'Rp '.number_format($saldo,0,',','.') }}</td>
              </tr>
            </tbody>
          </table>
        @endforeach
      </div>
    </div>

    <!-- === KONTEN BULANAN === -->
    <div class="konten" id="bulanan" style="display:none;">
      <div class="transactions">
        @php
          $saldoBulanan = [];
        @endphp
        @foreach($transaksis->groupBy(fn($t) => $t->created_at->format('Y-m')) as $bln => $trans)
          <div data-bulan="{{ $bln }}">
            <h4>Laporan Bulanan: {{ date('F Y', strtotime($bln.'-01')) }}</h4>
            <table class="transaction-table">
              <thead>
                <tr><th>#</th><th>Transaksi</th><th>Pemasukan</th><th>Pengeluaran</th><th>Saldo</th></tr>
              </thead>
              <tbody>
                @php $saldo = 0; @endphp
                @foreach($trans as $i => $t)
                  @php $saldo += $t->pemasukan - $t->pengeluaran; @endphp
                  <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $t->nama_transaksi }}</td>
                    <td>{{ $t->pemasukan ? 'Rp '.number_format($t->pemasukan,0,',','.') : '' }}</td>
                    <td>{{ $t->pengeluaran ? 'Rp '.number_format($t->pengeluaran,0,',','.') : '' }}</td>
                    <td>{{ 'Rp '.number_format($saldo,0,',','.') }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endforeach
      </div>
    </div>

    <!-- === KONTEN RINCIAN === -->
    <div class="konten" id="rincian" style="display:none;">
      <div class="transactions">
        @foreach($transaksis as $t)
          <div data-bulan="{{ $t->created_at->format('Y-m') }}">
            <h4>{{ $t->created_at->format('d-m-Y') }}</h4>
            <table class="transaction-table">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>Transaksi</th>
                  <th>Pemasukan</th>
                  <th>Pengeluaran</th>
                  <th>Saldo</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ $t->created_at->format('d-m-Y') }}</td>
                  <td>{{ $t->nama_transaksi }}</td>
                  <td>{{ $t->pemasukan ? 'Rp '.number_format($t->pemasukan,0,',','.') : '' }}</td>
                  <td>{{ $t->pengeluaran ? 'Rp '.number_format($t->pengeluaran,0,',','.') : '' }}</td>
                  <td>{{ 'Rp '.number_format($t->pemasukan - $t->pengeluaran,0,',','.') }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        @endforeach
      </div>
    </div>

  </div> <!-- end container -->

  <!-- FOOTER -->
  <div class="footer">
    <div class="info">
      <p><i class="fas fa-map-marker-alt icon"></i>Canduang Koto Laweh, Kec. Candung, Kabupaten Agam, Sumatera Barat 26192</p>
      <p><i class="fas fa-phone icon"></i>0812 6690 970</p>
      <p><i class="fab fa-facebook icon"></i>MuhammadIdrusRamli</p>
    </div>
    <div class="maps">
      <p>Lokasi MASJID JAMI' (SURAU GADANG) SIDANG SEBUAH BALAI</p>
      <iframe
        src="https://www.google.com/maps?q=PF38%2BC3P%2C+Canduang+Koto+Laweh%2C+Kec.+Candung%2C+Kabupaten+Agam%2C+Sumatera+Barat+26192&output=embed"
        allowfullscreen="" loading="lazy">
      </iframe>
    </div>
  </div>

  <!-- SCRIPT -->
  <script>
    function tampilkanKonten(id) {
      document.querySelectorAll('.konten').forEach(k => k.style.display = 'none');
      document.getElementById(id).style.display = 'block';
      document.querySelectorAll('.filter-buttons button').forEach(btn => btn.classList.remove('active-tab'));
      document.getElementById('btn-' + id).classList.add('active-tab');
      filterBulan();
    }

    function filterBulan() {
      const bulanDipilih = document.getElementById('bulanFilter').value;
      document.querySelectorAll('[data-bulan]').forEach(el => {
        el.style.display = (bulanDipilih === '' || el.getAttribute('data-bulan') === bulanDipilih) ? '' : 'none';
      });
    }

    document.addEventListener('DOMContentLoaded', () => {
      tampilkanKonten('mingguan');
      filterBulan();
    });
  </script>

</body>
</html>
