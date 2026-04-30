<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit TDG</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{display:flex;background:#f4f7fb;}
.sidebar{width:240px;height:100vh;background:linear-gradient(180deg,#1f6feb,#2563eb);color:white;padding:20px;position:fixed;display:flex;flex-direction:column;}
.sidebar h2{margin-bottom:25px;}
.menu{display:flex;flex-direction:column;gap:8px;}
.menu a{display:flex;align-items:center;gap:10px;padding:12px;border-radius:10px;color:white;text-decoration:none;transition:0.2s;}
.menu a:hover{background:rgba(255,255,255,0.15);}
.menu .active{background:rgba(255,255,255,0.25);}
.logout-btn{margin-top:auto;padding:12px;border:none;border-radius:10px;background:#ef4444;color:white;cursor:pointer;}
.main{margin-left:240px;width:calc(100% - 240px);}
.navbar{background:white;padding:15px 30px;display:flex;justify-content:space-between;box-shadow:0 2px 10px rgba(0,0,0,0.05);}
.container{padding:30px;}
.card{background:white;padding:20px;border-radius:12px;border:1px solid #e5e7eb;}
.form-group{margin-bottom:15px;}
.form-group label{display:block;margin-bottom:8px;font-weight:600;}
.form-group input,.form-group textarea, .form-group select{width:100%;padding:10px;border-radius:10px;border:1px solid #d1d5db;font-size:14px;}
.btn{padding:10px 16px;border:none;border-radius:10px;cursor:pointer;font-weight:600;}
.btn-primary{background:#2563eb;color:white;}
.btn-secondary{background:#94a3b8;color:white;margin-left:10px;}
.alert{padding:12px 16px;margin-bottom:20px;border-radius:10px;background:#f8d7da;color:#842029;border:1px solid #f5c2c7;}
</style>
</head>
<body>
<div class="sidebar">
  <h2>ADMIN</h2>
  <div class="menu">
    <a href="/admin"><i class="fas fa-chart-line"></i> Dashboard</a>
    <a href="/admin/admin_sekre"><i class="fas fa-user-tie"></i> Sekretariat</a>
    <a href="/admin/pembinaan" class="active"><i class="fas fa-file-invoice"></i> TDG</a>
    <a href="/admin/pembinaan"><i class="fas fa-briefcase"></i> Pembinaan</a>
    <a href="/admin/perdagangan"><i class="fas fa-truck"></i> Perdagangan</a>
  </div>
  <button onclick="logout()" class="logout-btn">Logout</button>
</div>

<div class="main">
<div class="navbar">
  <h3>Edit TDG</h3>
  <span>Halo {{ session('username') ?? 'Admin' }}</span>
</div>

<div class="container">
  <div class="card">
    <h2 style="margin-bottom:20px;">Edit Data TDG</h2>

    @if ($errors->any())
      <div class="alert">
        <strong>Periksa kembali input Anda.</strong>
        <ul style="margin-top:10px;">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('tdg.update', $data->id) }}" method="POST">
      @csrf
      <div class="form-group">
        <label>Nama Usaha</label>
        <input type="text" name="nama_usaha" value="{{ old('nama_usaha', $data->nama_usaha) }}" placeholder="Masukkan nama usaha">
      </div>

      <div class="form-group">
        <label>Pemilik</label>
        <input type="text" name="pemilik" value="{{ old('pemilik', $data->pemilik) }}" placeholder="Masukkan nama pemilik">
      </div>

      <div class="form-group">
        <label>Alamat</label>
        <textarea name="alamat" rows="3" placeholder="Masukkan alamat usaha">{{ old('alamat', $data->alamat) }}</textarea>
      </div>

      <div class="form-group">
        <label>Nama Gudang</label>
        <input type="text" name="nama_gudang" value="{{ old('nama_gudang', $data->nama_gudang) }}" placeholder="Opsional">
      </div>

      <div class="form-group">
        <label>Lokasi Gudang</label>
        <input type="text" name="lokasi_gudang" value="{{ old('lokasi_gudang', $data->lokasi_gudang) }}" placeholder="Opsional">
      </div>

      <div class="form-group">
        <label>Nomor TDG</label>
        <input type="text" name="nomor_tdg" value="{{ old('nomor_tdg', $data->nomor_tdg) }}" placeholder="Masukkan nomor TDG">
      </div>

      <div class="form-group">
        <label>Tanggal Terbit</label>
        <input type="date" name="tanggal_terbit" value="{{ old('tanggal_terbit', $data->tanggal_terbit) }}">
      </div>

      <div class="form-group">
        <label>Status</label>
        <select name="status">
          <option value="Aktif" {{ old('status', $data->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
          <option value="Tidak Aktif" {{ old('status', $data->status) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
        </select>
      </div>

      <button class="btn btn-primary" type="submit">Update</button>
      <a href="{{ route('tdg.index') }}" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</div>
</div>

<script>
function logout(){ window.location.href="/logout"; }
</script>

</body>
</html>
