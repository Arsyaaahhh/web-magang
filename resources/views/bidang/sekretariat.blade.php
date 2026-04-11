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
</style>

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <h2>DINKOPUMDAG</h2>
  <div class="sidebar-date" id="tanggalSidebar"></div>

  <div class="menu">
    <a href="/dashboard"><i class="fas fa-chart-line"></i> Dashboard Utama</a>
    <a href="/sekretariat" class="active"><i class="fas fa-user-tie"></i> Bidang Sekretariat</a>
    <a onclick="cardClick('Pemberdayaan Usaha Mikro')"><i class="fas fa-store"></i> Pemberdayaan Usaha Mikro</a>
    <a onclick="cardClick('Distribusi Perdagangan')"><i class="fas fa-truck"></i> Distribusi Perdagangan</a>
    <a onclick="cardClick('Koperasi')"><i class="fas fa-building"></i> Bidang Koperasi</a>
    <a onclick="cardClick('Pembinaan Usaha Perdagangan')"><i class="fas fa-briefcase"></i> Pembinaan Usaha Perdagangan</a>
    <a onclick="cardClick('UPTD Metrologi Legal')"><i class="fas fa-balance-scale"></i> UPTD Metrologi Legal</a>
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
      <b>Bidang Sekretariat</b><br>
      <small>Dinkopumdag Surabaya</small>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="container">

    <h2>Bidang Sekretariat</h2>

    <!-- MENU -->
    <div class="cards" id="menuUtama">

      <div class="card blue" onclick="showSK()">
        <h4>SK Kepala Dinas</h4>
        <p>Arsip keputusan kepala dinas</p>
      </div>

      <div class="card green" onclick="showSP()">
        <h4>Standar Pelayanan</h4>
        <p>Dokumen standar pelayanan</p>
      </div>

      <div class="card orange" onclick="showSOP()">
        <h4>SOP</h4>
        <p>Prosedur operasional</p>
      </div>

    </div>

    <!-- ================= SK ================= -->
    <div id="skArea" style="display:none; margin-top:20px;">
      <h3>Detail : Sekretariat</h3>

      <div style="display:flex; gap:10px; margin-bottom:20px;">
        <input id="searchSK" onkeyup="filterSK()" placeholder="🔎 Cari Nomor SK..." style="padding:10px; width:300px;">
        <select id="filterTahun" onchange="filterSK()" style="padding:10px;">
          <option value="all">Semua Tahun</option>
          <option value="2022">2022</option>
          <option value="2023">2023</option>
          <option value="2024">2024</option>
          <option value="2025">2025</option>
          <option value="2026">2026</option>
        </select>
      </div>

      <div class="cards" id="skCards">
        <div class="card blue" data-year="2022" onclick="openPDF('sk-gratifikasi.pdf')"><h4>188.45/12/2022</h4><p>SK Tim Pengendali Gratifikasi</p></div>
        <div class="card green" data-year="2023"><h4>188.45/45/2023</h4><p>SK Reformasi Birokrasi</p></div>
        <div class="card orange" data-year="2024"><h4>188.45/70/2024</h4><p>SK Pengelola Data</p></div>
        <div class="card teal" data-year="2025"><h4>188.45/05/2025</h4><p>SK Pengelolaan UMKM</p></div>
        <div class="card purple" data-year="2026"><h4>188.45/08/2026</h4><p>SK Reformasi Data</p></div>
        <div class="card white" onclick="hideAll()"><h4>← Kembali</h4></div>
      </div>
    </div>

    <!-- ================= SP ================= -->
    <div id="spArea" style="display:none; margin-top:20px;">
      <h3>Detail : Sekretariat</h3>

      <div style="display:flex; gap:10px; margin-bottom:20px;">
        <input id="searchSP" onkeyup="filterSP()" placeholder="🔎 Cari SP..." style="padding:10px; width:300px;">
        <select id="filterSPKategori" onchange="filterSP()" style="padding:10px;">
          <option value="all">Semua</option>
          <option value="umkm">UMKM</option>
          <option value="koperasi">Koperasi</option>
          <option value="distribusi">Distribusi</option>
        </select>
      </div>

      <div class="cards" id="spCards">
        <div class="card blue" data-type="umkm"><h4>SP-01</h4><p>Pelayanan UMKM</p></div>
        <div class="card green" data-type="koperasi"><h4>SP-02</h4><p>Pelayanan Koperasi</p></div>
        <div class="card orange" data-type="distribusi"><h4>SP-03</h4><p>Pelayanan Distribusi</p></div>
        <div class="card white" onclick="hideAll()"><h4>← Kembali</h4></div>
      </div>
    </div>

    <!-- ================= SOP ================= -->
    <div id="sopArea" style="display:none; margin-top:20px;">
      <h3>Detail : Sekretariat</h3>

      <div style="display:flex; gap:10px; margin-bottom:20px;">
        <input id="searchSOP" onkeyup="filterSOP()" placeholder="🔎 Cari SOP..." style="padding:10px; width:300px;">
        
        <!-- ✅ FIX DISINI -->
        <select id="filterSOPKategori" onchange="filterSOP()" style="padding:10px;">
          <option value="all">Semua</option>
          <option value="pelayanan">Pelayanan</option>
          <option value="dokumen">Dokumen</option>
          <option value="arsip">Arsip</option>
        </select>
      </div>

      <div class="cards" id="sopCards">
        <div class="card blue" data-type="pelayanan"><h4>SOP-01</h4><p>Prosedur Pelayanan</p></div>
        <div class="card green" data-type="dokumen"><h4>SOP-02</h4><p>Pengelolaan Dokumen</p></div>
        <div class="card orange" data-type="arsip"><h4>SOP-03</h4><p>Pengarsipan Data</p></div>
        <div class="card white" onclick="hideAll()"><h4>← Kembali</h4></div>
      </div>
    </div>

  </div>
