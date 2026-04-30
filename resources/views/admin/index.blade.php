<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin Sekretariat</title>

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

.cards-grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
  gap:16px;
}

.card{
  background:white;
  padding:20px;
  border-radius:12px;
  border:1px solid #e5e7eb;
  cursor:pointer;
  transition:.2s;
}

.card:hover{
  transform:translateY(-3px);
  box-shadow:0 10px 30px rgba(13,110,253,0.12);
}

.alert{
  padding:10px;margin-bottom:10px;background:#d1e7dd;border-radius:6px;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <h2>ADMIN</h2>

  <a href="/admin/admin_sekre" class="active"><i class="fas fa-user-tie"></i> Sekretariat</a>
  <a href="/admin/pembinaan"><i class="fas fa-briefcase"></i> Pembinaan</a>
  <a href="/admin/perdagangan"><i class="fas fa-truck"></i> Perdagangan</a>

  <button onclick="logout()" class="logout-btn">Logout</button>
</div>

<!-- MAIN -->
<div class="main">

<div class="navbar">
  <h3>Admin Sekretariat</h3>
  <span>Halo {{ session('username') ?? 'Admin' }} 👋</span>
</div>

<div class="container">

<h2 style="margin-bottom:20px;">Admin Sekretariat</h2>

@if(session('success'))
<div class="alert">{{ session('success') }}</div>
@endif

<!-- MENU -->
<div class="cards-grid">

  <!-- SURAT -->
  <div class="card" onclick="go('/admin/admin_sekre/surat')">
    <h4>Surat</h4>
    <p>SK, SP, dan SOP</p>
  </div>

  <!-- PEGAWAI -->
  <div class="card" onclick="go('{{ route('pegawai.index') }}')">
    <h4>Data Pegawai</h4>
    <p>Informasi pegawai sekretariat</p>
  </div>

  <!-- MAGANG -->
  <div class="card" onclick="go('{{ route('magang.index') }}')">
    <h4>Data Magang</h4>
    <p>Daftar peserta magang</p>
  </div>

</div>

</div>
</div>

<script>
function go(url){
  window.location.href = url;
}

function logout(){
  window.location.href="/logout";
}
</script>

</body>
</html>