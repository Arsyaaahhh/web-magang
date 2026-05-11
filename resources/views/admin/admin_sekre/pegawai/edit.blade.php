<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Rekap Pegawai</title>

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
  max-width:700px; /* Dilebarkan agar rapi 2 kolom */
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

/* FORM GRID */
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
  .form-grid { grid-template-columns: 1fr; }
  .navbar { padding: 15px 20px; }
  .card { padding: 20px; }
  .header h2 { font-size: 16px; }
}
</style>
</head>

<body>

<div class="navbar">
  <h3>Admin Pegawai</h3>
  <div style="font-size: 14px; color:#666;">Edit Rekap</div>
</div>

<div class="container">
<div class="card">

<div class="header">
  <h2>Edit Rekap Pegawai</h2>
  <a href="{{ route('pegawai.rekap') }}" class="back">← Kembali</a>
</div>

<form action="{{ route('pegawai.rekap.update', $data->id) }}" method="POST">
@csrf

<div class="form-grid">

  <div>
    <label>Status</label>
    <select name="status" id="statusSelect" required>
      <option value="">-- Pilih Status --</option>
      <option value="PNS" {{ old('status', $data->status)=='PNS' ? 'selected' : '' }}>PNS</option>
      <option value="Non PNS" {{ old('status', $data->status)=='Non PNS' ? 'selected' : '' }}>Non PNS</option>
    </select>
    @if($errors->has('status'))<div class="error">{{ $errors->first('status') }}</div>@endif
  </div>

  <div id="pangkatContainer" style="display: {{ old('status', $data->status) == 'PNS' ? 'block' : 'none' }};">
    <label>Pangkat / Golongan</label>
    <select name="pangkat_golongan" id="pangkatInput">
      <option value="">-- Pilih Pangkat/Golongan --</option>
      <optgroup label="Golongan I (Juru)">
        <option value="I/a" {{ old('pangkat_golongan', $data->pangkat_golongan)=='I/a'?'selected':'' }}>I/a - Juru Muda</option>
        <option value="I/b" {{ old('pangkat_golongan', $data->pangkat_golongan)=='I/b'?'selected':'' }}>I/b - Juru Muda Tingkat I</option>
        <option value="I/c" {{ old('pangkat_golongan', $data->pangkat_golongan)=='I/c'?'selected':'' }}>I/c - Juru</option>
        <option value="I/d" {{ old('pangkat_golongan', $data->pangkat_golongan)=='I/d'?'selected':'' }}>I/d - Juru Tingkat I</option>
      </optgroup>
      <optgroup label="Golongan II (Pengatur)">
        <option value="II/a" {{ old('pangkat_golongan', $data->pangkat_golongan)=='II/a'?'selected':'' }}>II/a - Pengatur Muda</option>
        <option value="II/b" {{ old('pangkat_golongan', $data->pangkat_golongan)=='II/b'?'selected':'' }}>II/b - Pengatur Muda Tingkat I</option>
        <option value="II/c" {{ old('pangkat_golongan', $data->pangkat_golongan)=='II/c'?'selected':'' }}>II/c - Pengatur</option>
        <option value="II/d" {{ old('pangkat_golongan', $data->pangkat_golongan)=='II/d'?'selected':'' }}>II/d - Pengatur Tingkat I</option>
      </optgroup>
      <optgroup label="Golongan III (Penata)">
        <option value="III/a" {{ old('pangkat_golongan', $data->pangkat_golongan)=='III/a'?'selected':'' }}>III/a - Penata Muda</option>
        <option value="III/b" {{ old('pangkat_golongan', $data->pangkat_golongan)=='III/b'?'selected':'' }}>III/b - Penata Muda Tingkat I</option>
        <option value="III/c" {{ old('pangkat_golongan', $data->pangkat_golongan)=='III/c'?'selected':'' }}>III/c - Penata</option>
        <option value="III/d" {{ old('pangkat_golongan', $data->pangkat_golongan)=='III/d'?'selected':'' }}>III/d - Penata Tingkat I</option>
      </optgroup>
      <optgroup label="Golongan IV (Pembina)">
        <option value="IV/a" {{ old('pangkat_golongan', $data->pangkat_golongan)=='IV/a'?'selected':'' }}>IV/a - Pembina</option>
        <option value="IV/b" {{ old('pangkat_golongan', $data->pangkat_golongan)=='IV/b'?'selected':'' }}>IV/b - Pembina Tingkat I</option>
        <option value="IV/c" {{ old('pangkat_golongan', $data->pangkat_golongan)=='IV/c'?'selected':'' }}>IV/c - Pembina Utama Muda</option>
        <option value="IV/d" {{ old('pangkat_golongan', $data->pangkat_golongan)=='IV/d'?'selected':'' }}>IV/d - Pembina Utama Madya</option>
        <option value="IV/e" {{ old('pangkat_golongan', $data->pangkat_golongan)=='IV/e'?'selected':'' }}>IV/e - Pembina Utama</option>
      </optgroup>
    </select>
    @if($errors->has('pangkat_golongan'))<div class="error">{{ $errors->first('pangkat_golongan') }}</div>@endif
  </div>

  <div>
    <label>Pendidikan</label>
    <select name="pendidikan" required>
      <option value="">-- Pilih Pendidikan --</option>
      <option value="S2" {{ old('pendidikan',$data->pendidikan)=='S2'?'selected':'' }}>S2</option>
      <option value="S1" {{ old('pendidikan',$data->pendidikan)=='S1'?'selected':'' }}>S1</option>
      <option value="SMA/Sederajat" {{ old('pendidikan',$data->pendidikan)=='SMA/Sederajat'?'selected':'' }}>SMA/Sederajat</option>
      <option value="SMP" {{ old('pendidikan',$data->pendidikan)=='SMP'?'selected':'' }}>SMP</option>
      <option value="SD" {{ old('pendidikan',$data->pendidikan)=='SD'?'selected':'' }}>SD</option>
      <option value="Tanpa Ijazah" {{ old('pendidikan',$data->pendidikan)=='Tanpa Ijazah'?'selected':'' }}>Tanpa Ijazah</option>
    </select>
    @if($errors->has('pendidikan'))<div class="error">{{ $errors->first('pendidikan') }}</div>@endif
  </div>

  <div>
    <label>Bidang</label>
    <select name="bidang" required>
      <option value="">-- Pilih Bidang --</option>
      <option value="Sekretariat" {{ old('bidang', $data->bidang)=='Sekretariat'?'selected':'' }}>Sekretariat</option>
      <option value="Pemberdayaan Usaha Mikro" {{ old('bidang', $data->bidang)=='Pemberdayaan Usaha Mikro'?'selected':'' }}>Pemberdayaan Usaha Mikro</option>
      <option value="Pembinaan Usaha Perdagangan" {{ old('bidang', $data->bidang)=='Pembinaan Usaha Perdagangan'?'selected':'' }}>Pembinaan Usaha Perdagangan</option>
      <option value="Distribusi Perdagangan" {{ old('bidang', $data->bidang)=='Distribusi Perdagangan'?'selected':'' }}>Distribusi Perdagangan</option>
      <option value="Bidang Koperasi" {{ old('bidang', $data->bidang)=='Bidang Koperasi'?'selected':'' }}>Bidang Koperasi</option>
      <option value="UPTD Metrologi Legal" {{ old('bidang', $data->bidang)=='UPTD Metrologi Legal'?'selected':'' }}>UPTD Metrologi Legal</option>
    </select>
    @if($errors->has('bidang'))<div class="error">{{ $errors->first('bidang') }}</div>@endif
  </div>

  <div>
    <label>Jumlah Pegawai</label>
    <input type="number" name="jumlah" value="{{ old('jumlah',$data->jumlah) }}" required>
    @if($errors->has('jumlah'))<div class="error">{{ $errors->first('jumlah') }}</div>@endif
  </div>

</div>

<button class="btn">Update Data</button>

</form>

</div>
</div>

<script>
  const statusSelect = document.getElementById('statusSelect');
  const pangkatContainer = document.getElementById('pangkatContainer');
  const pangkatInput = document.getElementById('pangkatInput');

  statusSelect.addEventListener('change', function() {
    if (this.value === 'PNS') {
      pangkatContainer.style.display = 'block';
    } else {
      pangkatContainer.style.display = 'none';
      pangkatInput.value = ''; // Kembalikan nilai dropdown ke pilihan kosong
    }
  });
</script>

</body>
</html>