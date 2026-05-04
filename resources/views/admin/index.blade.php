<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<!-- Tag ini wajib agar website bisa menyesuaikan layar HP -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Sekretariat</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{display:flex;background:#f8fafc; overflow-x: hidden;}

/* SIDEBAR */
.sidebar{
  width:240px;height:100vh;background:#0d6efd;color:white;padding:20px;position:fixed;
  z-index: 1000; transition: left 0.3s ease;
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
  font-size: 24px;
  cursor: pointer;
  color: #333;
}

/* CONTENT */
.container{padding:30px;}

.cards-grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
  gap:16px;
}

/* 🔥 PERBAIKAN: Card diubah menjadi tag <a> agar tidak perlu JavaScript */
.card{
  background:white;
  padding:20px;
  border-radius:12px;
  border:1px solid #e5e7eb;
  cursor:pointer;
  transition:.2s;
  text-decoration: none; /* Menghilangkan garis bawah link */
  color: inherit; /* Warna teks mengikuti aslinya */
  display: block; /* Agar tag <a> berbentuk blok penuh */
}

.card:hover{
  transform:translateY(-3px);
  box-shadow:0 10px 30px rgba(13,110,253,0.12);
}

.alert{
  padding:10px;margin-bottom:10px;background:#d1e7dd;border-radius:6px;
}

/* OVERLAY UNTUK MOBILE */
.overlay {
  display: none;
  position: fixed;
  top: 0; left: 0; width: 100%; height: 100%;
  background: rgba(0,0,0,0.5);
  z-index: 999;
}

/* 🔥 MEDIA QUERY UNTUK RESPONSIVE (SMARTPHONE) */
@media screen and (max-width: 768px) {
  .sidebar {
    left: -240px; /* Sembunyikan sidebar ke kiri */
  }
  .sidebar.active {
    left: 0; /* Tampilkan saat class active ditambahkan */
  }
  .main {
    margin-left: 0;
    width: 100%;
  }
  .menu-toggle {
    display: block; /* Munculkan tombol hamburger */
  }
  .overlay.active {
    display: block; /* Munculkan overlay gelap */
  }
  .navbar {
    padding: 15px 20px;
  }
  .container {
    padding: 20px;
  }
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
      <a href="/admin/admin_pum">
      <i class="fas fa-store"></i> Pemberdayaan Usaha Mikro
    </a>
  <a href="/admin/admin_pup"><i class="fas fa-briefcase"></i> Pembinaan</a>
  <a href="/admin/perdagangan"><i class="fas fa-truck"></i> Perdagangan</a>

  <!-- Tombol Logout -->
  <button onclick="window.location.href='/logout'" class="logout-btn">Logout</button>
</div>

<!-- MAIN -->
<div class="main">

<div class="navbar">
  <div class="nav-left">
    <button class="menu-toggle" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
    <h3>Admin Sekretariat</h3>
  </div>
  <!-- Menggunakan format bawaan Laravel agar lebih aman -->
  <span>Halo {{ session('username', 'Admin') }} 👋</span>
</div>

<div class="container">

<h2 style="margin-bottom:20px;">Admin Sekretariat</h2>

@if(session('success'))
<div class="alert">{{ session('success') }}</div>
@endif

<!-- MENU -->
<div class="cards-grid">

  <!-- 🔥 SURAT (Diubah menjadi tag a href) -->
  <a href="/admin/admin_sekre/surat" class="card">
    <h4>Surat</h4>
    <p>SK, SP, dan SOP</p>
  </a>

  <!-- 🔥 PEGAWAI (Diubah menjadi tag a href) -->
  <a href="{{ route('pegawai.rekap') }}" class="card">
    <h4>Data Pegawai</h4>
    <p>Informasi pegawai sekretariat</p>
  </a>

  <!-- 🔥 MAGANG (Diubah menjadi tag a href) -->
  <a href="{{ route('magang.index') }}" class="card">
    <h4>Data Magang</h4>
    <p>Daftar peserta magang</p>
  </a>

</div>

</div>
</div>

<script>
// 🔥 FUNGSI HANYA UNTUK TOGGLE SIDEBAR DI SMARTPHONE
function toggleSidebar() {
  const sidebar = document.getElementById('sidebarMenu');
  const overlay = document.getElementById('overlay');
  
  sidebar.classList.toggle('active');
  overlay.classList.toggle('active');
}
</script>

</body>
</html>