</div>

<script src="{{ asset('js/script.js') }}"></script>

<script>
function showSK(){ menuUtama.style.display="none"; skArea.style.display="block"; spArea.style.display="none"; sopArea.style.display="none";}
function showSP(){ menuUtama.style.display="none"; skArea.style.display="none"; spArea.style.display="block"; sopArea.style.display="none";}
function showSOP(){ menuUtama.style.display="none"; skArea.style.display="none"; spArea.style.display="none"; sopArea.style.display="block";}
function hideAll(){ menuUtama.style.display="grid"; skArea.style.display="none"; spArea.style.display="none"; sopArea.style.display="none";}

function filterSK(){
  const k=searchSK.value.toUpperCase(), y=filterTahun.value;
  document.querySelectorAll("#skCards .card").forEach(c=>{
    c.style.display=(c.innerText.toUpperCase().includes(k)&&(y=="all"||y==c.dataset.year))?"block":"none";
  });
}

function filterSP(){
  const k=searchSP.value.toUpperCase(), t=document.getElementById("filterSPKategori").value;
  document.querySelectorAll("#spCards .card").forEach(c=>{
    c.style.display=(c.innerText.toUpperCase().includes(k)&&(t=="all"||t==c.dataset.type))?"block":"none";
  });
}

/* ✅ FIX SOP */
function filterSOP(){
  const k=document.getElementById("searchSOP").value.toUpperCase();
  const t=document.getElementById("filterSOPKategori").value;

  document.querySelectorAll("#sopCards .card").forEach(c=>{
    const matchSearch=c.innerText.toUpperCase().includes(k);
    const matchFilter=(t=="all"||t==c.dataset.type);
    c.style.display=(matchSearch&&matchFilter)?"block":"none";
  });
}

function logout(){ localStorage.removeItem("login"); location.href="/"; }

function openPDF(file){
  window.open('/pdf/' + file, '_blank');
}
</script>

</body>
</html>