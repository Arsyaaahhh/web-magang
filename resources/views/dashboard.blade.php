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

    <a class="active">
      <i class="fas fa-chart-line"></i> Dashboard Utama
    </a>        
    
    <a href="/sekretariat"><i class="fas fa-user-tie"></i> Bidang Sekretariat</a>
    <a href="/mikro"><i class="fas fa-store"></i> Pemberdayaan Usaha Mikro</a>
    <a href="/distribusi"><i class="fas fa-truck"></i> Distribusi Perdagangan</a>
    <a href="/koperasi"><i class="fas fa-building"></i> Bidang Koperasi</a>
    <a href="/pembinaan"><i class="fas fa-briefcase"></i> Pembinaan Usaha Perdagangan</a>
    <a href="/metrologi"><i class="fas fa-balance-scale"></i> UPTD Metrologi Legal</a>

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

    <!-- CARD -->
    <div class="cards">

      <a href="/sekretariat" class="card blue">
        <i class="fas fa-user-tie fa-2x"></i>
        <h4>Bidang Sekretariat</h4>
        <h2 class="counter" data-target="32">0</h2>
      </a>

      <a href="/mikro" class="card green">
        <i class="fas fa-store fa-2x"></i>
        <h4>Pemberdayaan Usaha Mikro</h4>
        <h2 class="counter" data-target="85">0</h2>
      </a>

      <a href="/distribusi" class="card orange">
        <i class="fas fa-truck fa-2x"></i>
        <h4>Distribusi Perdagangan</h4>
        <h2 class="counter" data-target="42">0</h2>
      </a>

      <a href="/koperasi" class="card purple">
        <i class="fas fa-building fa-2x"></i>
        <h4>Bidang Koperasi</h4>
        <h2 class="counter" data-target="23">0</h2>
      </a>

      <a href="/pembinaan" class="card red">
        <i class="fas fa-briefcase fa-2x"></i>
        <h4>Pembinaan Usaha Perdagangan</h4>
        <h2 class="counter" data-target="31">0</h2>
      </a>

      <a href="/metrologi" class="card teal">
        <i class="fas fa-balance-scale fa-2x"></i>
        <h4>UPTD Metrologi Legal</h4>
        <h2 class="counter" data-target="68">0</h2>
      </a>

    </div>

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

// WARNA SESUAI CARD
const colors = {
  sekretariat: '#0d6efd',
  umkm: '#20c997',
  distribusi: '#fd7e14',
  koperasi: '#6f42c1',
  pembinaan: '#dc3545',
  metrologi: '#17a2b8'
};

// ================= TREND =================
new Chart(document.getElementById("trendChart"), {
  type: 'line',
  data: {
    labels: ['2021','2022','2023','2024','2025'],
    datasets: [{
      label: 'Trend Kinerja',
      data: [7000,7800,8200,9000,9800],
      borderColor: colors.sekretariat,
      backgroundColor: colors.sekretariat + '33',
      borderWidth: 3,
      fill: true,
      tension: 0.4
    }]
  }
});

// ================= BAR =================
new Chart(document.getElementById("kategoriChart"), {
  type: 'bar',
  data: {
    labels: ['Sekretariat','UMKM','Distribusi','Koperasi','Pembinaan','Metrologi'],
    datasets: [{
      label: 'Jumlah Data',
      data: [32,85,42,23,31,68],
      backgroundColor: [
        colors.sekretariat,
        colors.umkm,
        colors.distribusi,
        colors.koperasi,
        colors.pembinaan,
        colors.metrologi
      ]
    }]
  }
});

// ================= DONUT =================
new Chart(document.getElementById("sertifikatChart"), {
  type: 'doughnut',
  data: {
    labels: ['Sekretariat','UMKM','Distribusi','Koperasi','Pembinaan','Metrologi'],
    datasets: [{
      data: [32,85,42,23,31,68],
      backgroundColor: [
        colors.sekretariat,
        colors.umkm,
        colors.distribusi,
        colors.koperasi,
        colors.pembinaan,
        colors.metrologi
      ]
    }]
  }
});

// ================= PERBANDINGAN =================
new Chart(document.getElementById("perbandinganChart"), {
  type: 'bar',
  data: {
    labels: ['Sekretariat','UMKM','Distribusi','Koperasi','Pembinaan','Metrologi'],
    datasets: [{
      label: 'Perbandingan Bidang',
      data: [32,85,42,23,31,68],
      backgroundColor: colors.sekretariat
    }]
  }
});

// LOGIN CHECK
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