<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<!-- 🔥 Tag wajib agar website responsif di HP -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Magang</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}

body{
  display:flex;
  background:#f4f7fb;
  overflow-x: hidden;
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
  z-index: 1000;
  transition: left 0.3s ease;
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
  font-family: 'Poppins', sans-serif;
  font-weight: 500;
}

/* ================= MAIN ================= */
.main{
  margin-left:240px;
  width:calc(100% - 240px);
  transition: margin-left 0.3s ease, width 0.3s ease;
}

/* NAVBAR */
.navbar{
  background:white;
  padding:15px 30px;
  display:flex;
  justify-content:space-between;
  align-items: center;
  box-shadow:0 2px 10px rgba(0,0,0,0.05);
}

.nav-left {
  display: flex;
  align-items: center;
  gap: 15px;
}

.menu-toggle {
  display: none;
  background: none;
  border: none;
  font-size: 20px;
  cursor: pointer;
  color: #333;
}

/* CONTENT */
.container{
  padding:30px;
}

.top{
  display:flex;
  justify-content:space-between;
  align-items: center;
  margin-bottom:20px;
  flex-wrap: wrap;
  gap: 10px;
}

/* BUTTON */
.btn{
  padding:7px 12px;
  border-radius:8px;
  border:none;
  cursor:pointer;
  font-size:12px;
  text-decoration: none;
  display: inline-block;
  font-family: 'Poppins', sans-serif;
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
  -webkit-overflow-scrolling: touch; /* Memperlancar scroll di iOS */
}

table{
  width:100%;
  border-collapse:collapse;
  font-size:13px;
  min-width: 700px; /* Menjaga agar tabel tidak menyusut terlalu kecil */
}

th{
  padding:12px;
  background:#eef2ff;
  white-space:nowrap;
  text-align: left;
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

/* ================= OVERLAY ================= */
.overlay {
  display: none;
  position: fixed;
  top: 0; 
  left: 0; 
  width: 100%; 
  height: 100%;
  background: rgba(0,0,0,0.5);
  z-index: 999;
}

/* 🔥 MEDIA QUERY UNTUK RESPONSIVE (SMARTPHONE & TABLET) */
@media screen and (max-width: 768px) {
  .sidebar { 
    left: -240px; /* Sembunyikan sidebar ke kiri secara default */
  }
  .sidebar.active { 
    left: 0; /* Tampilkan saat class .active ditambahkan melalui JS */
  }
  .main { 
    margin-left: 0; 
    width: 100%; 
  }
  .menu-toggle { 
    display: block; /* Munculkan tombol hamburger */
  }
  .overlay.active { 
    display: block; /* Munculkan latar belakang gelap */
  }
  .navbar { 
    padding: 15px 20px; 
  }
  .navbar h3 { 
    font-size: 16px; 
  }
  .container { 
    padding: 15px; 
  }
}
</style>
</head>

<body>

<!-- OVERLAY (Hanya Muncul di Mobile saat Sidebar Terbuka) -->
<div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebarMenu">
  <h2>ADMIN</h2>

  <div class="menu">
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
  <div class="nav-left">
    <button class="menu-toggle" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
    <h3>Data Magang</h3>
  </div>
  <span>Halo {{ session('username') ?? 'Admin' }}</span>
</div>

<div class="container">

<div class="top">
  <h2>Data Magang</h2>
  <a href="/admin/magang/create" class="btn btn-add">+ Tambah</a>
</div>

<div class="card">

<div class="table-responsive">
<table>

<thead>
<tr>
<th>No</th>
<th>Email</th>
<th>Nama</th>
<th>Univ</th>
<th>Awal</th>
<th>Akhir</th>
<th>Posisi</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>
@forelse($data as $item)
<tr>

<td>{{ ($data->currentPage()-1)*$data->perPage()+$loop->iteration }}</td>

<td>{{ $item->email }}</td>
<td>{{ $item->nama }}</td>
<td>{{ $item->asal_univ }}</td>
<td>{{ $item->awal_pelaksanaan }}</td>
<td>{{ $item->akhir_pelaksanaan }}</td>
<td>{{ $item->posisi }}</td>

<td>
<div class="action">
<a href="/admin/magang/edit/{{ $item->id }}" class="btn btn-edit">Edit</a>
<button onclick="confirmDelete('/admin/magang/delete/{{ $item->id }}')" class="btn btn-delete">Hapus</button>
</div>
</td>

</tr>
@empty
<tr>
<td colspan="8" align="center">Tidak ada data</td>
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
// 🔥 FUNGSI UNTUK MENGATUR SIDEBAR DI PERANGKAT SELULER
function toggleSidebar() {
  const sidebar = document.getElementById('sidebarMenu');
  const overlay = document.getElementById('overlay');
  
  sidebar.classList.toggle('active');
  overlay.classList.toggle('active');
}

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