<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Magang</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
/* CSS PERSIS SEPERTI MILIK ANDA */
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{display:flex;background:#f4f7fb;overflow-x: hidden;}
.sidebar{width:240px;height:100vh;background:#0d6efd;color:white;padding:20px;position:fixed;z-index: 1000; transition: left 0.3s ease;}
.sidebar h2{margin-bottom:20px;}
.sidebar a{display:block;color:white;padding:10px;border-radius:8px;margin-bottom:8px;text-decoration:none;}
.sidebar a:hover,.sidebar .active{background:rgba(255,255,255,0.2);}
.logout-btn{margin-top:20px;width:100%;padding:10px;border:none;border-radius:8px;background:#dc3545;color:white;cursor:pointer;}
.main{margin-left:240px;width:calc(100% - 240px);transition: margin-left 0.3s ease, width 0.3s ease;}
.navbar{background:white;padding:15px 30px;display:flex;justify-content:space-between;align-items: center;box-shadow:0 2px 10px rgba(0,0,0,0.05);}
.nav-left {display: flex;align-items: center;gap: 15px;}
.menu-toggle {display: none;background: none;border: none;font-size: 20px;cursor: pointer;color: #333;}
.container{padding:30px;}
.top{display:flex;justify-content:space-between;align-items: center;margin-bottom:20px;flex-wrap: wrap;gap: 10px;}
.btn{padding:7px 12px;border-radius:8px;border:none;cursor:pointer;font-size:12px;text-decoration: none;display: inline-block;font-family: 'Poppins', sans-serif;}
.btn-add{background:#22c55e;color:white;}
.btn-edit{background:#facc15;color:black;}
.btn-delete{background:#ef4444;color:white;}
.btn-back{background:#6c757d;color:white;transition: 0.2s ease;}
.btn-back:hover{background:#5a6268;}
.card{background:white;padding:20px;border-radius:12px;border:1px solid #e5e7eb;}
.table-responsive{overflow-x:auto;-webkit-overflow-scrolling: touch;}
table{width:100%;border-collapse:collapse;font-size:13px;min-width: 500px;} /* disesuaikan karena kolom sedikit */
th{padding:12px;background:#eef2ff;white-space:nowrap;text-align: left;}
td{padding:10px;border-bottom:1px solid #e5e7eb;}
tr:nth-child(even){background:#f9fafb;}
tr:hover{background:#eef4ff;}
.action{display:flex;gap:5px;}
.overlay {display: none;position: fixed;top: 0;left: 0;width: 100%;height: 100%;background: rgba(0,0,0,0.5);z-index: 999;}
.alert{padding:10px; background:#d1e7dd; margin-bottom:15px; border-radius:6px; color: #0f5132;}

@media screen and (max-width: 768px) {
  .sidebar {left: -240px;}
  .sidebar.active {left: 0;}
  .main {margin-left: 0;width: 100%;}
  .menu-toggle {display: block;}
  .overlay.active {display: block;}
  .navbar {padding: 15px 20px;}
  .navbar h3 {font-size: 16px;}
  .container {padding: 15px;}
}
</style>
</head>
<body>

<div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

  <div class="sidebar" id="sidebarMenu">
    <h2>ADMIN</h2>
    <a class="active" href="/admin/admin_sekre"><i class="fas fa-user-tie"></i> Sekretariat</a>
    <a href="/admin/admin_pum"><i class="fas fa-store"></i> Pemberdayaan Usaha Mikro</a>
    <a href="/admin/admin_pup"><i class="fas fa-briefcase"></i> Pembinaan Usaha Perdagangan</a>
    <a href="/admin/admin_perdagangan"><i class="fas fa-truck"></i> Distribusi Perdagangan</a>
    <a href="/admin/koperasi"><i class="fas fa-building"></i> Bidang Koperasi</a>
    <a href="/admin/admin_metro"><i class="fas fa-balance-scale"></i> Metrologi Legal</a>
    <button onclick="logout()" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
  </div>

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
      <h2>Rekap Data Magang</h2>
      <div style="display: flex; gap: 10px;">
        <a href="/admin/admin_sekre" class="btn btn-back">← Kembali</a>
        <a href="{{ route('magang.create') }}" class="btn btn-add">+ Tambah Rekap</a>
      </div>
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
              <th>Tahun</th>
              <th>Bulan</th>
              <th>Jumlah Peserta</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($data as $item)
            <tr>
              <td>{{ method_exists($data, 'currentPage') ? ($data->currentPage()-1)*$data->perPage()+$loop->iteration : $loop->iteration }}</td>
              <td><b>{{ $item->tahun }}</b></td>
              <td>{{ $item->bulan }}</td>
              <td>{{ $item->jumlah }} Orang</td>
              <td>
                <div class="action">
                  <a href="{{ route('magang.edit', $item->id) }}" class="btn btn-edit">Edit</a>
                  <button onclick="confirmDelete('/admin/magang/delete/{{ $item->id }}')" class="btn btn-delete">Hapus</button>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" align="center">Tidak ada data rekap magang</td>
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
    showCancelButton:true,
    confirmButtonColor: '#ef4444'
  }).then(r=>{
    if(r.isConfirmed){
      window.location.href=url;
    }
  });
}

function logout() {
  Swal.fire({
    title: 'Logout?',
    text: "Kamu akan keluar",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#0d6efd',
    confirmButtonText: 'Ya, logout'
  }).then((result) => {
    if (result.isConfirmed) {
      localStorage.removeItem("login");
      window.location.href = "/logout";
    }
  });
}
</script>
</body>
</html>