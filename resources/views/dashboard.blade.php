<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Dinkopumdag Surabaya</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    body { overflow-x: hidden; }
    .toggle-btn { display: none; }
    .chart-grid { width: 100%; box-sizing: border-box; }
    .chart-box { position: relative; height: 300px; width: 100%; box-sizing: border-box; }
    .chart-box canvas { max-width: 100% !important; }

    @media screen and (max-width: 768px) {
      .toggle-btn { display: block; font-size: 24px; cursor: pointer; margin-right: 15px; }
      .sidebar { position: fixed; left: -250px; top: 0; height: 100vh; z-index: 1000; transition: left 0.3s ease; }
      .sidebar.active { left: 0; }
      .main { margin-left: 0 !important; width: 100%; }
      .cards { display: grid !important; grid-template-columns: 1fr !important; gap: 15px; }
      .chart-grid { display: grid !important; grid-template-columns: 1fr !important; gap: 20px; }
      .chart-box { height: 250px; }
    }
  </style>
</head>
<body>
  <div class="sidebar" id="sidebarMenu">
    <h2>DINKOPUMDAG</h2>
    <div class="sidebar-date" id="tanggalSidebar"></div>

    <div class="menu">
      <a class="active"><i class="fas fa-chart-line"></i> Dashboard Utama</a>
      <a href="/sekretariat"><i class="fas fa-user-tie"></i> Bidang Sekretariat</a>
      <a href="/mikro"><i class="fas fa-store"></i> Pemberdayaan Usaha Mikro</a>
      <a href="/perdagangan"><i class="fas fa-truck"></i> Distribusi Perdagangan</a>
      <a href="/koperasi"><i class="fas fa-building"></i> Bidang Koperasi</a>
      <a href="/pembinaan"><i class="fas fa-briefcase"></i> Pembinaan Usaha Perdagangan</a>
      <a href="/metrologi"><i class="fas fa-balance-scale"></i> UPTD Metrologi Legal</a>
    </div>

    <button onclick="logout()" class="logout-btn">
      <i class="fas fa-sign-out-alt"></i> Keluar
    </button>
  </div>

  <div class="main">
    <div class="header">
      <div class="toggle-btn" onclick="toggleSidebar()">â˜°</div>
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

    <div class="container">
      <div class="cards">
        <a href="/sekretariat" class="card blue">
          <i class="fas fa-user-tie fa-3x"></i>
          <div class="text"><h4>Bidang Sekretariat</h4></div>
        </a>
        <a href="/mikro" class="card green">
          <i class="fas fa-store fa-3x"></i>
          <div class="text"><h4>Pemberdayaan Usaha Mikro</h4></div>
        </a>
        <a href="/perdagangan" class="card orange">
          <i class="fas fa-truck fa-3x"></i>
          <div class="text"><h4>Distribusi Perdagangan</h4></div>
        </a>
        <a href="/koperasi" class="card purple">
          <i class="fas fa-building fa-3x"></i>
          <div class="text"><h4>Bidang Koperasi</h4></div>
        </a>
        <a href="/pembinaan" class="card red">
          <i class="fas fa-briefcase fa-3x"></i>
          <div class="text"><h4>Pembinaan Usaha Perdagangan</h4></div>
        </a>
        <a href="/metrologi" class="card teal">
          <i class="fas fa-balance-scale fa-3x"></i>
          <div class="text"><h4>UPTD Metrologi Legal</h4></div>
        </a>
      </div>

      <div class="chart-grid">
        <div class="chart-box"><canvas id="trendChart"></canvas></div>
        <div class="chart-box"><canvas id="kategoriChart"></canvas></div>
        <div class="chart-box"><canvas id="uttpChart"></canvas></div>
        <!-- ðŸ”¥ Ubah ID canvas menjadi koperasiChart -->
        <div class="chart-box"><canvas id="koperasiChart"></canvas></div>
      </div>
    </div>
  </div>

  <script>
    // FUNGSI RESPONSIVE SIDEBAR
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebarMenu');
      sidebar.classList.toggle('active');
    }

    document.addEventListener('click', function(event) {
      const sidebar = document.getElementById('sidebarMenu');
      const toggleBtn = document.querySelector('.toggle-btn');
      if (window.innerWidth <= 768) {
        if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
          sidebar.classList.remove('active');
        }
      }
    });

    // ==========================================
    // MENANGKAP DATA PHP KE JAVASCRIPT
    // ==========================================
    const chartData = JSON.parse('{!! json_encode($chartData ?? []) !!}');
    const rawTrendData = JSON.parse('{!! json_encode($trendLppd ?? []) !!}');
    const rawUttpData = JSON.parse('{!! json_encode($trendUttp ?? []) !!}'); 
    const rawKoperasiData = JSON.parse('{!! json_encode($koperasiAktif ?? []) !!}'); // ðŸ”¥ Tangkap Data Koperasi

    // Mapping Data Trend LPPD
    let trendLabels = rawTrendData.map(item => item.tahun);
    let trendValues = rawTrendData.map(item => item.jumlah);
    if(trendLabels.length === 0) { trendLabels = ['Belum ada data']; trendValues = [0]; }

    // Mapping Data Alat UTTP
    let uttpLabels = rawUttpData.map(item => item.tahun);
    let uttpValues = rawUttpData.map(item => item.total);
    if(uttpLabels.length === 0) {
        uttpLabels = ['Belum ada data'];
        uttpValues = [0];
    }

    // ðŸ”¥ Mapping Data Koperasi Aktif
    let koperasiLabels = rawKoperasiData.map(item => item.tahun);
    let koperasiValues = rawKoperasiData.map(item => item.total);
    if(koperasiLabels.length === 0) {
        koperasiLabels = ['Belum ada data'];
        koperasiValues = [0];
    }

    const colors = {
      sekretariat: '#0d6efd',
      umkm: '#20c997',
      distribusi: '#fd7e14',
      koperasi: '#6f42c1',
      pembinaan: '#dc3545',
      metrologi: '#17a2b8'
    };

    // OPSI GRAFIK UTAMA
    const chartOptions = {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } }
      },
      scales: {
        y: {
          beginAtZero: true,
          suggestedMax: 10,
          ticks: {
            precision: 0,
            stepSize: 1
          }
        }
      }
    };

    // ================= TREND CHART =================
    new Chart(document.getElementById('trendChart'), {
      type: 'line',
      data: {
        labels: trendLabels, 
        datasets: [{
          label: 'Jumlah UMKM per Tahun (LPPD)',
          data: trendValues, 
          borderColor: colors.sekretariat,
          backgroundColor: colors.sekretariat + '33',
          fill: true,
          tension: 0.4
        }]
      },
      options: chartOptions
    });

    // ================= BAR CHART KESELURUHAN =================
    new Chart(document.getElementById('kategoriChart'), {
      type: 'bar',
      data: {
        labels: ['Sekretariat', 'UMKM', 'Distribusi', 'Koperasi', 'Pembinaan', 'Metrologi'],
        datasets: [{
          label: 'Jumlah Data Keseluruhan',
          data: chartData,
          backgroundColor: [
            colors.sekretariat, colors.umkm, colors.distribusi,
            colors.koperasi, colors.pembinaan, colors.metrologi
          ]
        }]
      },
      options: chartOptions
    });

    // ================= LINE CHART UTTP =================
    new Chart(document.getElementById('uttpChart'), {
      type: 'line',
      data: {
        labels: uttpLabels, 
        datasets: [{
          label: 'Jumlah Alat UTTP per Tahun',
          data: uttpValues, 
          borderColor: colors.metrologi,
          backgroundColor: colors.metrologi + '33',
          fill: true,
          tension: 0.4
        }]
      },
      options: chartOptions
    });

    // ================= BAR CHART KOPERASI AKTIF ðŸ”¥ =================
    new Chart(document.getElementById('koperasiChart'), {
      type: 'bar',
      data: {
        labels: koperasiLabels, 
        datasets: [{
          label: 'Jumlah Koperasi Aktif per Tahun',
          data: koperasiValues, 
          backgroundColor: colors.koperasi,
          maxBarThickness: 50 // ðŸ”¥ TAMBAHKAN KODE INI AGAR BATANGNYA TIDAK MELEBAR/TIDUR
        }]
      },
      options: chartOptions
    });

    // SIDEBAR DATE
    const tanggalSidebar = document.getElementById('tanggalSidebar');
    if (tanggalSidebar) {
      const hariNama = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
      const bulanNama = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
      const sekarang = new Date();
      tanggalSidebar.textContent = `${hariNama[sekarang.getDay()]}, ${sekarang.getDate()} ${bulanNama[sekarang.getMonth()]} ${sekarang.getFullYear()}`;
    }

    // LOGIN CHECK
    if (localStorage.getItem('login') !== 'true') {
      window.location.href = '/';
    }

    function logout() {
      localStorage.removeItem('login');
      window.location.href = '/logout';
    }
  </script>
</body>
</html>