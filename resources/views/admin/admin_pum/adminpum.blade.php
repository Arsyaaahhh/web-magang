<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Pemberdayaan Usaha Mikro</title>

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

    .sidebar h2 {
      margin-bottom: 20px;
    }

    .sidebar a {
      display: block;
      color: white;
      padding: 10px;
      border-radius: 8px;
      margin-bottom: 8px;
      text-decoration: none;
    }

    .sidebar a:hover,
    .sidebar .active {
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
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .navbar-left {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .navbar h3 {
      color: #0d6efd;
    }

    .hamburger {
      display: none;
      font-size: 1.5rem;
      color: #0d6efd;
      cursor: pointer;
      border: none;
      background: transparent;
    }

    /* CONTENT */
    .container {
      padding: 30px;
    }

    /* HEADER */
    .top {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
    }

    /* BUTTON */
    .btn {
      padding: 8px 14px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
    }

    .btn-add {
      background: #20c997;
      color: white;
    }

    .btn-add:hover {
      background: #1aa179;
      transition: 0.2s ease;
    }

    .btn-edit {
      background: #ffc107;
      color: black;
    }

    .btn-delete {
      background: #dc3545;
      color: white;
    }

    /* CARDS */
    .cards {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
      color: #0d6efd;
      text-decoration: none;
    }

    /* CARD */
    .cards-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 16px;
      margin-bottom: 20px;
    }

    .card {
      background: white;
      padding: 20px;
      border-radius: 12px;
      border: 1px solid #e5e7eb;
      color: #333;
      text-decoration: none;
    }

    .menu-card {
      cursor: pointer;
      transition: transform .2s, box-shadow .2s;
    }

    .menu-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 30px rgba(13, 110, 253, 0.12);
    }

    .overlay {
      display: none;
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.5);
      z-index: 999;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
      .sidebar {
        transform: translateX(-100%);
      }

      .sidebar.open {
        transform: translateX(0);
      }

      .main {
        margin-left: 0;
      }

      .hamburger {
        display: block;
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

  <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

  <!-- SIDEBAR -->
  <div class="sidebar" id="sidebar">
    <h2>ADMIN</h2>

    <a href="/admin/admin_sekre">
      <i class="fas fa-user-tie"></i> Sekretariat
    </a>

    <a class="active" href="#">
      <i class="fas fa-store"></i> Pemberdayaan Usaha Mikro
    </a>

    <a href="#">
      <i class="fas fa-briefcase"></i> Pembinaan
    </a>

    <a href="#">
      <i class="fas fa-truck"></i> Perdagangan
    </a>

    <button onclick="logout()" class="logout-btn">
      Logout
    </button>
  </div>

  <!-- MAIN -->
  <div class="main">

    <!-- NAVBAR -->
    <div class="navbar">
      <div class="navbar-left">
        <button class="hamburger" onclick="toggleSidebar()">
          <i class="fas fa-bars"></i>
        </button>
        <h3>Admin Pemberdayaan Usaha Mikro</h3>
      </div>

      <div style="display:flex; gap:10px; align-items:center;">
        <span>Halo {{ session('username') ?? 'Admin' }} 👋</span>
      </div>
    </div>

    <!-- CONTENT -->
    <div class="container">

      <div class="top">
        <h2>Data PUM</h2>
      </div>

      <div id="mainMenu" class="cards-grid">

        <!-- Tombol untuk menuju halaman UMKM -->
        <a class="card menu-card" href="{{ route('adminumkm') }}">
          <h4>UMKM</h4>
          <p>Informasi UMKM</p>
        </a>

        <!-- Tombol untuk menuju halaman SWK -->
        <a class="card menu-card" href="{{ route('adminswk') }}">
          <h4>SWK</h4>
          <p>Informasi SWK</p>
        </a>

      </div>

    </div>

  </div>

  <script src="{{ asset('js/script.js') }}"></script>

  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('overlay');
      
      sidebar.classList.toggle('open');
      
      if(sidebar.classList.contains('open')){
        overlay.style.display = 'block';
      } else {
        overlay.style.display = 'none';
      }
    }

    // LOGOUT
    function logout() {
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
      });
    }

    // LOGIN CHECK
    if (localStorage.getItem("login") !== "true") {
      window.location.href = "/";
    }
  </script>

</body>

</html>