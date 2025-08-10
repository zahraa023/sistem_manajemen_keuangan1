<!DOCTYPE html> 
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Kelompok Donasi</title>

  <link rel="stylesheet" href="{{ asset('css/keldonasi.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body>

  <div class="header">
    <button class="back-button" onclick="window.location.href='/dashboard'">
      <i class="fas fa-arrow-left"></i>
    </button>
    Manajemen Donasi Masjid
  </div>

  <div class="container">

    <div class="sidebar">
      <button class="active">Kelompok Donasi</button>
    </div>

    <div class="content">
      <h2>Kelompok Donasi</h2>
      
      <!-- Tombol Tambah Data -->
      <button class="btn" onclick="toggleFormTambah()" style="margin-bottom: 15px;">+ Tambah Data</button>

      <!-- Form Tambah Data -->
      <form id="formTambahData" onsubmit="return submitFormTambah(event)" style="display:none; max-width:450px; padding:15px; border:1px solid #ddd; border-radius:8px; background:#fafafa;">
        <h3>Tambah Data Donasi</h3>
        <label for="inputJudulTambah" style="display:block; margin-bottom:12px; font-weight:600;">
          Judul Donasi:
          <input
            type="text"
            id="inputJudulTambah"
            name="inputJudulTambah"
            placeholder="Masukkan judul donasi"
            required
            style="width:100%; padding:8px 10px; margin-top:5px; border:1px solid #ccc; border-radius:4px; box-sizing:border-box;"
          />
        </label>

        <label for="targetTambah" style="display:block; margin-bottom:12px; font-weight:600;">
          Target (Rp):
          <input
            type="number"
            id="targetTambah"
            name="targetTambah"
            placeholder="Target donasi dalam rupiah"
            required
            min="0"
            style="width:100%; padding:8px 10px; margin-top:5px; border:1px solid #ccc; border-radius:4px; box-sizing:border-box;"
          />
        </label>

        <label for="terkumpulTambah" style="display:block; margin-bottom:12px; font-weight:600;">
          Terkumpul (Rp):
          <input
            type="number"
            id="terkumpulTambah"
            name="terkumpulTambah"
            placeholder="Jumlah terkumpul saat ini"
            value="0"
            min="0"
            style="width:100%; padding:8px 10px; margin-top:5px; border:1px solid #ccc; border-radius:4px; box-sizing:border-box;"
          />
        </label>

        <label for="galeriTambah" style="display:block; margin-bottom:15px; font-weight:600;">
          Galeri (gambar):
          <input
            type="file"
            id="galeriTambah"
            name="galeriTambah[]"
            multiple
            accept="image/*"
            style="width:100%; margin-top:5px;"
          />
        </label>

        <div style="display:flex; gap:10px;">
          <button type="submit" class="btn" style="flex:1;">Simpan</button>
          <button type="button" class="btn btn-danger" onclick="batalTambah()" style="flex:1;">Batal</button>
        </div>
      </form>

      <!-- Container tabel donasi -->
      <div id="tabelDonasiContainer" style="margin-top:30px;"></div>
    </div>

  </div>

