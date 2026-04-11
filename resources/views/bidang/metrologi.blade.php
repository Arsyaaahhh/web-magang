<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>UPTD Metrologi Legal</title>

<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <h2>DINKOPUMDAG</h2>
  <div class="sidebar-date" id="tanggalSidebar"></div>

  <div class="menu">

    <a href="/dashboard">
      <i class="fas fa-chart-line"></i> Dashboard Utama
    </a>

    <a href="/sekretariat">
      <i class="fas fa-user-tie"></i> Bidang Sekretariat
    </a>

    <a href="/mikro">
      <i class="fas fa-store"></i> Pemberdayaan Usaha Mikro
    </a>

    <a href="/perdagangan">
      <i class="fas fa-truck"></i> Distribusi Perdagangan
    </a>

    <a href="/koperasi">
      <i class="fas fa-building"></i> Bidang Koperasi
    </a>

    <a href="/pembinaan">
      <i class="fas fa-briefcase"></i> Pembinaan Usaha Perdagangan
    </a>

    <!-- ✅ AKTIF -->
    <a href="/metrologi" class="active">
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
      <b>UPTD Metrologi Legal</b><br>
      <small>Dinkopumdag Surabaya</small>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="container">

    <h2>Detail : UPTD Metrologi Legal</h2>

    <div class="cards">

      <div class="card teal">
        <h4>Jumlah Alat Ukur</h4>
        <h2>68</h2>
      </div>

      <div class="card blue">
        <h4>Sudah Tera</h4>
        <h2>50</h2>
      </div>

      <div class="card orange">
        <h4>Belum Tera</h4>
        <h2>18</h2>
      </div>

      <div class="card white" onclick="window.location.href='/dashboard'">
        <h4>← Kembali</h4>
      </div>

    </div>

  </div>

</div>

<script src="{{ asset('js/script.js') }}"></script>

<script>
function logout(){
  localStorage.removeItem("login");
  window.location.href = "/";
}
</script>

</body>
</html>