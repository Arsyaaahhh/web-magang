<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Rekap Pegawai</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{display:flex;background:#f8fafc;}

/* SIDEBAR */
.sidebar{
  width:240px;height:100vh;background:#0d6efd;color:white;padding:20px;position:fixed;
}
.sidebar h2{margin-bottom:20px;}
.sidebar a{
  display:block;color:white;padding:10px;border-radius:8px;margin-bottom:8px;text-decoration:none;
}
.sidebar a:hover,.sidebar .active{background:rgba(255,255,255,0.2);}
.logout-btn{
  margin-top:20px;width:100%;padding:10px;border:none;border-radius:8px;background:#dc3545;color:white;
  cursor:pointer;
}

/* MAIN */
.main{margin-left:240px;width:100%;}

/* NAVBAR */
.navbar{
  background:white;padding:15px 30px;display:flex;justify-content:space-between;
  box-shadow:0 2px 10px rgba(0,0,0,0.04);
}

/* CONTENT */
.container{padding:30px;}

.top{
  display:flex;
  justify-content:space-between;
  margin-bottom:20px;
}

/* BUTTON */
.btn-add{
  padding:8px 14px;
  background:#20c997;
  color:white;
  border-radius:8px;
  text-decoration:none;
}

.btn-edit{
  padding:6px 10px;
  background:#ffc107;
  border-radius:6px;
  text-decoration:none;
  color:black;
}

.btn-delete{
  padding:6px 10px;
  background:#dc3545;
  border-radius:6px;
  color:white;
  border:none;
  cursor:pointer;
}

/* CARD */
.card{
  background:white;
  padding:20px;
  border-radius:12px;
  border:1px solid #e5e7eb;
}

/* TABLE */
table{
  width:100%;
  border-collapse:collapse;
}

th{
  background:#eaf2ff;
  padding:12px;
}

td{
  padding:12px;
  border-bottom:1px solid #e5e7eb;
}

.action{
  display:flex;
  gap:6px;
}

.alert{
  padding:10px;
  background:#d1e7dd;
  margin-bottom:10px;
  border-radius:6px;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <h2>ADMIN</h2>

  <a href="/admin"><i class="fas fa-chart-line"></i> Dashboard</a>
  <a href="/admin/admin_sekre" class="active"><i class="fas fa-user-tie"></i> Sekretariat</a>
  <a href="/admin/pembinaan"><i class="fas fa-briefcase"></i> Pembinaan</a>
  <a href="/admin/perdagangan"><i class="fas fa-truck"></i> Perdagangan</a>

  <button onclick="logout()" class="logout-btn">Logout</button>
</div>

<!-- MAIN -->
<div class="main">

<div class="navbar">
  <h3>Rekap Pegawai</h3>
  <span>Halo {{ session('username') ?? 'Admin' }}</span>
</div>

<div class="container">

<div class="top">
  <h2>Data Rekap Pegawai</h2>

  <!-- 🔥 KE CREATE -->
  <a href="{{ route('pegawai.rekap.create') }}" class="btn-add">
    + Tambah
  </a>
</div>

@if(session('success'))
<div class="alert">
  {{ session('success') }}
</div>
@endif

<div class="card">
<table>

<tr>
<th>No</th>
<th>Status</th>
<th>Pendidikan</th>
<th>Jumlah</th>
<th>Aksi</th>
</tr>

@forelse($data as $d)
<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $d->status }}</td>
<td>{{ $d->pendidikan }}</td>
<td>{{ $d->jumlah }}</td>

<td>
  <div class="action">
    <a href="{{ route('pegawai.rekap.edit',$d->id) }}" class="btn-edit">Edit</a>

    <form action="{{ route('pegawai.rekap.delete',$d->id) }}" method="GET">
      <button class="btn-delete">Hapus</button>
    </form>
  </div>
</td>

</tr>
@empty
<tr>
<td colspan="5" align="center">Tidak ada data</td>
</tr>
@endforelse

</table>
</div>

</div>
</div>

<script>
function logout(){
  window.location.href="/logout";
}
</script>

</body>
</html>