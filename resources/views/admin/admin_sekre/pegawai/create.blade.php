<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<!-- 🔥 Tag wajib untuk responsive -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Rekap Pegawai</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}

body{
  background:linear-gradient(135deg,#eef4ff,#f8fafc);
  min-height: 100vh;
}

/* NAVBAR */
.navbar{
  background:white;
  padding:15px 30px;
  display:flex;
  justify-content:space-between;
  box-shadow:0 2px 10px rgba(0,0,0,0.04);
}
.navbar h3{color:#0d6efd; font-size: 18px;}

/* CONTAINER */
.container{
  display:flex;
  justify-content:center;
  align-items:center;
  min-height:calc(100vh - 60px);
  padding:20px;
}

/* CARD */
.card{
  background:rgba(255,255,255,0.95);
  backdrop-filter:blur(8px);
  padding:25px;
  width:100%;
  max-width:700px;
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

/* FORM */
.form-grid{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:15px;
}

label{
  font-size:12px;
  color:#6b7280;
  margin-bottom:5px;
  display:block;
}

input, select{
  width:100%;
  padding:10px;
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
  margin-top:4px;
}

/* BUTTON */
.btn{
  margin-top:15px;
  width: 100%;
  padding:12px;
  border:none;
  border-radius:8px;
  background:#0d6efd;
  color:white;
  font-weight:500;
  cursor:pointer;
  transition:.3s;
}

.btn:hover{
  background:#0b5ed7;
  transform:translateY(-1px);
  box-shadow:0 4px 10px rgba(13,110,253,0.2);
}

/* 🔥 MEDIA QUERY RESPONSIVE (SMARTPHONE) */
@media screen and (max-width: 600px) {
  .form-grid { grid-template-columns: 1fr; } /* Form berubah ke 1 kolom menyusun kebawah */
  .navbar { padding: 15px 20px; }
  .card { padding: 20px; }
  .header h2 { font-size: 16px; }
}
</style>
</head>

<body>

<div class="navbar">
  <h3>Admin Pegawai</h3>
  <div style="font-size: 14px; color:#666;">Tambah Rekap</div>
</div>

<div class="container">
<div class="card">

<div class="header">
  <h2>Tambah Rekap Pegawai</h2>
  <a href="{{ route('pegawai.rekap') }}" class="back">← Kembali</a>
</div>

<form action="{{ route('pegawai.rekap.store') }}" method="POST">
@csrf

<div class="form-grid">

<!-- STATUS -->
<div>
<label>Status</label>
<select name="status" required>
  <option value="">-- Pilih Status --</option>
  <option value="PNS" {{ old('status')=='PNS'?'selected':'' }}>PNS</option>
  <option value="Non PNS" {{ old('status')=='Non PNS'?'selected':'' }}>Non PNS</option>
</select>
@error('status')<div class="error">{{ $message }}</div>@enderror
</div>

<!-- PENDIDIKAN -->
<div>
<label>Pendidikan</label>
<select name="pendidikan" required>
  <option value="">-- Pilih Pendidikan --</option>
  <option>S2</option>
  <option>S1</option>
  <option>SMA/Sederajat</option>
  <option>SMP</option>
  <option>SD</option>
  <option>Tanpa Ijazah</option>
</select>
@error('pendidikan')<div class="error">{{ $message }}</div>@enderror
</div>

<!-- BIDANG -->
<div>
<label>Bidang</label>
<select name="bidang" required>
  <option value="">-- Pilih Bidang --</option>
  <option value="Sekretariat" {{ old('bidang')=='Sekretariat'?'selected':'' }}>Sekretariat</option>
  <option value="Pemberdayaan Usaha Mikro" {{ old('bidang')=='Pemberdayaan Usaha Mikro'?'selected':'' }}>Pemberdayaan Usaha Mikro</option>
  <option value="Pembinaan Usaha Perdagangan" {{ old('bidang')=='Pembinaan Usaha Perdagangan'?'selected':'' }}>Pembinaan Usaha Perdagangan</option>
  <option value="Distribusi Perdagangan" {{ old('bidang')=='Distribusi Perdagangan'?'selected':'' }}>Distribusi Perdagangan</option>
  <option value="Bidang Koperasi" {{ old('bidang')=='Bidang Koperasi'?'selected':'' }}>Bidang Koperasi</option>
  <option value="UPTD Metrologi Legal" {{ old('bidang')=='UPTD Metrologi Legal'?'selected':'' }}>UPTD Metrologi Legal</option>
</select>
@error('bidang')<div class="error">{{ $message }}</div>@enderror
</div>

<!-- JUMLAH -->
<div>
<label>Jumlah Pegawai</label>
<input type="number" name="jumlah" value="{{ old('jumlah') }}" required>
@error('jumlah')<div class="error">{{ $message }}</div>@enderror
</div>

</div>

<button class="btn">Simpan Data</button>

</form>

</div>
</div>

</body>
</html>