<script>
  let dataDonasi = {
    'Toilet': [
      {
        target: 10000000,
        terkumpul: 4500000,
        galeri: [
          'https://via.placeholder.com/80?text=Toilet1',
          'https://via.placeholder.com/80?text=Toilet2'
        ]
      }
    ],
    'Karpet': [
      {
        target: 20000000,
        terkumpul: 6000000,
        galeri: [
          'https://via.placeholder.com/80?text=Karpet1'
        ]
      }
    ]
  };

  // Menyimpan status edit aktif per judul
  let currentEdit = {}; // contoh: { 'Toilet': 0 }

  function init() {
    renderTabelDonasi();
  }

  function toggleFormTambah() {
    if (Object.keys(currentEdit).length > 0) {
      alert('Selesaikan dulu edit yang sedang berlangsung.');
      return;
    }
    const form = document.getElementById('formTambahData');
    form.style.display = form.style.display === 'block' ? 'none' : 'block';
    clearFormTambah();
  }

  function batalTambah() {
    const form = document.getElementById('formTambahData');
    form.style.display = 'none';
    clearFormTambah();
  }

  function clearFormTambah() {
    document.getElementById('inputJudulTambah').value = '';
    document.getElementById('targetTambah').value = '';
    document.getElementById('terkumpulTambah').value = '0';
    document.getElementById('galeriTambah').value = '';
  }

  function clearFormEdit(formContainer) {
    if (!formContainer) return;
    const inputs = formContainer.querySelectorAll('input');
    inputs.forEach(input => {
      if (input.type === 'file') {
        input.value = '';
      } else if (input.type === 'number') {
        input.value = input.name === 'terkumpulEdit' ? '0' : '';
      } else {
        input.value = '';
      }
    });
  }

  function renderTabelDonasi() {
    const container = document.getElementById('tabelDonasiContainer');
    container.innerHTML = '';

    Object.entries(dataDonasi).forEach(([judul, entries]) => {
      const card = document.createElement('div');
      card.className = 'dashboard-card';

      const h3 = document.createElement('h3');
      h3.textContent = `Donasi Untuk ${judul}`;
      card.appendChild(h3);

      const table = document.createElement('table');
      const thead = document.createElement('thead');
      thead.innerHTML = `
        <tr>
          <th>#</th>
          <th>Target</th>
          <th>Terkumpul</th>
          <th>Galeri</th>
          <th>Aksi</th>
        </tr>`;
      table.appendChild(thead);

      const tbody = document.createElement('tbody');
      entries.forEach((entry, i) => {
        const tr = document.createElement('tr');
        const galeriHtml = (entry.galeri && entry.galeri.length)
          ? entry.galeri.map(src => `<img src="${src}" class="galeri-img" alt="Gambar Donasi">`).join('')
          : '-';
        tr.innerHTML = `
          <td>${i + 1}</td>
          <td>Rp ${parseInt(entry.target).toLocaleString('id-ID')}</td>
          <td>Rp ${parseInt(entry.terkumpul).toLocaleString('id-ID')}</td>
          <td>${galeriHtml}</td>
          <td>
            <button onclick="showFormEdit('${judul}', ${i}, this)">Edit</button>
            <button onclick="hapusDonasi('${judul}', ${i})" class="btn btn-danger">Hapus</button>
          </td>
        `;
        tbody.appendChild(tr);
      });
      table.appendChild(tbody);
      card.appendChild(table);

      // Container form edit khusus tiap judul
      const editFormContainer = document.createElement('div');
      editFormContainer.className = 'edit-form-container';
      editFormContainer.style.display = 'none'; // default hidden
      editFormContainer.innerHTML = `
        <form onsubmit="return submitFormEdit(event, '${judul}')">
          <label style="display:block; margin-bottom:12px; font-weight:600;">
            Judul Donasi:
            <input type="text" name="inputJudulEdit" placeholder="Masukkan judul donasi" required
              style="width:100%; padding:8px 10px; margin-top:5px; border:1px solid #ccc; border-radius:4px; box-sizing:border-box;" />
          </label>
          <label style="display:block; margin-bottom:12px; font-weight:600;">
            Target (Rp):
            <input type="number" name="targetEdit" placeholder="Target donasi dalam rupiah" required min="0"
              style="width:100%; padding:8px 10px; margin-top:5px; border:1px solid #ccc; border-radius:4px; box-sizing:border-box;" />
          </label>
          <label style="display:block; margin-bottom:12px; font-weight:600;">
            Terkumpul (Rp):
            <input type="number" name="terkumpulEdit" placeholder="Jumlah terkumpul saat ini" value="0" min="0"
              style="width:100%; padding:8px 10px; margin-top:5px; border:1px solid #ccc; border-radius:4px; box-sizing:border-box;" />
          </label>
          <label style="display:block; margin-bottom:15px; font-weight:600;">
            Galeri (gambar):
            <input type="file" name="galeriEdit" multiple accept="image/*"
              style="width:100%; margin-top:5px;" />
            <small style="font-weight:normal; color:#555;">(Upload ulang jika ingin ganti gambar, kosongkan jika tidak ingin ubah)</small>
          </label>
          <div style="display:flex; gap:10px;">
            <button type="submit" class="btn btn-warning" style="flex:1;">Update</button>
            <button type="button" class="btn btn-danger" onclick="batalEdit('${judul}')" style="flex:1;">Batal</button>
          </div>
        </form>
      `;
      card.appendChild(editFormContainer);

      container.appendChild(card);
    });
  }

  function showFormEdit(judul, index, btn) {
    if (document.getElementById('formTambahData').style.display === 'block') {
      alert('Selesaikan dulu tambah data yang sedang berlangsung.');
      return;
    }
    if (Object.keys(currentEdit).length > 0) {
      alert('Selesaikan dulu edit yang sedang berlangsung.');
      return;
    }

    currentEdit[judul] = index;

    const card = btn.closest('.dashboard-card');
    if (!card) return;

    const formContainer = card.querySelector('.edit-form-container');
    formContainer.style.display = 'block';

    const entry = dataDonasi[judul][index];
    formContainer.querySelector('input[name="inputJudulEdit"]').value = judul;
    formContainer.querySelector('input[name="targetEdit"]').value = entry.target;
    formContainer.querySelector('input[name="terkumpulEdit"]').value = entry.terkumpul;
    formContainer.querySelector('input[name="galeriEdit"]').value = '';

    formContainer.scrollIntoView({ behavior: 'smooth' });
  }

  function batalEdit(judul) {
    if (!judul || !currentEdit.hasOwnProperty(judul)) return;

    const cards = document.querySelectorAll('.dashboard-card');
    cards.forEach(card => {
      const h3 = card.querySelector('h3');
      if (h3 && h3.textContent === `Donasi Untuk ${judul}`) {
        const formContainer = card.querySelector('.edit-form-container');
        if (formContainer) {
          formContainer.style.display = 'none';
          clearFormEdit(formContainer);
        }
      }
    });

    delete currentEdit[judul];
  }

  function submitFormTambah(e) {
    e.preventDefault();

    const judul = document.getElementById('inputJudulTambah').value.trim();
    const target = parseInt(document.getElementById('targetTambah').value);
    const terkumpul = parseInt(document.getElementById('terkumpulTambah').value) || 0;
    const galeriInput = document.getElementById('galeriTambah');

    if (!judul) {
      alert('Judul donasi wajib diisi!');
      return false;
    }
    if (isNaN(target) || target < 0) {
      alert('Target harus angka dan >= 0!');
      return false;
    }

    const galeriSrcs = [];
    for (let i = 0; i < galeriInput.files.length; i++) {
      galeriSrcs.push(URL.createObjectURL(galeriInput.files[i]));
    }

    if (!dataDonasi[judul]) {
      dataDonasi[judul] = [];
    }

    dataDonasi[judul].push({
      target,
      terkumpul,
      galeri: galeriSrcs
    });

    alert('Data donasi berhasil ditambahkan!');
    renderTabelDonasi();
    batalTambah();
    return false;
  }

  function submitFormEdit(e, judulAsal) {
    e.preventDefault();

    const form = e.target;
    const judulBaru = form.querySelector('input[name="inputJudulEdit"]').value.trim();
    const targetBaru = parseInt(form.querySelector('input[name="targetEdit"]').value);
    const terkumpulBaru = parseInt(form.querySelector('input[name="terkumpulEdit"]').value) || 0;
    const galeriInput = form.querySelector('input[name="galeriEdit"]');

    if (!judulBaru) {
      alert('Judul donasi wajib diisi!');
      return false;
    }
    if (isNaN(targetBaru) || targetBaru < 0) {
      alert('Target harus angka dan >= 0!');
      return false;
    }

    const index = currentEdit[judulAsal];
    if (index === undefined) {
      alert('Data edit tidak ditemukan!');
      return false;
    }

    const entryLama = dataDonasi[judulAsal][index];

    let galeriSrcs = [];
    for (let i = 0; i < galeriInput.files.length; i++) {
      galeriSrcs.push(URL.createObjectURL(galeriInput.files[i]));
    }
    if (galeriSrcs.length === 0) {
      galeriSrcs = entryLama.galeri;
    }

    if (judulBaru !== judulAsal) {
      if (!dataDonasi[judulBaru]) {
        dataDonasi[judulBaru] = [];
      }
      // Tambah data ke judul baru
      dataDonasi[judulBaru].push({
        target: targetBaru,
        terkumpul: terkumpulBaru,
        galeri: galeriSrcs
      });

      // Hapus data lama
      dataDonasi[judulAsal].splice(index, 1);
      if (dataDonasi[judulAsal].length === 0) {
        delete dataDonasi[judulAsal];
      }
    } else {
      // Update data pada judul yang sama
      dataDonasi[judulAsal][index] = {
        target: targetBaru,
        terkumpul: terkumpulBaru,
        galeri: galeriSrcs
      };
    }

    alert('Data donasi berhasil diperbarui!');
    renderTabelDonasi();
    batalEdit(judulBaru);
    return false;
  }

  function hapusDonasi(judul, index) {
    if (confirm(`Yakin ingin menghapus donasi "${judul}" nomor ${index + 1}?`)) {
      dataDonasi[judul].splice(index, 1);
      if (dataDonasi[judul].length === 0) {
        delete dataDonasi[judul];
      }
      renderTabelDonasi();
    }
  }

  window.onload = init;
</script>

</body>
</html>
