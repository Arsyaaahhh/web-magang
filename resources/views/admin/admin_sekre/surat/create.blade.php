<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Surat</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins', sans-serif;}

body{
  background:linear-gradient(135deg,#eef4ff,#f8fafc);
}

/* NAVBAR */
.navbar{
  background:white;
  padding:15px 30px;
  display:flex;
  justify-content:space-between;
  box-shadow:0 2px 10px rgba(0,0,0,0.04);
}

.navbar h3{ color:#0d6efd; }

/* CONTAINER */
.container{
  display:flex;
  justify-content:center;
  align-items:center;
  height:90vh;
}

/* CARD */
.card{
  background:rgba(255,255,255,0.9);
  backdrop-filter:blur(8px);
  padding:25px;
  width:100%;
  max-width:800px;
  border-radius:14px;
  border:1px solid rgba(255,255,255,0.4);
  box-shadow:0 8px 20px rgba(13,110,253,0.08);
}

/* HEADER */
.header{
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:15px;
}

.header h2{
  font-size:18px;
  color:#374151;
}

.back{
  font-size:13px;
  text-decoration:none;
  color:#6b7280;
}

/* GRID */
.form-grid{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:12px;
}

/* LABEL */
label{
  font-size:12px;
  color:#6b7280;
  margin-bottom:3px;
  display:block;
}

/* INPUT */
input, select{
  width:100%;
  padding:8px;
  border-radius:7px;
  border:1px solid #d1d5db;
  font-size:13px;
}

input:focus, select:focus{
  outline:none;
  border-color:#0d6efd;
  box-shadow:0 0 0 2px rgba(13,110,253,0.1);
}

/* ERROR */
.error{
  font-size:11px;
  color:#dc3545;
  margin-top:2px;
}

/* BUTTON */
.btn{
  margin-top:12px;
  padding:10px;
  border:none;
  border-radius:8px;
  background:#0d6efd;
  color:white;
  font-weight:500;
  cursor:pointer;
  transition:0.3s;
}

.btn:hover{
  background:#0b5ed7;
  transform:translateY(-1px);
}
</style>
</head>

<body>

<div class="navbar">
  <h3>Admin Surat</h3>
  <div>Tambah Data</div>
</div>

<div class="container">
<div class="card">

<div class="header">
  <h2>Tambah Surat</h2>
  <a href="/admin/admin_sekre" class="back">← Kembali</a>
</div>

<form action="/admin/admin_sekre/store" method="POST" enctype="multipart/form-data">
@csrf

<div class="form-grid">

<div>
<label>Nomor</label>
<input name="nomor" value="{{ old('nomor') }}" required>
@error('nomor') <div class="error">{{ $message }}</div> @enderror
</div>

<div>
<label>Tahun</label>
<input type="number" name="tahun" value="{{ old('tahun') }}" required>
@error('tahun') <div class="error">{{ $message }}</div> @enderror
</div>

<div>
<label>Judul</label>
<input name="judul" value="{{ old('judul') }}" required>
@error('judul') <div class="error">{{ $message }}</div> @enderror
</div>

<div>
<label>Jenis</label>
<select name="jenis">
<option value="SK" {{ old('jenis')=='SK'?'selected':'' }}>SK</option>
<option value="SP" {{ old('jenis')=='SP'?'selected':'' }}>SP</option>
<option value="SOP" {{ old('jenis')=='SOP'?'selected':'' }}>SOP</option>
</select>
</div>

<div>
<label>Bidang</label>
<input value="Sekretariat" readonly style="background:#f1f5f9; cursor:not-allowed;">
<input type="hidden" name="bidang" value="sekretariat">
</div>

<div>
<label>Upload File (PDF)</label>
<input type="file" name="file" accept="application/pdf" required>
@error('file') <div class="error">{{ $message }}</div> @enderror
</div>

</div>

<button type="submit" class="btn">Simpan Data</button>

</form>

</div>
</div>

</body>
</html>