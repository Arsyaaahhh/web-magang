<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Perdagangan</title>

<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <style>

    /* OVERLAY */
    .overlay {
      display: none;
      position: fixed;
      top: 0; left: 0; width: 100%; height: 100%;
      background: rgba(0,0,0,0.5);
      z-index: 999;
    }

    /* TABLE */
    table {
      width: 100%;
      border-collapse: collapse;
      border: 1px solid #e5e7eb;
      color: #333;
      font-weight: 400;
    }

    th { padding: 12px; background: #eaf2ff; font-size: 13px; text-align: left; }
    td { padding: 12px; font-size: 15px; border-bottom: 1px solid #e5e7eb; }
    tbody tr:nth-child(even) { background: #f9fafb; }
    tr:hover { background: #eef4ff; }

    .toggle-btn { display: none; }

    /* ======================================================= */
    /* RESPONSIVE KHUSUS SMARTPHONE & TABLET (< 768px)         */
    /* ======================================================= */
    @media (max-width: 768px) {
        .sidebar { left: -100% !important; position: fixed !important; z-index: 1000; transition: 0.3s ease; }
        .sidebar.active { left: 0 !important; }
        .main { margin-left: 0 !important; width: 100% !important; }
        .toggle-btn { display: inline-block !important; margin-right: 15px; font-size: 24px; cursor: pointer; color: #0d6efd; }
        .overlay.active { display: block; }
        .header { display: flex; align-items: center; }
        .cards, #mainMenu { display: grid !important; grid-template-columns: 1fr !important; gap: 15px; }
    }
  </style>

</head>

<body>

<div class="overlay" onclick="toggleSidebar()"></div>

<div class="sidebar" id="sidebar">
    <h2 style="text-align: center;">DINKOPUMDAG</h2>

    <div id="tanggalSidebar" style="margin-bottom:20px; font-size:13px; color:#e0e7ff; text-align: center; font-weight: 400;"></div>
    
    <div class="menu">
        <a href="/dashboard"><i class="fas fa-chart-line"></i> Dashboard Utama</a>
        <a href="/sekretariat"><i class="fas fa-user-tie"></i> Bidang Sekretariat</a>
        <a href="/mikro"><i class="fas fa-store"></i> Pemberdayaan Usaha Mikro</a>
        <a href="/perdagangan" class="active"><i class="fas fa-truck"></i> Distribusi Perdagangan</a>
        <a href="/koperasi"><i class="fas fa-building"></i> Bidang Koperasi</a>
        <a href="/pembinaan"><i class="fas fa-briefcase"></i> Pembinaan Usaha Perdagangan</a>
        <a href="/metrologi"><i class="fas fa-balance-scale"></i> UPTD Metrologi Legal</a>
    </div>
    <button onclick="logout()" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Keluar</button>
</div>

<div class="main">

  <div class="header">
    <div class="toggle-btn" onclick="toggleSidebar()">☰</div>
    <img src="{{ asset('images/logo.jpg') }}" class="logo">
    <div>
      <b>Distribusi Perdagangan</b><br>
      <small>Dinkopumdag Surabaya</small>
    </div>
  </div>

  <div class="container">

    <h2>Distribusi Perdagangan</h2>

    <div class="cards" id="mainMenu">

      <a class="card green" href="/bidang/perdagangan/pasar">
        <h4>Pasar</h4>
        <p>Informasi Pasar</p>
      </a>

      <a class="card blue" href="/bidang/perdagangan/tokokelontong">
        <h4>Toko Kelontong</h4>
        <p>Informasi Toko Kelontong</p>
      </a>

    </div>

  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const elTanggal = document.getElementById('tanggalSidebar');
        if (elTanggal) {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            elTanggal.textContent = now.toLocaleDateString('id-ID', options);
        }
    });

    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('active');
        document.querySelector('.overlay').classList.toggle('active');
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

    if (localStorage.getItem("login") !== "true") { window.location.href = "/"; }
</script>

</body>
</html>