<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Pegawai</title>

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
  <h3>Admin Pegawai</h3>
  <div>Tambah Data</div>
</div>

<div class="container">
  <div class="card">

    <div class="header">
      <h2>Tambah Data Pegawai</h2>
      <a href="/admin/pegawai">← Kembali</a>
    </div>

<form action="/admin/pegawai/store" method="POST">
@csrf

<div class="form-grid">

  <!-- Jumlah Pegawai -->
  <div>
    <label>Jumlah Pegawai</label>
    <input type="number" name="jumlah_pegawai" required min="0">
  </div>

  <!-- Status -->
  <div>
    <label>Status</label>
    <select name="status" required>
      <option value="">-- Pilih Status --</option>
      <option value="pns">PNS</option>
      <option value="non_pns">Non PNS</option>
    </select>
  </div>

  <!-- Program -->
  <div>
    <label>Program</label>
    <select name="program" required>
      <option value="">-- Pilih Program --</option>
      <option value="diklat">Diklat</option>
      <option value="bimtek">Bimtek</option>
      <option value="tidak ada">Tidak Ada</option>
    </select>
  </div>

</div>

<button class="btn">Simpan</button>
</form>

  </div>
</div>

</body>
</html>
