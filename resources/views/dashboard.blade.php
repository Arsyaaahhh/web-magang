<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Dinkopumdag Surabaya</title>

<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <h2>DINKOPUMDAG</h2>
  <div class="sidebar-date" id="tanggalSidebar"></div>

  <div class="menu">

    <a class="active" onclick="setActive(this); showDashboard();">
      <i class="fas fa-chart-line"></i> Dashboard Utama
    </a>        
    
    <!-- ✅ SEKRETARIAT SUDAH DIPINDAH -->
    <a href="/sekretariat" onclick="setActive(this);">
      <i class="fas fa-user-tie"></i> Bidang Sekretariat
    </a>
    
    <a onclick="setActive(this); cardClick('Pemberdayaan Usaha Mikro');">
      <i class="fas fa-store"></i> Pemberdayaan Usaha Mikro
    </a>
    
    <a onclick="setActive(this); cardClick('Distribusi Perdagangan');">
      <i class="fas fa-truck"></i> Distribusi Perdagangan
    </a>
    
    <a onclick="setActive(this); cardClick('Koperasi');">
      <i class="fas fa-building"></i> Bidang Koperasi
    </a>
    
    <a onclick="setActive(this); cardClick('Pembinaan Usaha Perdagangan');">
      <i class="fas fa-briefcase"></i> Pembinaan Usaha Perdagangan
    </a>
    
    <a onclick="setActive(this); cardClick('UPTD Metrologi Legal');">
      <i class="fas fa-balance-scale"></i> UPTD Metrologi Legal
    </a>

  </div>

  <button onclick="logout()" class="logout-btn">
    <i class="fas fa-sign-out-alt"></i> Keluar
  </button>
</div>

<!-- MAIN -->
<div class="main">

  <!-- HEADER -->
  <div class="header">
    <div class="toggle-btn" onclick="toggleSidebar()">☰</div>
    <img src="{{ asset('images/logo.jpg') }}" class="logo">
    <div>
      <b style="font-size:15px;">
        DINAS KOPERASI USAHA KECIL DAN MENENGAH DAN PERDAGANGAN KOTA SURABAYA
      </b><br>
      <span style="font-size:13px; color:#666;">
        Pemerintah Kota Surabaya
      </span>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="container">

    <!-- CARD UTAMA -->
    <div class="cards">

      <!-- ✅ SEKRETARIAT SUDAH DIPINDAH -->
      <a href="/sekretariat" class="card blue">
        <i class="fas fa-user-tie fa-2x"></i>
        <h4>Bidang Sekretariat</h4>
        <h2 class="counter" data-target="32">0</h2>
      </a>

      <div class="card green" onclick="cardClick('Pemberdayaan Usaha Mikro')">
        <i class="fas fa-store fa-2x"></i>
        <h4>Pemberdayaan Usaha Mikro</h4>
        <h2 class="counter" data-target="85">0</h2>
      </div>

      <div class="card orange" onclick="cardClick('Distribusi Perdagangan')">
        <i class="fas fa-truck fa-2x"></i>
        <h4>Distribusi Perdagangan</h4>
        <h2 class="counter" data-target="42">0</h2>
      </div>

      <div class="card purple" onclick="cardClick('Koperasi')">
        <i class="fas fa-building fa-2x"></i>
        <h4>Bidang Koperasi</h4>
        <h2 class="counter" data-target="23">0</h2>
      </div>

      <div class="card red" onclick="cardClick('Pembinaan Usaha Perdagangan')">
        <i class="fas fa-briefcase fa-2x"></i>
        <h4>Pembinaan Usaha Perdagangan</h4>
        <h2 class="counter" data-target="31">0</h2>
      </div>

      <div class="card teal" onclick="cardClick('UPTD Metrologi Legal')">
        <i class="fas fa-balance-scale fa-2x"></i>
        <h4>UPTD Metrologi Legal</h4>
        <h2 class="counter" data-target="68">0</h2>
      </div>

    </div>

    <!-- DETAIL (masih dipakai bidang lain) -->
    <div id="detailArea" style="display:none;">
      <div class="chart-box">
        <h4 id="detailTitle"></h4> 
        <div class="cards" id="detailCards"></div>
      </div>
    </div>

    <div id="previewArea" style="margin-top:20px;"></div>

    <!-- CHART -->
    <div class="chart-grid">
      <div class="chart-box"><canvas id="trendChart"></canvas></div>
      <div class="chart-box"><canvas id="kategoriChart"></canvas></div>
      <div class="chart-box"><canvas id="sertifikatChart"></canvas></div>
      <div class="chart-box"><canvas id="perbandinganChart"></canvas></div>
    </div>

  </div>
</div>

<script src="{{ asset('js/script.js') }}"></script>

<script>
if(localStorage.getItem("login") !== "true"){
  window.location.href = "/";
}

function logout(){
  localStorage.removeItem("login");
  window.location.href = "/";
}
</script>

</body>
</html>