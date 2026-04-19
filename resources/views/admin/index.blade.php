<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin Surat</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Poppins', sans-serif;
}

body{
  background:#f8fafc;
}

/* NAVBAR */
.navbar{
  background:white;
  padding:15px 30px;
  display:flex;
  justify-content:space-between;
  align-items:center;
  box-shadow:0 2px 10px rgba(0,0,0,0.04);
}

.navbar h3{
  color:#0d6efd;
}

/* CONTAINER */
.container{
  padding:30px;
}

/* HEADER */
.top{
  display:flex;
  justify-content:space-between;
  margin-bottom:20px;
}

/* BUTTON */
.btn{
  padding:8px 14px;
  border-radius:8px;
  font-size:14px;
  border:none;
  cursor:pointer;
}

.btn-add{ background:#20c997; color:white; }
.btn-edit{ background:#ffc107; color:black; }
.btn-delete{ background:#dc3545; color:white; }

/* CARD */
.card{
  background:white;
  padding:20px;
  border-radius:12px;
  border:1px solid #e5e7eb;
}

/* FILTER */
.filter{
  display:flex;
  gap:10px;
  margin-bottom:15px;
}

.filter input, .filter select{
  padding:8px;
  border-radius:6px;
  border:1px solid #d1d5db;
}

/* TABLE */
table{
  width:100%;
  border-collapse:collapse;
  border:1px solid #e5e7eb;
}

th{
  padding:12px;
  background:#eaf2ff;
}

td{
  padding:12px;
  border-bottom:1px solid #e5e7eb;
}

tbody tr:nth-child(even){
  background:#f9fafb;
}

tr:hover{
  background:#eef4ff;
}

/* BADGE */
.badge{
  padding:5px 10px;
  border-radius:6px;
  font-size:12px;
  background:#e5e7eb;
}

/* ACTION */
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

/* ================= PAGINATION FIX FINAL ================= */

/* WRAPPER */
.pagination-wrapper{
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-top:15px;
  flex-wrap:wrap;
  gap:10px;
}

/* PAGINATION CONTAINER */
.pagination{
  display:flex;
  gap:6px;
}

/* ITEM */
.pagination li{
  list-style:none;
}

/* LINK STYLE */
.pagination a,
.pagination span{
  display:inline-block;
  padding:6px 12px;
  border-radius:8px;
  border:1px solid #d1d5db;
  background:white;
  color:#333;
  text-decoration:none;
  font-size:14px;
  transition:0.2s;
}

/* HOVER */
.pagination a:hover{
  background:#0d6efd;
  color:white;
}

/* ACTIVE */
.pagination .active span{
  background:#0d6efd;
  color:white;
  border-color:#0d6efd;
}

/* DISABLED */
.pagination .disabled span{
  color:#aaa;
  background:#f3f4f6;
}

/* INFO TEXT */
.pagination-info{
  font-size:13px;
  color:#666;
}
</style>
</head>

<body>

<div class="navbar">
  <h3>Admin Surat</h3>

  <div style="display:flex; gap:10px; align-items:center;">
    <span>Halo {{ session('username') ?? 'Admin' }} 👋</span>

    <button onclick="logout()" class="btn btn-delete">
      Logout
    </button>
  </div>
</div>

<div class="container">

<div class="top">
<h2>Data Surat</h2>
<a href="/admin/create" class="btn btn-add">+ Tambah</a>
</div>

@if(session('success'))
<div class="alert">
  {{ session('success') }}
</div>
@endif

<div class="card">

<!-- FILTER -->
<form method="GET">
<div class="filter">

<input type="text" name="search" placeholder="Cari judul / nomor..."
value="{{ request('search') }}">

<select name="jenis">
  <option value="">Semua Jenis</option>
  <option value="sk" {{ request('jenis')=='sk'?'selected':'' }}>SK</option>
  <option value="sp" {{ request('jenis')=='sp'?'selected':'' }}>SP</option>
  <option value="sop" {{ request('jenis')=='sop'?'selected':'' }}>SOP</option>
</select>

<input type="number" name="tahun" placeholder="Tahun" value="{{ request('tahun') }}">

<select name="bidang">
  <option value="">Semua Bidang</option>
  <option value="sekretariat" {{ request('bidang')=='sekretariat'?'selected':'' }}>Sekretariat</option>
  <option value="perdagangan" {{ request('bidang')=='perdagangan'?'selected':'' }}>Perdagangan</option>
  <option value="mikro" {{ request('bidang')=='mikro'?'selected':'' }}>Mikro</option>
  <option value="koperasi" {{ request('bidang')=='koperasi'?'selected':'' }}>Koperasi</option>
  <option value="pembinaan" {{ request('bidang')=='pembinaan'?'selected':'' }}>Pembinaan</option>
  <option value="metrologi" {{ request('bidang')=='metrologi'?'selected':'' }}>Metrologi</option>
</select>

<button type="submit" class="btn">Filter</button>

</div>
</form>

<table>
<thead>
<tr>
<th>No</th>
<th>Nomor</th>
<th>Judul</th>
<th>Jenis</th>
<th>Tahun</th>
<th>Bidang</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>
@forelse($data as $d)
<tr>
<td>{{ ($data->currentPage()-1)*$data->perPage() + $loop->iteration }}</td>
<td>{{ $d->nomor }}</td>
<td>{{ $d->judul }}</td>
<td><span class="badge">{{ strtoupper($d->jenis) }}</span></td>
<td>{{ $d->tahun }}</td>
<td>{{ $d->bidang }}</td>
<td>
<div class="action">
<a href="/admin/edit/{{ $d->id }}" class="btn btn-edit">Edit</a>
<button onclick="confirmDelete('/admin/delete/{{ $d->id }}')" class="btn btn-delete">
  Hapus
</button>
</div>
</td>
</tr>
@empty
<tr>
<td colspan="7" style="text-align:center;">Tidak ada data</td>
</tr>
@endforelse
</tbody>
</table>

<!-- 🔥 PAGINATION WRAPPER -->
<div class="pagination-wrapper">

  <div class="pagination">
    {{ $data->links('components.pagination') }}
  </div>

  <div class="pagination-info">
    Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} results
  </div>

</div>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmDelete(url){
    Swal.fire({
        title: 'Yakin?',
        text: "Data akan dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}

function logout(){
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

if(localStorage.getItem("login") !== "true"){
  window.location.href = "/";
}
</script>

</body>
</html>