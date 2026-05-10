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
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px;
    }

    /* CARD CUSTOMIZATION */
    .menu-card {
      padding: 25px 20px;
      border-radius: 16px;
      color: white;
      text-decoration: none;
      display: flex;
      flex-direction: column;
      justify-content: center;
      min-height: 150px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.05);
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
    .menu-card h3 { font-size: 20px; font-weight: 600; margin-bottom: 8px; letter-spacing: 0.5px; }
    .menu-card p { font-size: 14px; opacity: 0.85; font-weight: 400; line-height: 1.5; }

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

  <div class="overlay" onclick="toggleSidebar()"></div>

  <div class="sidebar">
    <h2>ADMIN</h2>

    <a href="/admin/admin_sekre">
      <i class="fas fa-user-tie"></i> Sekretariat
    </a>

    <a href="/admin/admin_pum">
      <i class="fas fa-store"></i> Pemberdayaan Usaha Mikro
    </a>

    <a href="/admin/pembinaan">
      <i class="fas fa-briefcase"></i> Pembinaan Usaha Perdagangan
    </a>

    <a href="/admin/perdagangan">
      <i class="fas fa-truck"></i> Distribusi Perdagangan
    </a>

        <a href="/admin/koperasi">
      <i class="fas fa-building"></i> Bidang Koperasi
    </a>

    <a class="active" href="/admin/admin_metro">
      <i class="fas fa-balance-scale"></i> Metrologi Legal
    </a>

    <button onclick="logout()" class="logout-btn">
      <i class="fas fa-sign-out-alt"></i> Logout
    </button>
  </div>

  <main>

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

    <div class="container">

      <div class="menu-grid">

        <a href="/admin/admin_metro/alat" class="menu-card bg-blue">
          <i class="fas fa-weight-hanging"></i>
          <h3>Potensi Alat Ukur</h3>
        </a>

        <a href="/admin/admin_metro/reparasi" class="menu-card bg-teal">
          <i class="fas fa-tools"></i>
          <h3>Tanda Daftar Reparasi</h3>
        </a>

      </div>

    </div>

  </main>

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
        text: "Kamu akan keluar dari sistem admin",
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