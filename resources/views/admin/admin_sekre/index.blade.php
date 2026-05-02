<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Sekretariat</title>

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
.main{
  margin-left:240px;
  width:calc(100% - 240px);
  transition: margin-left 0.3s ease, width 0.3s ease;
}

/* NAVBAR */
.navbar{
  background:white;padding:15px 30px;display:flex;justify-content:space-between;align-items: center;
  box-shadow:0 2px 10px rgba(0,0,0,0.04);
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
.container{padding:30px;}

/* 🔥 PERBAIKAN: Card Grid disesuaikan agar card tidak membesar berlebihan */
.cards-grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
  gap:15px;
}

/* 🔥 PERBAIKAN: Ukuran Card dibuat mungil & padat */
.card{
  padding:15px; /* Padding dikurangi */
  border-radius:10px;
  border:none;
  cursor:pointer;
  transition:all .3s ease;
  text-decoration: none; 
  color: white; 
  display: flex;
  flex-direction: column;
  justify-content: center;
  box-shadow: 0 4px 8px rgba(0,0,0,0.05);
  min-height: 110px; /* Membatasi tinggi card */
}

.card:hover{
  transform:translateY(-3px);
  box-shadow:0 8px 15px rgba(0,0,0,0.12);
}

/* 🔥 PERBAIKAN: Ikon & Teks jauh lebih kecil */
.card-icon {
  font-size: 1.5rem; /* Ikon dikecilkan */
  margin-bottom: 8px;
  opacity: 0.9;
}

.card h4 {
  font-size: 14px; /* Judul card lebih kecil */
  font-weight: 600;
  margin-bottom: 2px;
}

.card p {
  font-size: 11px; /* Deskripsi sangat mungil */
  opacity: 0.85;
  line-height: 1.3;
}

/* Pilihan Warna Card */
.card-blue { background: linear-gradient(135deg, #0d6efd, #0a58ca); }
.card-green { background: linear-gradient(135deg, #20c997, #1aa179); }
.card-orange { background: linear-gradient(135deg, #fd7e14, #e37112); }

.alert{
  padding:10px;margin-bottom:20px;background:#d1e7dd;border-radius:6px; color: #0f5132; font-size: 14px;
}

/* OVERLAY UNTUK MOBILE */
.overlay {
  display: none;
  position: fixed;
  top: 0; left: 0; width: 100%; height: 100%;
  background: rgba(0,0,0,0.5);
  z-index: 999;
}

/* MEDIA QUERY UNTUK RESPONSIVE (SMARTPHONE) */
@media screen and (max-width: 768px) {
  .sidebar { left: -240px; }
  .sidebar.active { left: 0; }
  .main { margin-left: 0; width: 100%; }
  .menu-toggle { display: block; }
  .overlay.active { display: block; }
  .navbar { padding: 15px 20px; }
  .navbar h3 { font-size: 16px; }
  .navbar span { font-size: 14px; }
  .container { padding: 20px; }
}
</style>
</head>

<body>

<!-- OVERLAY (Hanya Muncul di Mobile) -->
<div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebarMenu">
  <h2>ADMIN</h2>

  <a href="/admin/admin_sekre" class="active"><i class="fas fa-user-tie"></i> Sekretariat</a>
  <a href="/admin/pembinaan"><i class="fas fa-briefcase"></i> Pembinaan</a>
  <a href="/admin/perdagangan"><i class="fas fa-truck"></i> Perdagangan</a>

  <button onclick="logout()" class="logout-btn">Logout</button>
</div>

<!-- MAIN -->
<div class="main">

<div class="navbar">
  <div class="nav-left">
    <button class="menu-toggle" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
    <h3>Admin Sekretariat</h3>
  </div>
  <span>Halo {{ session('username') ?? 'Admin' }} 👋</span>
</div>

<div class="container">

<h2 style="margin-bottom:20px; color:#333; font-size: 20px;">Dasbor Sekretariat</h2>

@if(session('success'))
<div class="alert">{{ session('success') }}</div>
@endif

<!-- MENU -->
<div class="cards-grid">

  <!-- SURAT: Warna Biru -->
  <a href="{{ route('surat.list') }}" class="card card-blue">
    <i class="fas fa-envelope-open-text card-icon"></i>
    <div>
      <h4>Surat</h4>
      <p>Arsip SK, SP, dan SOP</p>
    </div>
  </a>

  <!-- PEGAWAI: Warna Hijau -->
  <a href="{{ route('pegawai.rekap') }}" class="card card-green">
    <i class="fas fa-users card-icon"></i>
    <div>
      <h4>Data Pegawai</h4>
      <p>Informasi & Rekap Pegawai</p>
    </div>
  </a>

  <!-- MAGANG: Warna Oranye -->
  <a href="{{ route('magang.index') }}" class="card card-orange">
    <i class="fas fa-id-badge card-icon"></i>
    <div>
      <h4>Data Magang</h4>
      <p>Daftar Peserta Magang</p>
    </div>
  </a>

</div>

</div>
</div>

<script>
// Fungsi untuk toggle sidebar di HP
function toggleSidebar() {
  const sidebar = document.getElementById('sidebarMenu');
  const overlay = document.getElementById('overlay');
  
  sidebar.classList.toggle('active');
  overlay.classList.toggle('active');
}

function logout(){
  window.location.href="/logout";
}
</script>

</body>
</html>