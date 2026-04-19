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
  text-decoration:none;
  font-size:14px;
  border:none;
  cursor:pointer;
}

.btn-add{
  background:#20c997;
  color:white;
}

.btn-edit{
  background:#ffc107;
  color:black;
}

.btn-delete{
  background:#dc3545;
  color:white;
}

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
  text-align:left;
  padding:12px;
  background:#eaf2ff;
  color:#374151;
  border-bottom:1px solid #d1d5db;
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

.badge{
  padding:5px 10px;
  border-radius:6px;
  font-size:12px;
  background:#e5e7eb;
}

.action{
  display:flex;
  gap:6px;
}

.alert{
  padding:10px;
  margin-bottom:10px;
  background:#d1e7dd;
  border-radius:6px;
}
</style>
</head>

<body>

<!-- NAVBAR -->
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
  <option value="sk">SK</option>
  <option value="sp">SP</option>
  <option value="sop">SOP</option>
</select>

<input type="number" name="tahun" placeholder="Tahun">

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
<td>{{ $loop->iteration }}</td>
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

</div>

</div>

<!-- SWEETALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

// DELETE
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

// LOGOUT
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
    })};
// LOGIN CHECK
if(localStorage.getItem("login") !== "true"){
  window.location.href = "/";
}

</script>

</body>
</html>