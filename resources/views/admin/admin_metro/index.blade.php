<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Metrologi Legal</title>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: #f8fafc;
      font-weight: 400;
      color: #333;
      overflow-x: hidden;
      display: flex;
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
      top: 0;
      z-index: 1000;
      transition: left 0.3s ease;
      overflow-y: auto;
    }

    .sidebar h2 {
      margin-bottom: 25px;
      font-size: 20px;
    }

    .sidebar a {
      display: block;
      color: white;
      padding: 10px 14px;
      border-radius: 8px;
      margin-bottom: 8px;
      font-weight: 500;
      cursor: pointer;
      text-decoration: none;
      font-size: 15px;
      transition: 0.2s;
    }

    .sidebar a i {
      margin-right: 10px;
      width: 18px;
      text-align: center;
    }

    .sidebar a:hover,
    .sidebar .active {
      background: rgba(255, 255, 255, 0.2);
    }

    .logout-btn {
      margin-top: 25px;
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 8px;
      background: #dc3545;
      color: white;
      cursor: pointer;
      font-size: 15px;
      text-align: left;
      font-weight: 500;
      transition: 0.2s;
    }

    .logout-btn i {
      margin-right: 10px;
      width: 18px;
      text-align: center;
    }

    .logout-btn:hover {
      background: #bb2d3b;
    }

    /* MAIN CONTENT */
    main {
      flex: 1;
      display: flex;
      flex-direction: column;
      margin-left: 240px;
      transition: margin-left 0.3s ease, width 0.3s ease;
      min-height: 100vh;
    }

    /* NAVBAR */
    .navbar {
      background: white;
      padding: 18px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 10px rgba(0,0,0,0.04);
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .navbar-left {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .toggle-btn {
      display: none;
      font-size: 1.5rem;
      color: #0d6efd;
      cursor: pointer;
      background: none;
      border: none;
    }

    .navbar h3 {
      color: #0d6efd;
      font-size: 20px;
    }

    /* CONTAINER */
    .container {
      padding: 30px;
    }

    .top-header {
      margin-bottom: 25px;
    }

    .top-header h2 {
      font-size: 22px;
      color: #374151;
      margin-bottom: 5px;
    }

    .top-header p {
      color: #6b7280;
      font-size: 14px;
    }

    /* MENU CARDS (PILIHAN) */
    .menu-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 20px;
    }

    .menu-card {
      background: white;
      border-radius: 14px;
      padding: 25px;
      border: 1px solid #e5e7eb;
      text-decoration: none;
      color: #333;
      display: flex;
      align-items: flex-start;
      gap: 18px;
      transition: 0.3s ease;
      cursor: pointer;
    }

    .menu-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(13, 110, 253, 0.1);
      border-color: #0d6efd;
    }

    .icon-box {
      background: #eaf2ff;
      color: #0d6efd;
      width: 55px;
      height: 55px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      flex-shrink: 0;
      transition: 0.3s;
    }

    .menu-card:hover .icon-box {
      background: #0d6efd;
      color: white;
    }

    .card-info h3 {
      font-size: 17px;
      font-weight: 600;
      margin-bottom: 6px;
      color: #1f2937;
    }

    .card-info p {
      font-size: 13px;
      color: #6b7280;
      line-height: 1.5;
    }

    /* ======================================================= */
    /* RESPONSIVE KHUSUS SMARTPHONE & TABLET (< 768px)         */
    /* ======================================================= */
    @media (max-width: 768px) {
      .sidebar { left: -240px; }
      .sidebar.active { left: 0; }
      main { margin-left: 0; width: 100%; }
      .toggle-btn { display: block; }
      .overlay.active { display: block; }
      .navbar { padding: 15px 20px; }
      .container { padding: 20px; }
      .menu-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

  <!-- OVERLAY (Muncul di HP saat sidebar terbuka) -->
  <div class="overlay" onclick="toggleSidebar()"></div>

  <!-- SIDEBAR -->
  <div class="sidebar">
    <h2>ADMIN</h2>

    <a href="/admin/admin_sekre">
      <i class="fas fa-user-tie"></i> Sekretariat
    </a>

    <a href="/admin/admin_pum">
      <i class="fas fa-store"></i> Pemberdayaan Usaha Mikro
    </a>

    <a href="/admin/pembinaan">
      <i class="fas fa-briefcase"></i> Pembinaan
    </a>

    <a href="/admin/perdagangan">
      <i class="fas fa-truck"></i> Perdagangan
    </a>

    <!-- Menu Metrologi Aktif -->
    <a class="active" href="/admin/admin_metro">
      <i class="fas fa-balance-scale"></i> Metrologi Legal
    </a>

    <button onclick="logout()" class="logout-btn">
      <i class="fas fa-sign-out-alt"></i> Logout
    </button>
  </div>

  <!-- MAIN -->
  <main>

    <!-- NAVBAR -->
    <div class="navbar">
      <div class="navbar-left">
        <button class="toggle-btn" onclick="toggleSidebar()">
          <i class="fas fa-bars"></i>
        </button>
        <h3>Dashboard Metrologi</h3>
      </div>
      <div style="display:flex; gap:10px; align-items:center;">
        <span style="font-size: 14px; color: #555;">Halo {{ session('username') ?? 'Admin' }} 👋</span>
      </div>
    </div>

    <!-- CONTENT -->
    <div class="container">


      <!-- GRID KARTU PILIHAN -->
      <div class="menu-grid">

        <!-- KARTU 1: ALAT UKUR (Nomor 8) -->
        <a href="/admin/admin_metro/alat" class="menu-card">
          <div class="icon-box">
            <i class="fas fa-weight-hanging"></i>
          </div>
          <div class="card-info">
            <h3>Potensi Alat Ukur</h3>
            <p>Kelola rincian jumlah potensi Alat Ukur, Takar, Timbang, dan Perlengkapannya (UTTP) yang wajib tera/tera ulang.</p>
          </div>
        </a>

        <!-- KARTU 2: REPARASI (Nomor 9) -->
        <a href="/admin/admin_metro/reparasi" class="menu-card">
          <div class="icon-box">
            <i class="fas fa-tools"></i>
          </div>
          <div class="card-info">
            <h3>Tanda Daftar Reparasi</h3>
            <p>Kelola data dan status surat Rekomendasi Tanda Daftar Reparasi untuk teknisi/bengkel alat ukur.</p>
          </div>
        </a>

      </div>

    </div>

  </main>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    // TOGGLE SIDEBAR UNTUK HP
    function toggleSidebar() {
      document.querySelector('.sidebar').classList.toggle('active');
      document.querySelector('.overlay').classList.toggle('active');
    }

    // LOGOUT
    function logout() {
      Swal.fire({
        title: 'Logout?',
        text: "Kamu akan keluar dari sistem",
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

    // LOGIN CHECK
    if (localStorage.getItem("login") !== "true") {
      window.location.href = "/";
    }
  </script>

</body>
</html>