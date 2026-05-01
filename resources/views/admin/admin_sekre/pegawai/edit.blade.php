<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Rekap Pegawai</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{background:linear-gradient(135deg,#eef4ff,#f8fafc);}

/* NAVBAR */
.navbar{
  background:white;
  padding:15px 30px;
  display:flex;
  justify-content:space-between;
  box-shadow:0 2px 10px rgba(0,0,0,0.04);
}
.navbar h3{color:#0d6efd;}

/* CONTAINER */
.container{
  display:flex;
  justify-content:center;
  align-items:center;
  min-height:90vh;
  padding:20px;
}

/* CARD */
.card{
  background:rgba(255,255,255,0.95);
  backdrop-filter:blur(8px);
  padding:25px;
  width:100%;
  max-width:500px;
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

/* INPUT */
label{
  font-size:12px;
  color:#6b7280;
  margin-bottom:3px;
  display:block;
}

input, select{
  width:100%;
  padding:10px;
  border-radius:7px;
  border:1px solid #d1d5db;
  font-size:13px;
  margin-bottom:12px;
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
  margin-top:-8px;
  margin-bottom:8px;
}

/* BUTTON */
.btn{
  margin-top:10px;
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
</style>
</head>

<body>

<div class="navbar">
  <h3>Admin Pegawai</h3>
  <div>Edit Rekap Pegawai</div>
</div>

<div class="container">
<div class="card">

<div class="header">
  <h2>Edit Rekap Pegawai</h2>
  <a href="{{ route('pegawai.rekap') }}" class="back">← Kembali</a>
</div>

<form action="{{ route('pegawai.rekap.update', $data->id) }}" method="POST">
@csrf

<!-- STATUS -->
<label>Status</label>
<select name="status">
  <option value="PNS" {{ old('status', $data->status)=='PNS'?'selected':'' }}>PNS</option>
  <option value="Non PNS" {{ old('status', $data->status)=='Non PNS'?'selected':'' }}>Non PNS</option>
</select>
@error('status') <div class="error">{{ $message }}</div> @enderror

<!-- PENDIDIKAN -->
<label>Pendidikan</label>
<select name="pendidikan">
  <option value="S2" {{ old('pendidikan',$data->pendidikan)=='S2'?'selected':'' }}>S2</option>
  <option value="S1" {{ old('pendidikan',$data->pendidikan)=='S1'?'selected':'' }}>S1</option>
  <option value="SMA/Sederajat" {{ old('pendidikan',$data->pendidikan)=='SMA/Sederajat'?'selected':'' }}>SMA/Sederajat</option>
  <option value="SMP" {{ old('pendidikan',$data->pendidikan)=='SMP'?'selected':'' }}>SMP</option>
  <option value="SD" {{ old('pendidikan',$data->pendidikan)=='SD'?'selected':'' }}>SD</option>
  <option value="Tanpa Ijazah" {{ old('pendidikan',$data->pendidikan)=='Tanpa Ijazah'?'selected':'' }}>Tanpa Ijazah</option>
</select>
@error('pendidikan') <div class="error">{{ $message }}</div> @enderror

<!-- JUMLAH -->
<label>Jumlah</label>
<input type="number" name="jumlah" value="{{ old('jumlah',$data->jumlah) }}">
@error('jumlah') <div class="error">{{ $message }}</div> @enderror

<button class="btn">Update Data</button>

</form>

</div>
</div>

</body>
</html>