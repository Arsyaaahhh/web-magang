<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Surat Sekretariat</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{display:flex;background:#f8fafc; overflow-x: hidden;}

/* SIDEBAR */
.sidebar{width:240px;height:100vh;background:#0d6efd;color:white;padding:20px;position:fixed; z-index: 1000; transition: left 0.3s ease;}
.sidebar h2{margin-bottom:20px;}
.sidebar a{display:block;color:white;padding:10px;border-radius:8px;margin-bottom:8px;text-decoration:none;}
.sidebar a:hover,.sidebar .active{background:rgba(255,255,255,0.2);}
.logout-btn{margin-top:20px;width:100%;padding:10px;border:none;border-radius:8px;background:#dc3545;color:white;cursor:pointer;}

/* MAIN */
.main{margin-left:240px;width:calc(100% - 240px); transition: margin-left 0.3s ease, width 0.3s ease;}
.navbar{background:white;padding:15px 30px;display:flex;justify-content:space-between; align-items:center; box-shadow:0 2px 10px rgba(0,0,0,0.04);}
.nav-left {display: flex; align-items: center; gap: 15px;}
.menu-toggle {display: none; background: none; border: none; font-size: 24px; cursor: pointer; color: #333;}

.container{padding:30px;}
.top{display:flex;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:10px; align-items: center;}
.btn{padding:8px 14px;border-radius:8px;border:none;cursor:pointer; text-decoration: none; display: inline-block; font-size: 14px;}
.btn-add{background:#20c997;color:white;}
.btn-edit{background:#ffc107;color:black;}
.btn-delete{background:#dc3545;color:white;}

.card{background:white;padding:20px;border-radius:12px;border:1px solid #e5e7eb;}
.filter{display:flex;gap:10px;margin-bottom:15px;flex-wrap:wrap;}
.filter input,.filter select{padding:8px;border-radius:6px;border:1px solid #d1d5db; flex: 1; min-width: 150px;}
.filter button {flex-shrink: 0;}

table{width:100%;border-collapse:collapse; min-width: 600px;}
.table-responsive{overflow-x:auto; -webkit-overflow-scrolling: touch;}
th{padding:12px;background:#eaf2ff; text-align: left; white-space: nowrap;}
td{padding:12px;border-bottom:1px solid #e5e7eb;}
tbody tr:nth-child(even){background:#f9fafb;}
tr:hover{background:#eef4ff;}

.badge{padding:5px 10px;border-radius:6px;font-size:12px;background:#e5e7eb;}
.action{display:flex;gap:6px;flex-wrap:wrap;}
.alert{padding:10px;margin-bottom:10px;background:#d1e7dd;border-radius:6px;}

.pagination-wrapper{display:flex;justify-content:space-between;margin-top:15px;flex-wrap:wrap; gap: 10px;}
.pagination{display:flex;gap:6px; flex-wrap: wrap;}
.pagination li{list-style:none;}
.pagination a,.pagination span{padding:6px 12px;border-radius:8px;border:1px solid #d1d5db;background:white;text-decoration:none;color:#333;}
.pagination a:hover{background:#0d6efd;color:white;}
.pagination .active span{background:#0d6efd;color:white;}
.pagination-info{font-size:13px;color:#666;}

/* OVERLAY UNTUK MOBILE */
.overlay {display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 999;}

/* 🔥 MEDIA QUERY RESPONSIVE (SMARTPHONE) */
@media screen and (max-width: 768px) {
  .sidebar {left: -240px;}
  .sidebar.active {left: 0;}
  .main {margin-left: 0; width: 100%;}
  .menu-toggle {display: block;}
  .overlay.active {display: block;}
  .navbar {padding: 15px 20px;}
  .navbar h3 {font-size: 16px;}
  .container {padding: 15px;}
  .filter {flex-direction: column;}
  .filter input, .filter select, .filter button {width: 100%;}
}
</style>
</head>
<body>

<div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

<div class="sidebar" id="sidebarMenu">
  <h2>ADMIN</h2>
  <!-- Link Dashboard dihapus -->
  <a href="/admin/admin_sekre" class="active"><i class="fas fa-user-tie"></i> Sekretariat</a>
  <a href="/admin/pembinaan"><i class="fas fa-briefcase"></i> Pembinaan</a>
  <a href="/admin/perdagangan"><i class="fas fa-truck"></i> Perdagangan</a>
  <button onclick="logout()" class="logout-btn">Logout</button>
</div>

<div class="main">

<div class="navbar">
  <div class="nav-left">
    <button class="menu-toggle" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
    <h3>Data Surat Sekretariat</h3>
  </div>
  <span>Halo {{ session('username') ?? 'Admin' }} 👋</span>
</div>

<div class="container">

<div class="top">
  <h2>Data Surat</h2>
  <a href="{{ route('surat.create') }}" class="btn btn-add">+ Tambah Data</a>
</div>

@if(session('success'))
<div class="alert">{{ session('success') }}</div>
@endif

<div class="card">
  <form method="GET">
    <div class="filter">
      <input type="text" name="search" placeholder="Cari nomor atau judul" value="{{ request('search') }}">
      <select name="jenis">
        <option value="">Semua Jenis</option>
        <option value="SK" {{ request('jenis')=='SK'?'selected':'' }}>SK</option>
        <option value="SP" {{ request('jenis')=='SP'?'selected':'' }}>SP</option>
        <option value="SOP" {{ request('jenis')=='SOP'?'selected':'' }}>SOP</option>
      </select>
      <input type="number" name="tahun" placeholder="Tahun" value="{{ request('tahun') }}">
      <button class="btn btn-add">Filter</button>
    </div>
  </form>

  <div class="table-responsive">
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nomor</th>
          <th>Judul</th>
          <th>Jenis</th>
          <th>Tahun</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($data as $d)
        <tr>
          <td>{{ ($data->currentPage()-1)*$data->perPage()+$loop->iteration }}</td>
          <td>{{ $d->nomor }}</td>
          <td>{{ $d->judul }}</td>
          <td><span class="badge">{{ strtoupper($d->jenis) }}</span></td>
          <td>{{ $d->tahun }}</td>
          <td>
            <div class="action">
              <a href="{{ route('surat.edit', $d->id) }}" class="btn btn-edit">Edit</a>
              <button type="button" data-url="{{ route('surat.destroy', $d->id) }}" class="btn btn-delete delete-btn">Hapus</button>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" align="center">Tidak ada data surat</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="pagination-wrapper">
    <div class="pagination">
      {{ $data->links('components.pagination') }}
    </div>
    <div class="pagination-info">
      Showing {{ $data->firstItem() }} - {{ $data->lastItem() }} of {{ $data->total() }}
    </div>
  </div>
</div>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Fungsi toggle sidebar mobile
function toggleSidebar() {
  document.getElementById('sidebarMenu').classList.toggle('active');
  document.getElementById('overlay').classList.toggle('active');
}

document.querySelectorAll('.delete-btn').forEach(function(button) {
  button.addEventListener('click', function() {
    var url = this.dataset.url;
    Swal.fire({
      title: 'Yakin?',
      text: 'Data surat akan dihapus!',
      icon: 'warning',
      showCancelButton: true
    }).then(function(result) {
      if (result.isConfirmed) {
        window.location.href = url;
      }
    });
  });
});
function logout(){ window.location.href='/logout'; }
</script>

</body>
</html>