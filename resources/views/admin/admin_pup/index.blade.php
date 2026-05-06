<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Pembinaan</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{display:flex;background:#f8fafc; overflow-x: hidden;}

/* OVERLAY (Background gelap saat sidebar terbuka di HP) */
.overlay {
  display: none;
  position: fixed;
  top: 0; left: 0; width: 100%; height: 100%;
  background: rgba(0,0,0,0.5);
  z-index: 999;
}

/* SIDEBAR */
.sidebar{
  width:240px;height:100vh;background:#0d6efd;color:white;padding:20px;
  position:fixed; top:0; left:0; z-index: 1000;
  transition: transform 0.3s ease;
}
.sidebar h2{margin-bottom:20px;}
.sidebar a{
  display:block;color:white;padding:10px;border-radius:8px;margin-bottom:8px;text-decoration:none;
}
.sidebar a:hover,.sidebar .active{background:rgba(255,255,255,0.2);}
.sidebar a i {margin-right: 8px;}
.logout-btn{
  margin-top:20px;width:100%;padding:10px;border:none;border-radius:8px;background:#dc3545;color:white;
  cursor:pointer; font-weight: 500;
}

/* MAIN */
.main{margin-left:240px;width:100%; min-height: 100vh; transition: margin-left 0.3s ease;}

/* NAVBAR */
.navbar{
  background:white;padding:15px 30px;display:flex;justify-content:space-between; align-items: center;
  box-shadow:0 2px 10px rgba(0,0,0,0.04);
  position: sticky; top: 0; z-index: 100;
}
.navbar-left {
  display: flex; align-items: center; gap: 15px;
}
.toggle-btn {
  display: none; font-size: 1.5rem; color: #0d6efd; cursor: pointer;
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
.menu-card i {
  color: #0d6efd; margin-right: 5px;
}

.alert{
  padding:10px;margin-bottom:10px;background:#d1e7dd;border-radius:6px;
}

/* ======================================================= */
/* RESPONSIVE (HP & TABLET)                                */
/* ======================================================= */
@media (max-width: 768px) {
  .sidebar { transform: translateX(-100%); } /* Sembunyikan sidebar ke kiri */
  .sidebar.active { transform: translateX(0); } /* Munculkan sidebar saat di-toggle */
  
  .main { margin-left: 0; width: 100%; }
  
  .toggle-btn { display: block; } /* Munculkan tombol garis 3 */
  
  .navbar { padding: 15px 20px; }
  .navbar span { font-size: 14px; }
  
  .container { padding: 20px; }
  
  /* Kartu akan tersusun ke bawah di HP */
  .cards-grid { flex-direction: column; overflow-x: hidden; }
  .menu-card { min-width: 100%; flex: auto; }
  
  .overlay.active { display: block; }
}
</style>
</head>

<body>

<!-- OVERLAY (Muncul di HP saat sidebar terbuka) -->
<div class="overlay" onclick="toggleSidebar()"></div>

<!-- SIDEBAR -->
<div class="sidebar">
  <h2>ADMIN</h2>

  <a href="/admin/admin_sekre"><i class="fas fa-user-tie"></i> Sekretariat</a>
  <a href="/admin/admin_pum"><i class="fas fa-store"></i> Pemberdayaan Usaha Mikro</a>
  <a href="/admin/admin_pup" class="active"><i class="fas fa-briefcase"></i> Pembinaan</a>
  <a href="/admin/admin_perdagangan"><i class="fas fa-truck"></i> Perdagangan</a>
  
  <button onclick="logout()" class="logout-btn">
    <i class="fas fa-sign-out-alt"></i> Logout
  </button>
</div>

<!-- MAIN -->
<div class="main">

<div class="navbar">
  <div class="navbar-left">
    <!-- Tombol Hamburger Menu -->
    <i class="fas fa-bars toggle-btn" onclick="toggleSidebar()"></i>
    <h3>Admin Pembinaan</h3>
  </div>
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
  <div class="card menu-card" data-url="{{ route('tdg.index') }}" onclick="go(this.getAttribute('data-url'))">
    <h4><i class="fas fa-warehouse"></i> TDG</h4>
    <p style="margin-top: 5px; color: #6b7280; font-size: 14px;">Tanda Daftar Gudang</p>
  </div>

  <!-- PERIZINAN -->
   <div class="card menu-card" data-url="{{ route('pengawasan.index') }}" onclick="go(this.getAttribute('data-url'))">
    <h4><i class="fas fa-file-signature"></i> Data Pengawasan</h4>
    <p style="margin-top: 5px; color: #6b7280; font-size: 14px;">Data Pengawasan (Toko Swalayan, Gudang Minuman Beralkohol)</p>
  </div>

  <!-- ALKOHOL -->
  <div class="card menu-card" data-url="{{ route('alkohol.index') }}" onclick="go(this.getAttribute('data-url'))">
    <h4><i class="fas fa-wine-bottle"></i> Data Penjual Alkohol</h4>
    <p style="margin-top: 5px; color: #6b7280; font-size: 14px;">Rincian Data Penjual Langsung Minuman Beralkohol Golongan B dan C</p>
  </div>

</div>

</div>
</div>

<script>
// Toggle Sidebar untuk HP
function toggleSidebar() {
  document.querySelector('.sidebar').classList.toggle('active');
  document.querySelector('.overlay').classList.toggle('active');
}

// Fungsi Go yang dimodifikasi sedikit agar lebih aman
function go(url){
  if(url) {
    window.location.href = url;
  }
}

function logout(){
  window.location.href="/logout";
}
</script>

</body>
</html>