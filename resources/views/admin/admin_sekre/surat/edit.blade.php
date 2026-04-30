<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Surat</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Poppins', sans-serif;
}

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

.navbar h3{
  color:#0d6efd;
}

/* CONTAINER */
.container{
  display:flex;
  justify-content:center;
  align-items:center;
  height:90vh;
}

/* CARD (GLASS EFFECT) */
.card{
  background:rgba(255,255,255,0.85);
  backdrop-filter:blur(10px);
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

/* FILE TEXT */
.file-note{
  font-size:11px;
  color:#9ca3af;
  margin-top:2px;
}

/* BUTTON */
.btn{
  margin-top:10px;
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
  box-shadow:0 4px 10px rgba(13,110,253,0.2);
}
</style>

</head>

<body>

<div class="navbar">
  <h3>Admin Surat</h3>
  <div>Edit Data</div>
</div>

<div class="container">

<div class="card">

<div class="header">
  <h2>Edit Surat</h2>
  <a href="/admin/admin_sekre" class="back">← Kembali</a>
</div>

<form action="/admin/admin_sekre/update/{{ $data->id }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="form-grid">

<div>
<label>Nomor</label>
<input name="nomor" value="{{ $data->nomor }}">
</div>

<div>
<label>Tahun</label>
<input type="number" name="tahun" value="{{ $data->tahun }}">
</div>

<div>
<label>Judul</label>
<input name="judul" value="{{ $data->judul }}">
</div>

<div>
<label>Jenis</label>
<select name="jenis">
<option value="SK" {{ $data->jenis=='SK'?'selected':'' }}>SK</option>
<option value="SP" {{ $data->jenis=='SP'?'selected':'' }}>SP</option>
<option value="SOP" {{ $data->jenis=='SOP'?'selected':'' }}>SOP</option>
</select>
</div>

<input type="hidden" name="bidang" value="sekretariat">

<div>
<label>Bidang</label>
<input value="Sekretariat" readonly style="background:#f8fafc; border-color:#d1d5db; cursor:not-allowed;" />
</div>

<div>
<label>Update File</label>
<input type="file" name="file">
<div class="file-note">Kosongkan jika tidak diubah</div>
</div>

</div>

<button class="btn">Update Data</button>

</form>

</div>

</div>

</body>
</html>