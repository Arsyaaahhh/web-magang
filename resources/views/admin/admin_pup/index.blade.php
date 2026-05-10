<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Pembinaan</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      display: flex;
      background: #f8fafc;
      overflow-x: hidden;
    }

    /* OVERLAY */
    .overlay {
      display: none;
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.5);
      z-index: 999;
    }

    /* SIDEBAR */
    .sidebar {
      width: 240px;
      height: 100vh;
      background: #0d6efd;
      color: white;
      padding: 20px;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 1000;
      transition: transform 0.3s ease;
      overflow-y: auto;
    }

    .sidebar h2 { margin-bottom: 20px; }

    .sidebar a {
      display: block;
      color: white;
      padding: 10px;
      border-radius: 8px;
      margin-bottom: 8px;
      text-decoration: none;
    }

    .sidebar a:hover, .sidebar .active {
      background: rgba(255, 255, 255, 0.2);
    }

    .logout-btn {
      margin-top: 20px;
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 8px;
      background: #dc3545;
      color: white;
      cursor: pointer;
    }

    /* MAIN */
    .main {
      margin-left: 240px;
      width: 100%;
      min-height: 100vh;
      transition: margin-left 0.3s ease;
    }

    /* NAVBAR */
    .navbar {
      background: white;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 10px rgba(0,0,0,0.04);
      position: sticky; 
      top: 0; 
      z-index: 100;
    }

    .navbar-left {
      display: flex; align-items: center; gap: 15px;
    }

    .toggle-btn {
      display: none; font-size: 1.5rem; color: #0d6efd; cursor: pointer; border: none; background: transparent;
    }

    .navbar h3 {
      color: #0d6efd;
    }

    /* CONTENT */
    .container {
      padding: 30px;
    }

    /* MENU CARDS (CUSTOMIZED) */
    .cards-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 20px;
      margin-bottom: 20px;
    }

    .card {
      background: white;
      padding: 20px;
      border-radius: 14px;
      border: 1px solid #e5e7eb;
      color: #333;
      text-decoration: none;
    }

    .menu-card {
      cursor: pointer;
      transition: transform 0.2s, box-shadow 0.2s;
      display: flex;
      flex-direction: column;
      justify-content: center;
      min-height: 130px;
    }

    .menu-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
    }

    /* Warna & Font Khusus Card Menu */
    .bg-blue { background: linear-gradient(135deg, #0d6efd, #0b5ed7); color: white; border: none; }
    .bg-green { background: linear-gradient(135deg, #198754, #146c43); color: white; border: none; }
    .bg-purple { background: linear-gradient(135deg, #6f42c1, #59359a); color: white; border: none; }
    
    .menu-card i { font-size: 32px; margin-bottom: 12px; opacity: 0.9; }
    .menu-card h4 { font-size: 20px; font-weight: 600; margin-bottom: 5px; }

    .alert {
      padding: 10px; margin-bottom: 20px; background: #d1e7dd; border-radius: 6px; color: #0f5132;
    }

    /* ======================================================= */
    /* RESPONSIVE (HP & TABLET)                                */
    /* ======================================================= */
    @media (max-width: 768px) {
      .sidebar { transform: translateX(-100%); } 
      .sidebar.active { transform: translateX(0); } 
      
      .main { margin-left: 0; width: 100%; }
      
      .toggle-btn { display: block; } 
      
      .navbar { padding: 15px 20px; }
      .navbar span { font-size: 14px; }
      
      .container { padding: 20px; }
      .overlay.active { display: block; }
    }
  </style>
</head>

<body>

  <div class="overlay" onclick="toggleSidebar()"></div>

  <div class="sidebar">
    <h2>ADMIN</h2>

    <a href="/admin/admin_sekre">
      <i class="fas fa-user-tie"></i> Sekretariat
    </a>

    <a href="/admin/admin_pum">
      <i class="fas fa-store"></i> Pemberdayaan Usaha Mikro
    </a>

    <a class="active" href="/admin/admin_pup">
      <i class="fas fa-briefcase"></i> Pembinaan Usaha Perdagangan
    </a>

    <a href="/admin/admin_perdagangan">
      <i class="fas fa-truck"></i> Distribusi Perdagangan
    </a>

    <a href="/admin/koperasi">
      <i class="fas fa-building"></i> Bidang Koperasi
    </a>

    <a href="/admin/admin_metro">
      <i class="fas fa-balance-scale"></i> Metrologi Legal
    </a>

    <button onclick="logout()" class="logout-btn">
      <i class="fas fa-sign-out-alt"></i> Logout
    </button>
  </div>

  <div class="main">

    <div class="navbar">
      <div class="navbar-left">
        <button class="toggle-btn" onclick="toggleSidebar()">
          <i class="fas fa-bars"></i>
        </button>
        <h3>Admin Pembinaan</h3>
      </div>
      <span>Halo {{ session('username') ?? 'Admin' }} 👋</span>
    </div>

    <div class="container">

      <h2 style="margin-bottom:20px;">Dashboard Pembinaan</h2>

      @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
      @endif

      <div class="cards-grid">

        <div class="card menu-card bg-blue" data-url="{{ route('tdg.index') }}" onclick="go(this.getAttribute('data-url'))">
          <i class="fas fa-warehouse"></i>
          <h4>Data TDG</h4>
        </div>

        <div class="card menu-card bg-green" data-url="{{ route('pengawasan.index') }}" onclick="go(this.getAttribute('data-url'))">
          <i class="fas fa-file-signature"></i>
          <h4>Data Pengawasan Toko</h4>
        </div>

        <div class="card menu-card bg-purple" data-url="{{ route('alkohol.index') }}" onclick="go(this.getAttribute('data-url'))">
          <i class="fas fa-wine-bottle"></i>
          <h4>Data Penjual Alkohol</h4>
        </div>

      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    // Toggle Sidebar untuk HP
    function toggleSidebar() {
      document.querySelector('.sidebar').classList.toggle('active');
      document.querySelector('.overlay').classList.toggle('active');
    }

    // Fungsi Go untuk memindahkan halaman saat card diklik
    function go(url){
      if(url) {
        window.location.href = url;
      }
    }

    // LOGOUT
    function logout(){
      Swal.fire({
        title:'Logout?',
        text:'Kamu akan keluar dari sistem admin.',
        icon:'warning',
        showCancelButton:true,
        confirmButtonColor:'#0d6efd',
        confirmButtonText:'Ya, logout'
      }).then((result)=>{
        if(result.isConfirmed){
          localStorage.removeItem("login");
          window.location.href = "/logout";
        }
      });
    }

    // LOGIN CHECK
    if (localStorage.getItem("login") !== "true") {
      window.location.href = "/";
    }
  </script>

</body>
</html>