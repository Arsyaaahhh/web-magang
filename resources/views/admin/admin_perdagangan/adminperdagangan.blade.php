<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Perdagangan</title>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
      top: 0; left: 0; width: 100%; height: 100%;
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
      left: 0;
      z-index: 1000;
      transition: left 0.3s ease;
    }

    .sidebar h2 { margin-bottom: 20px; }

    .sidebar a {
      display: block; color: white; padding: 10px; border-radius: 8px; margin-bottom: 8px; text-decoration: none;
    }

    .sidebar a:hover, .sidebar .active {
      background: rgba(255, 255, 255, 0.2);
    }

    .logout-btn {
      margin-top: 20px; width: 100%; padding: 10px; border: none; border-radius: 8px; background: #dc3545; color: white; cursor: pointer;
    }

    /* MAIN */
    .main {
      margin-left: 240px; width: 100%; transition: margin-left 0.3s ease;
    }

    /* NAVBAR */
    .navbar {
      background: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
    }

    .navbar-left {
      display: flex; align-items: center; gap: 15px;
    }

    .toggle-btn {
      display: none; font-size: 1.5rem; color: #0d6efd; cursor: pointer;
    }

    .navbar h3 {
      color: #0d6efd;
    }

    /* CONTENT */
    .container {
      padding: 30px;
    }

    /* HEADER */
    .top {
      display: flex; justify-content: space-between; margin-bottom: 20px;
    }

    /* CARDS GRID */
    .cards-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 20px;
      margin-bottom: 20px;
    }

    /* CARD CUSTOMIZATION */
    .card {
      padding: 25px 20px;
      border-radius: 16px;
      color: white;
      text-decoration: none;
      display: flex;
      flex-direction: column;
      justify-content: center;
      min-height: 140px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }

    .menu-card {
      cursor: pointer;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .menu-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
    }

    /* Warna Background Card */
    .bg-blue { background: linear-gradient(135deg, #0d6efd, #0b5ed7); }
    .bg-teal { background: linear-gradient(135deg, #20c997, #1aa179); }

    /* Elemen di dalam Card */
    .menu-card i { font-size: 36px; margin-bottom: 15px; opacity: 0.9; }
    .menu-card h4 { font-size: 20px; font-weight: 600; margin-bottom: 6px; letter-spacing: 0.5px; }
    .menu-card p { font-size: 14px; opacity: 0.85; font-weight: 400; line-height: 1.4; }

    /* ======================================================= */
    /* RESPONSIVE (HP & TABLET)                                */
    /* ======================================================= */
    @media (max-width: 768px) {
      .sidebar { left: -240px; } 
      .sidebar.active { left: 0; } 
      
      .main { margin-left: 0; width: 100%; } 
      
      .toggle-btn { display: block; } 
      .overlay.active { display: block; } 
      
      .navbar { padding: 15px 20px; }
      .container { padding: 20px; }
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

    <a href="/admin/admin_pup">
      <i class="fas fa-briefcase"></i> Pembinaan Usaha Perdagangan
    </a>

    <a class="active" href="/admin/admin_perdagangan">
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
        <i class="fas fa-bars toggle-btn" onclick="toggleSidebar()"></i>
        <h3>Admin Perdagangan</h3>
      </div>

      <div style="display:flex; gap:10px; align-items:center;">
        <span>Halo {{ session('username') ?? 'Admin' }} 👋</span>
      </div>
    </div>

    <div class="container">

      <div class="top">
        <h2>Data Perdagangan</h2>
      </div>

      <div id="mainMenu" class="cards-grid">

        <a class="card menu-card bg-blue" href="/admin/admin_perdagangan/pasar/adminpasar">
          <i class="fas fa-store-alt"></i>
          <h4>Pasar</h4>
          <p>Informasi Pasar Binaan</p>
        </a>

        <a class="card menu-card bg-teal" href="/admin/admin_perdagangan/tokokelontong/admintokokelontong">
          <i class="fas fa-shopping-basket"></i>
          <h4>Toko Kelontong</h4>
          <p>Informasi Toko Kelontong</p>
        </a>

      </div>

    </div>

  </div>

  <script>
    // FUNGSI TOGGLE SIDEBAR UNTUK HP
    function toggleSidebar() {
      document.querySelector('.sidebar').classList.toggle('active');
      document.querySelector('.overlay').classList.toggle('active');
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