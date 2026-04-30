<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Surat Sekretariat</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{display:flex;background:#f8fafc;}
.sidebar{width:240px;height:100vh;background:#0d6efd;color:white;padding:20px;position:fixed;}
.sidebar h2{margin-bottom:20px;}
.sidebar a{display:block;color:white;padding:10px;border-radius:8px;margin-bottom:8px;text-decoration:none;}
.sidebar a:hover,.sidebar .active{background:rgba(255,255,255,0.2);}
.logout-btn{margin-top:20px;width:100%;padding:10px;border:none;border-radius:8px;background:#dc3545;color:white;cursor:pointer;}
.main{margin-left:240px;width:100%;}
.navbar{background:white;padding:15px 30px;display:flex;justify-content:space-between;box-shadow:0 2px 10px rgba(0,0,0,0.04);}
.container{padding:30px;}
.top{display:flex;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:10px;}
.btn{padding:8px 14px;border-radius:8px;border:none;cursor:pointer;}
.btn-add{background:#20c997;color:white;}
.btn-edit{background:#ffc107;color:black;}
.btn-delete{background:#dc3545;color:white;}
.card{background:white;padding:20px;border-radius:12px;border:1px solid #e5e7eb;}
.filter{display:flex;gap:10px;margin-bottom:15px;flex-wrap:wrap;}
.filter input,.filter select{padding:8px;border-radius:6px;border:1px solid #d1d5db;}
table{width:100%;border-collapse:collapse;}
.table-responsive{overflow-x:auto;}
th{padding:12px;background:#eaf2ff;}
td{padding:12px;border-bottom:1px solid #e5e7eb;}
tbody tr:nth-child(even){background:#f9fafb;}
tr:hover{background:#eef4ff;}
.badge{padding:5px 10px;border-radius:6px;font-size:12px;background:#e5e7eb;}
.action{display:flex;gap:6px;flex-wrap:wrap;}
.alert{padding:10px;margin-bottom:10px;background:#d1e7dd;border-radius:6px;}
.pagination-wrapper{display:flex;justify-content:space-between;margin-top:15px;flex-wrap:wrap;}
.pagination{display:flex;gap:6px;}
.pagination li{list-style:none;}
.pagination a,.pagination span{padding:6px 12px;border-radius:8px;border:1px solid #d1d5db;background:white;text-decoration:none;color:#333;}
.pagination a:hover{background:#0d6efd;color:white;}
.pagination .active span{background:#0d6efd;color:white;}
.pagination-info{font-size:13px;color:#666;}
</style>
</head>
<body>

<div class="sidebar">
  <h2>ADMIN</h2>
  <a href="/admin"><i class="fas fa-chart-line"></i> Dashboard</a>
  <a href="/admin/admin_sekre" class="active"><i class="fas fa-user-tie"></i> Sekretariat</a>
  <a href="/admin/pembinaan"><i class="fas fa-briefcase"></i> Pembinaan</a>
  <a href="/admin/perdagangan"><i class="fas fa-truck"></i> Perdagangan</a>
  <button onclick="logout()" class="logout-btn">Logout</button>
</div>

<div class="main">

<div class="navbar">
  <h3>Data Surat Sekretariat</h3>
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