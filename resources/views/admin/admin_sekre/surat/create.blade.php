<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Surat</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins', sans-serif;}
body{background:linear-gradient(135deg,#eef4ff,#f8fafc); min-height: 100vh;}
.navbar{background:white;padding:15px 30px;display:flex;justify-content:space-between;box-shadow:0 2px 10px rgba(0,0,0,0.04);}
.navbar h3{ color:#0d6efd; font-size: 18px;}
.container{display:flex;justify-content:center;align-items:center;min-height: calc(100vh - 60px); padding: 20px;}
.card{ background:rgba(255,255,255,0.9); backdrop-filter:blur(8px); padding:25px; width:100%; max-width:800px; border-radius:14px; border:1px solid rgba(255,255,255,0.4); box-shadow:0 8px 20px rgba(13,110,253,0.08);}
.header{display:flex;justify-content:space-between;align-items:center;margin-bottom:15px;}
.header h2{font-size:18px;color:#374151;}
.back{font-size:13px;text-decoration:none;color:#6b7280;}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:15px;}
label{font-size:12px;color:#6b7280;margin-bottom:5px;display:block;}
input, select{width:100%;padding:10px;border-radius:7px;border:1px solid #d1d5db;font-size:13px;}
input:focus, select:focus{outline:none;border-color:#0d6efd;box-shadow:0 0 0 2px rgba(13,110,253,0.1);}
.error{font-size:11px;color:#dc3545;margin-top:4px;}
.btn{ margin-top:15px; width: 100%; padding:12px; border:none; border-radius:8px; background:#0d6efd; color:white; font-weight:500; cursor:pointer; transition:0.3s;}
.btn:hover{background:#0b5ed7;transform:translateY(-1px);}

@media screen and (max-width: 600px) {
  .form-grid {grid-template-columns: 1fr;} 
  .navbar {padding: 15px 20px;}
  .card {padding: 20px;}
}
</style>
</head>

<body>

<div class="navbar">
  <h3>Admin Surat</h3>
  <div style="font-size: 14px; color:#666;">Tambah Data</div>
</div>

<div class="container">
<div class="card">

<div class="header">
  <h2>Tambah Surat / Dokumen</h2>
  <a href="/admin/admin_sekre/surat" class="back">← Kembali</a>
</div>

<form action="/admin/admin_sekre/store" method="POST" enctype="multipart/form-data">
@csrf

<div class="form-grid">

  <div>
    <label>Jenis</label>
    <select name="jenis" id="jenisDokumen" onchange="toggleForm()" required>
      <option value="SK" {{ old('jenis')=='SK'?'selected':'' }}>SK</option>
      <option value="SP" {{ old('jenis')=='SP'?'selected':'' }}>SP</option>
      <option value="SOP" {{ old('jenis')=='SOP'?'selected':'' }}>SOP</option>
      <option value="ZI" {{ old('jenis')=='ZI'?'selected':'' }}>Zona Integritas (ZI)</option>
    </select>
  </div>

  <div>
    <label>Tahun</label>
    <input type="number" name="tahun" value="{{ old('tahun') }}" required>
    @error('tahun') <div class="error">{{ $message }}</div> @enderror
  </div>

  <div id="wrapNomor">
    <label>Nomor</label>
    <input name="nomor" id="nomorInput" value="{{ old('nomor') }}" required>
    @error('nomor') <div class="error">{{ $message }}</div> @enderror
  </div>

  <div id="wrapJudul">
    <label>Judul</label>
    <input name="judul" id="judulInput" value="{{ old('judul') }}" required>
    @error('judul') <div class="error">{{ $message }}</div> @enderror
  </div>

  <div>
    <label>Bidang</label>
    <input value="Sekretariat" readonly style="background:#f1f5f9; cursor:not-allowed;">
    <input type="hidden" name="bidang" value="sekretariat">
  </div>

  <div>
    <label id="labelFile">Upload File (PDF)</label>
    <input type="file" name="file" id="fileInput" accept="application/pdf" required style="padding: 7px;">
    @error('file') <div class="error">{{ $message }}</div> @enderror
  </div>

</div>

<button type="submit" class="btn">Simpan Data</button>

</form>

</div>
</div>

<script>
function toggleForm() {
    const jenis = document.getElementById('jenisDokumen').value;
    const wrapNomor = document.getElementById('wrapNomor');
    const wrapJudul = document.getElementById('wrapJudul');
    const nomorInput = document.getElementById('nomorInput');
    const judulInput = document.getElementById('judulInput');
    const fileInput = document.getElementById('fileInput');
    const labelFile = document.getElementById('labelFile');

    if (jenis === 'ZI') {
        wrapNomor.style.display = 'none';
        wrapJudul.style.display = 'none';
        nomorInput.removeAttribute('required');
        judulInput.removeAttribute('required');
        
        labelFile.innerHTML = 'Upload File ZI (Excel)';
        fileInput.setAttribute('accept', '.xlsx, .xls, .csv');
    } else {
        wrapNomor.style.display = 'block';
        wrapJudul.style.display = 'block';
        nomorInput.setAttribute('required', 'required');
        judulInput.setAttribute('required', 'required');
        
        labelFile.innerHTML = 'Upload File (PDF)';
        fileInput.setAttribute('accept', 'application/pdf');
    }
}

// Jalankan otomatis saat halaman dimuat
document.addEventListener('DOMContentLoaded', toggleForm);
</script>

</body>
</html>