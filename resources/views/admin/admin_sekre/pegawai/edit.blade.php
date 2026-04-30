<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Data Pegawai</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{background:linear-gradient(135deg,#eef4ff,#f8fafc);}
.navbar{background:white;padding:15px 30px;display:flex;justify-content:space-between;box-shadow:0 2px 10px rgba(0,0,0,0.04);}
.navbar h3{color:#0d6efd;}
.container{display:flex;justify-content:center;align-items:center;min-height:90vh;padding:20px;}
.card{background:rgba(255,255,255,0.95);backdrop-filter:blur(8px);padding:25px;width:100%;max-width:900px;border-radius:14px;border:1px solid rgba(255,255,255,0.4);box-shadow:0 8px 20px rgba(13,110,253,0.08);}
.header{display:flex;justify-content:space-between;align-items:center;margin-bottom:15px;}
.header h2{font-size:18px;color:#374151;}
.back{font-size:13px;text-decoration:none;color:#6b7280;}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
label{font-size:12px;color:#6b7280;margin-bottom:3px;display:block;}
input, textarea, select{width:100%;padding:10px;border-radius:7px;border:1px solid #d1d5db;font-size:13px;}
input:focus, textarea:focus, select:focus{outline:none;border-color:#0d6efd;box-shadow:0 0 0 2px rgba(13,110,253,0.1);}
textarea{resize:vertical;min-height:100px;}
.error{font-size:11px;color:#dc3545;margin-top:2px;}
.btn{margin-top:12px;padding:12px;border:none;border-radius:8px;background:#0d6efd;color:white;font-weight:500;cursor:pointer;transition:.3s;}
.btn:hover{background:#0b5ed7;transform:translateY(-1px);box-shadow:0 4px 10px rgba(13,110,253,0.2);}
</style>
</head>
<body>

<div class="navbar"><h3>Admin Pegawai</h3><div>Edit Data Pegawai</div></div>

<div class="container"><div class="card">
<div class="header"><h2>Edit Data Pegawai</h2><a href="{{ route('pegawai.index') }}" class="back">← Kembali</a></div>

<form action="{{ route('pegawai.update', $data->id) }}" method="POST">
@csrf
<div class="form-grid">
<div><label>Nama</label><input name="nama" value="{{ old('nama', $data->nama) }}" required>@error('nama')<div class="error">{{ $message }}</div>@enderror</div>
<div><label>NIP</label><input name="nip" value="{{ old('nip', $data->nip) }}" required>@error('nip')<div class="error">{{ $message }}</div>@enderror</div>
<div><label>Bidang</label><input name="bidang" value="{{ old('bidang', $data->bidang) }}" required>@error('bidang')<div class="error">{{ $message }}</div>@enderror</div>
<div><label>Posisi</label><input name="posisi" value="{{ old('posisi', $data->posisi) }}" required>@error('posisi')<div class="error">{{ $message }}</div>@enderror</div>
<div style="grid-column:1 / -1;"><label>Alamat</label><textarea name="alamat" required>{{ old('alamat', $data->alamat) }}</textarea>@error('alamat')<div class="error">{{ $message }}</div>@enderror</div>
</div>
<button class="btn">Update Data</button>
</form>
</div></div>

</body>
</html>