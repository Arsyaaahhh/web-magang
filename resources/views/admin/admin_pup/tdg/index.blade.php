<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data TDG</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{display:flex;background:#f4f7fb;}

/* SIDEBAR */
.sidebar{
  width:240px;
  height:100vh;
  background:linear-gradient(180deg,#1f6feb,#2563eb);
  color:white;
  padding:20px;
  position:fixed;
  display:flex;
  flex-direction:column;
}

.sidebar h2{margin-bottom:20px;}

.menu{
  display:flex;
  flex-direction:column;
  gap:8px;
}

.menu a{
  display:flex;
  align-items:center;
  gap:10px;
  padding:12px;
  border-radius:10px;
  color:white;
  text-decoration:none;
  transition:0.2s;
}

.menu a:hover{
  background:rgba(255,255,255,0.15);
}

.menu .active{
  background:rgba(255,255,255,0.25);
}

.logout-btn{
  margin-top:auto;
  padding:12px;
  border:none;
  border-radius:10px;
  background:#ef4444;
  color:white;
  cursor:pointer;
}

/* MAIN */
.main{
  margin-left:240px;
  width:calc(100% - 240px);
}

/* NAVBAR */
.navbar{
  background:white;
  padding:15px 30px;
  display:flex;
  justify-content:space-between;
  box-shadow:0 2px 10px rgba(0,0,0,0.05);
}

/* CONTENT */
.container{
  padding:30px;
}

.top{
  display:flex;
  justify-content:space-between;
  margin-bottom:20px;
}

/* BUTTON */
.btn{
  padding:8px 14px;
  border-radius:8px;
  border:none;
  cursor:pointer;
  background:#22c55e;
  color:white;
  text-decoration:none;
}

/* CARD */
.card{
  background:white;
  padding:20px;
  border-radius:12px;
  border:1px solid #e5e7eb;
}

/* TABLE */
.table-responsive{
  overflow-x:auto;
}

table{
  width:100%;
  border-collapse:collapse;
  font-size:13px;
}

th{
  padding:12px;
  background:#eaf2ff;
}

td{
  padding:10px;
  border-bottom:1px solid #e5e7eb;
}

tr:nth-child(even){
  background:#f9fafb;
}

tr:hover{
  background:#eef4ff;
}

.action{
  display:flex;
  gap:6px;
}

/* ALERT */
.alert{
  padding:10px;
  margin-bottom:10px;
  background:#d1e7dd;
  border-radius:6px;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <h2>ADMIN</h2>

  <div class="menu">
    <a href="/admin">
      <i class="fas fa-chart-line"></i> Dashboard
    </a>

    <a href="/admin/admin_sekre">
      <i class="fas fa-user-tie"></i> Sekretariat
    </a>

    <a href="/admin/pembinaan" class="active">
      <i class="fas fa-briefcase"></i> Pembinaan
    </a>

    <a href="/admin/perdagangan">
      <i class="fas fa-truck"></i> Perdagangan
    </a>
  </div>

  <button onclick="logout()" class="logout-btn">
    <i class="fas fa-sign-out-alt"></i> Logout
  </button>
</div>

<!-- MAIN -->
<div class="main">

<!-- NAVBAR -->
<div class="navbar">
  <h3>Data TDG</h3>
  <span>Halo {{ session('username') ?? 'Admin' }}</span>
</div>

<!-- CONTENT -->
<div class="container">

<div class="top">
  <h2>Data TDG</h2>
  <a href="{{ route('tdg.create') }}" class="btn">
    <i class="fas fa-plus"></i> Tambah
  </a>
</div>

@if(session('success'))
<div class="alert">{{ session('success') }}</div>
@endif

<div class="card">

<div class="table-responsive">
<table>

<thead>
<tr>
<th>No</th>
<th>Nama Usaha</th>
<th>Nomor TDG</th>
<th>Tanggal</th>
<th>Status</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>
@forelse($data as $item)
<tr>

<td>{{ ($data->currentPage()-1)*$data->perPage()+$loop->iteration }}</td>
<td>{{ $item->nama_usaha }}</td>
<td>{{ $item->nomor_tdg }}</td>
<td>{{ $item->tanggal_terbit }}</td>
<td>{{ $item->status }}</td>

<td>
<div class="action">
  <a href="{{ route('tdg.edit',$item->id) }}">
    <i class="fas fa-pen"></i>
  </a>
  <a href="{{ route('tdg.delete',$item->id) }}">
    <i class="fas fa-trash"></i>
  </a>
</div>
</td>

</tr>
@empty
<tr>
<td colspan="6" align="center">Tidak ada data</td>
</tr>
@endforelse
</tbody>

</table>
</div>

<br>
{{ $data->links() }}

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