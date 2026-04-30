<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin Pembinaan</title>

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

.card{
  background:white;padding:20px;border-radius:12px;border:1px solid #e5e7eb;
}

.cards-grid{
  display:flex;
  gap:16px;
  overflow-x:auto;
  padding-bottom:8px;
}

.cards-grid::-webkit-scrollbar{
  height:8px;
}

.cards-grid::-webkit-scrollbar-thumb{
  background:rgba(13,110,253,0.3);
  border-radius:999px;
}

.menu-card{
  cursor:pointer;
  min-width:280px;
  flex:0 0 280px;
  transition:.2s;
}

.menu-card:hover{
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

  <a href="/admin"><i class="fas fa-chart-line"></i> Dashboard</a>
  <a href="/admin/admin_sekre"><i class="fas fa-user-tie"></i> Sekretariat</a>
  <a href="/admin/pembinaan" class="active"><i class="fas fa-briefcase"></i> Pembinaan</a>
  <a href="/admin/perdagangan"><i class="fas fa-truck"></i> Perdagangan</a>

  <button onclick="logout()" class="logout-btn">
    <i class="fas fa-sign-out-alt"></i> Logout
  </button>
</div>

<!-- MAIN -->
<div class="main">

<div class="navbar">
  <h3>Admin Pembinaan</h3>
  <span>Halo {{ session('username') ?? 'Admin' }} 👋</span>
</div>

<div class="container">

<h2 style="margin-bottom:20px;">Dashboard Pembinaan</h2>

@if(session('success'))
<div class="alert">{{ session('success') }}</div>
@endif

<!-- MENU -->
<div class="cards-grid">

  <!-- TDG -->
  <div class="card menu-card" onclick="go('/tdg')">
    <h4><i class="fas fa-warehouse"></i> TDG</h4>
    <p>Tanda Daftar Gudang</p>
  </div>

  <!-- PERIZINAN -->
  <div class="card menu-card" onclick="go('/pengawasan')">
    <h4><i class="fas fa-file-signature"></i> Data Pengawasan</h4>
    <p>Data Pengawasan (Toko Swalayan, Gudang Minuman Beralkohol)</p>
  </div>

  <!-- ALKOHOL -->
  <div class="card menu-card" onclick="go('/alkohol')">
    <h4><i class="fas fa-wine-bottle"></i> Data Penjual Alkohol</h4>
    <p>Rincian Data Penjual Langsung Minuman Beralkohol Golongan B dan C</p>
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