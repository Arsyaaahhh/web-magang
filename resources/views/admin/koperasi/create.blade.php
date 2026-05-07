<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Koperasi</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: linear-gradient(135deg, #eef4ff, #f8fafc);
    }

    .navbar {
      background: white;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
    }

    .navbar h3 {
      color: #0d6efd;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 90vh;
    }

    .card {
      background: rgba(255, 255, 255, 0.9);
      padding: 25px;
      width: 100%;
      max-width: 800px;
      border-radius: 14px;
      box-shadow: 0 8px 20px rgba(13, 110, 253, 0.08);
    }

    .header {
      display: flex;
      justify-content: space-between;
      margin-bottom: 15px;
    }

    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
    }

    label {
      font-size: 12px;
      color: #6b7280;
    }

    input, select {
      width: 100%;
      padding: 8px;
      border-radius: 7px;
      border: 1px solid #d1d5db;
    }

    .btn {
      margin-top: 15px;
      padding: 10px;
      background: #0d6efd;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }
  </style>
</head>

<body>

<div class="navbar">
  <h3>Admin Koperasi</h3>
  <div>Tambah Data</div>
</div>

<div class="container">
  <div class="card">

    <div class="header">
      <h2>Tambah Data Koperasi</h2>
      <a href="/admin/koperasi">← Kembali</a>
    </div>

<form action="/admin/koperasi/store" method="POST">
@csrf

<div class="form-grid">

  <!-- Kecamatan -->
  <div>
    <label>Kecamatan</label>
    <select name="ID_KECAMATAN" id="kecamatan" required>
      <option value="">-- Pilih Kecamatan --</option>
      @foreach($kecamatan as $k)
        <option value="{{ $k->ID_KECAMATAN }}">
          {{ $k->NM_KECAMATAN }}
        </option>
      @endforeach
    </select>
  </div>

  <!-- Kelurahan -->
  <div>
    <label>Kelurahan</label>
    <select name="ID_KELURAHAN" id="kelurahan" required>
      <option value="">-- Pilih Kelurahan --</option>
    </select>
  </div>

  <!-- Jumlah Koperasi -->
  <div>
    <label>Jumlah Koperasi</label>
    <input type="number" name="jumlah" required min="0">
  </div>

  <!-- Tahun -->
  <div>
    <label>Tahun</label>
    <input type="year" name="tahun" required min="1900">
  </div>

  <!-- Status -->
  <div>
    <label>Status</label>
    <select name="status">
      <option value="aktif">Aktif</option>
      <option value="tidak aktif">Tidak Aktif</option>
    </select>
  </div>

  <!-- Mitra -->
  <div>
    <label>Status Mitra</label>
    <select name="status_mitra">
      <option value="bermitra">Bermitra</option>
      <option value="belum">Belum</option>
    </select>
  </div>

  <!-- Jenis Mitra -->
  <div>
    <label>Jenis Mitra</label>
    <select name="jenis_mitra">
      <option value="perbankan">Perbankan</option>
      <option value="non">Non Perbankan</option>
    </select>
  </div>

  <!-- Status RAT -->
  <div>
    <label>Status RAT</label>
    <select name="status_rat">
      <option value="YA">YA</option>
      <option value="TIDAK">TIDAK</option>
    </select>
  </div>

  <!-- Status LPJ -->
  <div>
    <label>Status LPJ</label>
    <select name="status_lpj">
      <option value="LENGKAP">LENGKAP</option>
      <option value="TIDAK LENGKAP">TIDAK LENGKAP</option>
    </select>
  </div>

  <!-- Total Pengawasan -->
  <div>
    <label>Total Pengawasan</label>
    <input type="number" name="total_pengawasan" required min="0" value="0">
  </div>

</div>

<button class="btn">Simpan</button>
</form>

  </div>
</div>
<script>
document.getElementById('kecamatan').addEventListener('change', function () {

    let id = this.value;

    fetch('/admin/koperasi/get-kelurahan/' + id)
        .then(res => res.json())
        .then(data => {

            let kelurahan = document.getElementById('kelurahan');
            kelurahan.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';

            data.forEach(item => {
                kelurahan.innerHTML += `
                    <option value="${item.ID_KELURAHAN}">
                        ${item.NM_KELURAHAN}
                    </option>
                `;
            });

        });

});
</script>
</body>
</html>