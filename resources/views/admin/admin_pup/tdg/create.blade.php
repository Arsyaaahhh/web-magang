<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah TDG</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}

body{
  background:#f4f7fb;
}

/* NAVBAR */
.navbar{
  background:white;
  padding:15px 30px;
  display:flex;
  justify-content:space-between;
  box-shadow:0 2px 10px rgba(0,0,0,0.05);
}

/* CONTAINER */
.wrapper{
  padding:40px;
  display:flex;
  justify-content:center;
}

.card{
  width:900px;
  background:white;
  padding:30px;
  border-radius:16px;
  box-shadow:0 10px 25px rgba(0,0,0,0.05);
}

/* GRID FORM */
.form-grid{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:20px;
}

/* FULL WIDTH */
.full{
  grid-column:span 2;
}

/* INPUT */
.form-group label{
  display:block;
  margin-bottom:6px;
  font-weight:500;
}

.form-group input,
.form-group textarea,
.form-group select{
  width:100%;
  padding:10px;
  border-radius:10px;
  border:1px solid #d1d5db;
}

/* BUTTON */
.btn{
  margin-top:20px;
  padding:10px 18px;
  border:none;
  border-radius:10px;
  background:#2563eb;
  color:white;
  cursor:pointer;
  font-weight:600;
}

.back{
  float:right;
  text-decoration:none;
  color:#6b7280;
  font-size:14px;
}
</style>
</head>

<body>

<div class="navbar">
  <h3>Admin TDG</h3>
  <span>Tambah Data TDG</span>
</div>

<div class="wrapper">

<div class="card">

<h2 style="margin-bottom:20px;">Tambah Data TDG</h2>
<a href="{{ route('tdg.index') }}" class="back">← Kembali</a>

<form action="{{ route('tdg.store') }}" method="POST">
@csrf

<div class="form-grid">

<!-- LEFT -->
<div class="form-group">
  <label>Nama Usaha</label>
  <input type="text" name="nama_usaha">
</div>

<div class="form-group">
  <label>Nomor TDG</label>
  <input type="text" name="nomor_tdg">
</div>

<div class="form-group">
  <label>Nama Pemilik</label>
  <input type="text" name="pemilik">
</div>

<div class="form-group">
  <label>Tanggal Terbit</label>
  <input type="date" name="tanggal_terbit">
</div>

<div class="form-group">
  <label>Nama Gudang</label>
  <input type="text" name="nama_gudang">
</div>

<div class="form-group">
  <label>Status</label>
  <select name="status">
    <option value="Aktif">Aktif</option>
    <option value="Tidak Aktif">Tidak Aktif</option>
  </select>
</div>

<!-- FULL WIDTH -->
<div class="form-group full">
  <label>Alamat Usaha</label>
  <textarea name="alamat" rows="3"></textarea>
</div>

<div class="form-group full">
  <label>Lokasi Gudang</label>
  <textarea name="lokasi_gudang" rows="2"></textarea>
</div>

</div>

<button class="btn">Simpan Data</button>

</form>

</div>
</div>

</body>
</html>