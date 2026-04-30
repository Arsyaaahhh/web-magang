<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Pegawai</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}

body{
  display:flex;
  background:#f4f7fb;
}

/* ================= SIDEBAR ================= */
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

.sidebar h2{
  margin-bottom:25px;
}

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

/* ================= MAIN ================= */
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
  padding:7px 12px;
  border-radius:8px;
  border:none;
  cursor:pointer;
  font-size:12px;
}

.btn-add{background:#22c55e;color:white;}
.btn-edit{background:#facc15;color:black;}
.btn-delete{background:#ef4444;color:white;}

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
  background:#eef2ff;
  white-space:nowrap;
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
  gap:5px;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <h2>ADMIN</h2>

    <a href="/admin/admin_sekre" class="active">
      <i class="fas fa-user-tie"></i> Sekretariat
    </a>

    <a href="/admin/pembinaan">
      <i class="fas fa-briefcase"></i> Pembinaan
    </a>

    <a href="/admin/perdagangan">
      <i class="fas fa-truck"></i> Perdagangan
    </a>
  </div>

  <button onclick="logout()" class="logout-btn">
    Logout
  </button>
</div>

<!-- MAIN -->
<div class="main">

<div class="navbar">
  <h3>Data Pegawai</h3>
  <span>Halo {{ session('username') ?? 'Admin' }}</span>
</div>

<div class="container">

<div class="top">
  <h2>Data Pegawai</h2>
  <a href="{{ route('pegawai.create') }}" class="btn btn-add">+ Tambah</a>
</div>

<div class="card">

<div class="table-responsive">
<table>

<thead>
<tr>
<th>No</th>
<th>Nama</th>
<th>NIP</th>
<th>Bidang</th>
<th>Posisi</th>
<th>Alamat</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>
@forelse($data as $item)
<tr>

<td>{{ ($data->currentPage()-1)*$data->perPage()+$loop->iteration }}</td>
<td>{{ $item->nama }}</td>
<td>{{ $item->nip }}</td>
<td>{{ $item->bidang }}</td>
<td>{{ $item->posisi }}</td>
<td>{{ $item->alamat }}</td>

<td>
<div class="action">
<a href="{{ route('pegawai.edit', $item->id) }}" class="btn btn-edit">Edit</a>
<button onclick="confirmDelete('{{ route('pegawai.delete', $item->id) }}')" class="btn btn-delete">Hapus</button>
</div>
</td>

</tr>
@empty
<tr>
<td colspan="7" align="center">Tidak ada data</td>
</tr>
@endforelse
</tbody>

</table>
</div>

</div>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmDelete(url){
  Swal.fire({
    title:'Yakin?',
    text:'Data akan dihapus!',
    icon:'warning',
    showCancelButton:true
  }).then(r=>{
    if(r.isConfirmed){
      window.location.href=url;
    }
  });
}

function logout(){
  window.location.href="/logout";
}
</script>

</body>
</html>