<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
      min-height: 100vh;
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
      min-height: calc(100vh - 60px);
      padding: 20px;
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
      align-items: center;
      margin-bottom: 15px;
    }

    .header h2 {
      font-size: 18px;
    }

    /* Tampilan tombol kembali dirapikan */
    .back {
      font-size: 13px;
      text-decoration: none;
      color: #6b7280;
    }
    .back:hover {
      color: #374151;
    }

    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
    }

    label {
      font-size: 12px;
      color: #6b7280;
      margin-bottom: 3px;
      display: block;
    }

    input, select {
      width: 100%;
      padding: 8px;
      border-radius: 7px;
      border: 1px solid #d1d5db;
      font-size: 13px;
    }

    input:focus, select:focus {
      outline: none;
      border-color: #0d6efd;
    }

    .btn {
      margin-top: 15px;
      padding: 10px;
      background: #0d6efd;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      width: 100%;
      font-weight: 500;
      transition: 0.3s;
    }
    .btn:hover {
      background: #0b5ed7;
    }

    /* 🔥 MEDIA QUERY RESPONSIVE (SMARTPHONE) */
    @media (max-width: 600px) {
      .form-grid {
        grid-template-columns: 1fr; /* Form menjadi 1 baris ke bawah di HP */
      }
      .navbar {
        padding: 15px 20px;
      }
    }
  </style>
</head>

<body>

<div class="navbar">
  <h3>Admin Koperasi</h3>
  <div style="font-size: 14px; color: #666;">Tambah Data</div>
</div>

<div class="container">
  <div class="card">

    <div class="header">
      <h2>Tambah Data Koperasi</h2>
      <a href="/admin/koperasi/" class="back">← Kembali</a>
    </div>

<form action="/admin/koperasi/store" method="POST">
@csrf

<div class="form-grid">

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

  <div>
    <label>Kelurahan</label>
    <select name="ID_KELURAHAN" id="kelurahan" required>
      <option value="">-- Pilih Kelurahan --</option>
    </select>
  </div>

  <div>
    <label>Jumlah Koperasi</label>
    <input type="number" name="jumlah" required min="0">
  </div>

  <div>
    <label>Tahun</label>
    <input type="year" name="tahun" required min="1900">
  </div>

  <div>
    <label>Koperasi AKtif</label>
    <input type="number" name="aktif" required min="0">
  </div>
  <div>
    <label>Koperasi Tidak Aktif</label>
    <input type="number" name="tidak_aktif" required min="0">
  </div>
  <div>
    <label>Koperasi Bermitra</label>
    <input type="number" name="bermitra" required min="0">
  </div>
  <div>
    <label>Koperasi Mitra Perbankan</label>
    <input type="number" name="mitra_perbankan" required min="0">
  </div>
  <div>
    <label>Koperasi Padat Karya</label>
    <input type="number" name="padat_karya" required min="0">
  </div>
  <div>
    <label>Koperasi LPJ Lengkap</label>
    <input type="number" name="lpj_lengkap" required min="0">
  </div>
  <div>
    <label>RAT LENGKAP</label>
    <input type="number" name="pelaksanaan_rat" required min="0">
  </div>
</div>
<button class="btn">Simpan</button>
</form>

  </div>
</div>
<script>
    document.getElementById('kecamatan').addEventListener('change', function() {
        let kecamatan_id = this.value;

        fetch('/get-kelurahan/' + kecamatan_id)
            .then(response => response.json())
            .then(data => {
                let kelurahan = document.getElementById('kelurahan');
                kelurahan.innerHTML = '<option value="">Pilih Kelurahan</option>';

                data.forEach(item => {
                    kelurahan.innerHTML += 
                        `<option value="${item.ID_KELURAHAN}">${item.NM_KELURAHAN}</option>`;
                });
            });
    });
</script>
</body>
</html>