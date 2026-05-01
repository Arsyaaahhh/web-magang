<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sekretariat</title>

<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
h2 { margin-bottom: 10px; }
h3 { margin-top: 5px; margin-bottom: 15px; }

input, select {
  border: 1px solid #ddd;
  outline: none;
}
input:focus, select:focus {
  border-color: #0d6efd;
}

.card h2 {
  margin-top: 8px;
  font-size: 24px;
  font-weight: 600;
}

/* ===== FIX: Warna teks tabel PEGAWAI ===== */
#pegawaiArea table thead tr th {
  color: #ffffff !important;
  background-color: #0d6efd !important;
}
#pegawaiArea table tbody tr td {
  color: #212529 !important;
  background-color: #ffffff !important;
  padding: 10px;
}
#pegawaiArea table tbody tr:nth-child(even) td {
  background-color: #f0f4ff !important;
}
#pegawaiArea table tbody tr:hover td {
  background-color: #dde9ff !important;
}

/* ===== FIX: Warna teks tabel MAGANG ===== */
#magangArea table thead tr th {
  color: #ffffff !important;
  background-color: #0d6efd !important;
}
#magangArea table tbody tr td {
  color: #212529 !important;
  background-color: #ffffff !important;
}
#magangArea table tbody tr:nth-child(even) td {
  background-color: #f0f4ff !important;
}
#magangArea table tbody tr:hover td {
  background-color: #dde9ff !important;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <h2>DINKOPUMDAG</h2>

  <div id="tanggalSidebar" style="margin:10px 0; font-size:14px; color:#fff;"></div>

  <div class="menu">
    <a href="/dashboard"><i class="fas fa-chart-line"></i> Dashboard Utama</a>
    <a href="/sekretariat" class="active"><i class="fas fa-user-tie"></i> Bidang Sekretariat</a>
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

<!-- MAIN -->
<div class="main">

<div class="header">
  <div class="toggle-btn" onclick="toggleSidebar()">☰</div>
  <img src="{{ asset('images/logo.jpg') }}" class="logo">
  <div>
    <b>Bidang Sekretariat</b><br>
    <small>Dinkopumdag Surabaya</small>
  </div>
</div>

<div class="container">

<h2>Bidang Sekretariat</h2>

<!-- MENU -->
<div class="cards" id="mainMenu">

  <div class="card blue" onclick="showSurat()">
    <h4>Surat</h4>
    <p>SK, SP, dan SOP</p>
  </div>

  <div class="card green" onclick="showPegawai()">
    <h4>Data Pegawai</h4>
    <p>Rekap pegawai</p>
  </div>

  <div class="card orange" onclick="showMagang()">
    <h4>Data Magang</h4>
    <p>Rekap peserta magang</p>
  </div>

</div>

<!-- ================= PEGAWAI ================= -->
<div id="pegawaiArea" style="display:none; margin-top:20px;">
  <h3>Data Pegawai (Rekap)</h3>

  <button onclick="hideAll()" style="margin-bottom:10px;background:#0d6efd;color:white;border:none;padding:8px 16px;border-radius:6px;cursor:pointer;">
    ← Kembali
  </button>

  <div class="card">
    <table style="width:100%; border-collapse:collapse;">
      <thead>
        <tr style="background:#0d6efd;">
          <th style="padding:10px; color:#ffffff;">No</th>
          <th style="padding:10px; color:#ffffff;">Status</th>
          <th style="padding:10px; color:#ffffff;">Pendidikan</th>
          <th style="padding:10px; color:#ffffff;">Jumlah</th>
        </tr>
      </thead>

      <tbody>

      @if(isset($pegawai) && count($pegawai) > 0)

        @foreach($pegawai as $p)
        <tr>
          <td style="padding:10px; color:#212529;">{{ $loop->iteration }}</td>
          <td style="padding:10px; color:#212529;">{{ $p->status }}</td>
          <td style="padding:10px; color:#212529;">{{ $p->pendidikan }}</td>
          <td style="padding:10px; color:#212529;">{{ $p->jumlah }}</td>
        </tr>
        @endforeach

      @else

        <tr>
          <td colspan="4" style="text-align:center; padding:10px; color:#999;">
            Tidak ada data pegawai
          </td>
        </tr>

      @endif

      </tbody>
    </table>
  </div>
</div>

<!-- ================= MAGANG ================= -->
<div id="magangArea" style="display:none; margin-top:20px;">
  <h3>Data Magang</h3>

  <button onclick="hideAll()" 
    style="margin-bottom:10px;background:#0d6efd;color:white;border:none;padding:8px 16px;border-radius:6px;cursor:pointer;">
    ← Kembali
  </button>

  <div class="card" style="overflow-x:auto;">
    <table style="width:100%; border-collapse:collapse; font-size:13px;">

      <!-- HEADER -->
      <thead>
        <tr style="background:#0d6efd;">
          <th style="padding:10px; color:#ffffff;">No</th>
          <th style="padding:10px; color:#ffffff;">Email</th>
          <th style="padding:10px; color:#ffffff;">Nama</th>
          <th style="padding:10px; color:#ffffff;">Asal Univ</th>
          <th style="padding:10px; color:#ffffff;">Mulai</th>
          <th style="padding:10px; color:#ffffff;">Selesai</th>
          <th style="padding:10px; color:#ffffff;">Posisi</th>
        </tr>
      </thead>

      <!-- BODY -->
      <tbody>

      @forelse($magang as $m)
      <tr>
        <td style="padding:10px;">{{ $loop->iteration }}</td>
        <td style="padding:10px;">{{ $m->email }}</td>
        <td style="padding:10px;">{{ $m->nama }}</td>
        <td style="padding:10px;">{{ $m->asal_univ }}</td>
        <td style="padding:10px;">
          {{ \Carbon\Carbon::parse($m->awal_pelaksanaan)->format('d M Y') }}
        </td>
        <td style="padding:10px;">
          {{ \Carbon\Carbon::parse($m->akhir_pelaksanaan)->format('d M Y') }}
        </td>
        <td style="padding:10px;">{{ $m->posisi }}</td>
      </tr>
      @empty
      <tr>
        <td colspan="7" style="text-align:center; padding:12px; color:#999;">
          Tidak ada data magang
        </td>
      </tr>
      @endforelse

      </tbody>

    </table>
  </div>
</div>

</div>
</div>

<script>

// NAV
function showPegawai() {
  document.getElementById('mainMenu').style.display = 'none';
  document.getElementById('pegawaiArea').style.display = 'block';
  document.getElementById('magangArea').style.display = 'none';
}

function showMagang() {
  document.getElementById('mainMenu').style.display = 'none';
  document.getElementById('pegawaiArea').style.display = 'none';
  document.getElementById('magangArea').style.display = 'block';
}

function showSurat() {
  alert("Menu Surat tetap pakai sistem sebelumnya");
}

function hideAll() {
  document.getElementById('mainMenu').style.display = 'grid';
  document.getElementById('pegawaiArea').style.display = 'none';
  document.getElementById('magangArea').style.display = 'none';
}

function logout() {
  location.href = "/logout";
}

// Tampilkan tanggal di sidebar
(function() {
  const el = document.getElementById('tanggalSidebar');
  if (el) {
    const now = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    el.textContent = now.toLocaleDateString('id-ID', options);
  }
})();

</script>

</body>
</html>