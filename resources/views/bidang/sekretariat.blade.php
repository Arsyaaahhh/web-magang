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
  padding: 8px;
  border-radius: 6px;
}
input:focus, select:focus {
  border-color: #0d6efd;
}

/* Ukuran Font Card Menu */
.card h2 {
  margin-top: 8px;
  font-size: 24px;
  font-weight: 600;
}

/* ===== Desain Tombol Lebih Rapi ===== */
.btn-back {
  margin-bottom: 15px;
  background-color: #6c757d;
  color: white;
  border: none;
  padding: 8px 16px;
  border-radius: 6px;
  cursor: pointer;
  font-size: 14px;
  transition: background-color 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.btn-back:hover {
  background-color: #5a6268;
}
.btn-primary {
  background-color: #0d6efd;
}
.btn-primary:hover {
  background-color: #0b5ed7;
}

/* ===== Card Surat Lebih Kecil ===== */
.cards-sm {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 15px;
}
.card-sm {
  padding: 15px !important;
  min-height: 120px !important;
}
.card-sm h4 {
  font-size: 15px;
  margin-bottom: 5px;
}
.card-sm p {
  font-size: 13px;
  line-height: 1.4;
  margin-bottom: 8px;
}
.card-sm small {
  font-size: 11px;
  opacity: 0.9;
}

/* ===== Warna teks tabel PEGAWAI (PNS & Non PNS) ===== */
#pnsArea table thead tr th, #nonPnsArea table thead tr th {
  color: #ffffff !important;
  background-color: #0d6efd !important;
  white-space: nowrap;
}
#pnsArea table tbody tr td, #nonPnsArea table tbody tr td {
  color: #212529 !important;
  background-color: #ffffff !important;
  padding: 10px;
}
#pnsArea table tbody tr:nth-child(even) td, #nonPnsArea table tbody tr:nth-child(even) td {
  background-color: #f0f4ff !important;
}
#pnsArea table tbody tr:hover td, #nonPnsArea table tbody tr:hover td {
  background-color: #dde9ff !important;
}

/* ===== Warna teks tabel MAGANG ===== */
#magangArea table thead tr th {
  color: #ffffff !important;
  background-color: #0d6efd !important;
  white-space: nowrap;
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

/* ===== 🔥 TAMBAHAN: CSS RESPONSIVE & TABEL SCROLL ===== */
.table-responsive {
  width: 100%;
  overflow-x: auto; /* Memungkinkan scroll horizontal untuk tabel di layar kecil */
  -webkit-overflow-scrolling: touch;
}

@media screen and (max-width: 768px) {
  .cards, .cards-sm {
    grid-template-columns: 1fr; /* Mengubah grid menjadi 1 kolom ke bawah di HP */
  }
  
  .sidebar {
    position: fixed;
    left: -250px;
    top: 0;
    height: 100vh;
    width: 250px;
    z-index: 1000;
    transition: left 0.3s ease;
  }
  
  /* Kelas ini akan ditambahkan lewat JS saat tombol burger menu diklik */
  .sidebar.active {
    left: 0;
  }
  
  .main {
    margin-left: 0 !important;
    width: 100%;
    transition: margin-left 0.3s ease;
  }
  
  .header {
    width: 100%;
  }

  /* Filter form dropdown dan search menyusut ke bawah di HP */
  .filter-container {
    flex-direction: column;
  }
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebarMenu">
  <h2>DINKOPUMDAG</h2>

  <!-- 🔥 FIX: Tambahkan text-align: center; agar tanggal di tengah -->
  <div id="tanggalSidebar" style="margin:10px 0; font-size:14px; color:#fff; text-align: center; font-weight: 500;"></div>

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

<!-- ================= MENU UTAMA ================= -->
<div class="cards" id="mainMenu">
  <div class="card blue" onclick="showSuratMenu()">
    <h4>Surat</h4>
    <p>SK, SP, dan SOP</p>
  </div>

  <div class="card green" onclick="showPegawaiMenu()">
    <h4>Data Pegawai</h4>
    <p>Rekap pegawai</p>
  </div>

  <div class="card orange" onclick="showMagang()">
    <h4>Data Magang</h4>
    <p>Rekap peserta magang</p>
  </div>
</div>


<!-- ================= SUBMENU SURAT ================= -->
<div id="suratMenuArea" style="display:none; margin-top:20px;">
  <h3>Kategori Surat</h3>
  <button onclick="hideAll()" class="btn-back btn-primary">
    <i class="fas fa-arrow-left"></i> Kembali ke Menu Utama
  </button>

  <div class="cards">
    <div class="card blue" onclick="showSK()">
      <h4>SK Kepala Dinas</h4>
      <p>Arsip keputusan kepala dinas</p>
      <h2 id="countSK">0</h2>
    </div>
    <div class="card green" onclick="showSP()">
      <h4>Standar Pelayanan</h4>
      <h2 id="countSP">0</h2>
    </div>
    <div class="card orange" onclick="showSOP()">
      <h4>SOP</h4>
      <h2 id="countSOP">0</h2>
    </div>
  </div>
</div>

<!-- ================= SK ================= -->
<div id="skArea" style="display:none; margin-top:20px;">
  <h3>Detail : Sekretariat (SK)</h3>
  <button onclick="showSuratMenu()" class="btn-back">
    <i class="fas fa-arrow-left"></i> Kembali ke Kategori Surat
  </button>

  <div class="filter-container" style="display:flex; gap:10px; margin-bottom:20px;">
    <input id="search" placeholder="🔎 Cari..." onkeyup="delayFilter()" style="flex:1;">
    <select id="tahun" onchange="filterData()">
      <option value="all">Semua Tahun</option>
    </select>
  </div>
  <div class="cards cards-sm" id="cardContainer"></div>
</div>

<!-- ================= SP ================= -->
<div id="spArea" style="display:none; margin-top:20px;">
  <h3>Detail : Standar Pelayanan</h3>
  <button onclick="showSuratMenu()" class="btn-back">
    <i class="fas fa-arrow-left"></i> Kembali ke Kategori Surat
  </button>

  <div class="filter-container" style="display:flex; gap:10px; margin-bottom:20px;">
    <input id="searchSP" placeholder="🔎 Cari..." onkeyup="delayFilterSP()" style="flex:1;">
    <select id="tahunSP" onchange="filterSP()">
      <option value="all">Semua Tahun</option>
    </select>
  </div>
  <div class="cards cards-sm" id="cardContainerSP"></div>
</div>

<!-- ================= SOP ================= -->
<div id="sopArea" style="display:none; margin-top:20px;">
  <h3>Detail : SOP</h3>
  <button onclick="showSuratMenu()" class="btn-back">
    <i class="fas fa-arrow-left"></i> Kembali ke Kategori Surat
  </button>

  <div class="filter-container" style="display:flex; gap:10px; margin-bottom:20px;">
    <input id="searchSOP" placeholder="🔎 Cari..." onkeyup="delayFilterSOP()" style="flex:1;">
    <select id="tahunSOP" onchange="filterSOP()">
      <option value="all">Semua Tahun</option>
    </select>
  </div>
  <div class="cards cards-sm" id="cardContainerSOP"></div>
</div>


<!-- ================= SUBMENU PEGAWAI ================= -->
<div id="pegawaiMenuArea" style="display:none; margin-top:20px;">
  <h3>Kategori Pegawai</h3>
  <button onclick="hideAll()" class="btn-back btn-primary">
    <i class="fas fa-arrow-left"></i> Kembali ke Menu Utama
  </button>

  <div class="cards">
    <div class="card blue" onclick="showPNS()">
      <h4>PNS</h4>
      <p>Data Pegawai Negeri Sipil</p>
    </div>
    <div class="card green" onclick="showNonPNS()">
      <h4>Non PNS</h4>
      <p>Data Pegawai Non PNS</p>
    </div>
  </div>
</div>

<!-- ================= TABEL PEGAWAI PNS ================= -->
<div id="pnsArea" style="display:none; margin-top:20px;">
  <h3>Data Pegawai - PNS</h3>
  <button onclick="showPegawaiMenu()" class="btn-back">
    <i class="fas fa-arrow-left"></i> Kembali ke Pilihan Pegawai
  </button>

  <div class="card" style="padding: 0;">
    <!-- 🔥 FIX: Wrapper responsif untuk tabel -->
    <div class="table-responsive">
      <table style="width:100%; border-collapse:collapse; min-width: 500px;">
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
          @php $noPns = 1; @endphp
          @foreach($pegawai as $p)
            @if(strtolower($p->status) == 'pns')
            <tr>
              <td style="padding:10px; color:#212529;">{{ $noPns++ }}</td>
              <td style="padding:10px; color:#212529;">{{ $p->status }}</td>
              <td style="padding:10px; color:#212529;">{{ $p->pendidikan }}</td>
              <td style="padding:10px; color:#212529;">{{ $p->jumlah }}</td>
            </tr>
            @endif
          @endforeach
          @if($noPns == 1)
          <tr><td colspan="4" style="text-align:center; padding:10px; color:#999;">Tidak ada data pegawai PNS</td></tr>
          @endif
        @else
          <tr><td colspan="4" style="text-align:center; padding:10px; color:#999;">Tidak ada data pegawai</td></tr>
        @endif
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- ================= TABEL PEGAWAI NON PNS ================= -->
<div id="nonPnsArea" style="display:none; margin-top:20px;">
  <h3>Data Pegawai - Non PNS</h3>
  <button onclick="showPegawaiMenu()" class="btn-back">
    <i class="fas fa-arrow-left"></i> Kembali ke Pilihan Pegawai
  </button>

  <div class="card" style="padding: 0;">
    <!-- 🔥 FIX: Wrapper responsif untuk tabel -->
    <div class="table-responsive">
      <table style="width:100%; border-collapse:collapse; min-width: 500px;">
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
          @php $noNonPns = 1; @endphp
          @foreach($pegawai as $p)
            @if(strtolower($p->status) != 'pns')
            <tr>
              <td style="padding:10px; color:#212529;">{{ $noNonPns++ }}</td>
              <td style="padding:10px; color:#212529;">{{ $p->status }}</td>
              <td style="padding:10px; color:#212529;">{{ $p->pendidikan }}</td>
              <td style="padding:10px; color:#212529;">{{ $p->jumlah }}</td>
            </tr>
            @endif
          @endforeach
          @if($noNonPns == 1)
          <tr><td colspan="4" style="text-align:center; padding:10px; color:#999;">Tidak ada data pegawai Non PNS</td></tr>
          @endif
        @else
          <tr><td colspan="4" style="text-align:center; padding:10px; color:#999;">Tidak ada data pegawai</td></tr>
        @endif
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- ================= MAGANG ================= -->
<div id="magangArea" style="display:none; margin-top:20px;">
  <h3>Data Magang</h3>
  <button onclick="hideAll()" class="btn-back btn-primary">
    <i class="fas fa-arrow-left"></i> Kembali ke Menu Utama
  </button>

  <div class="card" style="padding: 0;">
    <!-- 🔥 FIX: Wrapper responsif untuk tabel -->
    <div class="table-responsive">
      <table style="width:100%; border-collapse:collapse; font-size:13px; min-width: 800px;">
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
        <tbody>
        @forelse($magang as $m)
        <tr>
          <td style="padding:10px;">{{ $loop->iteration }}</td>
          <td style="padding:10px;">{{ $m->email }}</td>
          <td style="padding:10px;">{{ $m->nama }}</td>
          <td style="padding:10px;">{{ $m->asal_univ }}</td>
          <td style="padding:10px;">{{ \Carbon\Carbon::parse($m->awal_pelaksanaan)->format('d M Y') }}</td>
          <td style="padding:10px;">{{ \Carbon\Carbon::parse($m->akhir_pelaksanaan)->format('d M Y') }}</td>
          <td style="padding:10px;">{{ $m->posisi }}</td>
        </tr>
        @empty
        <tr><td colspan="7" style="text-align:center; padding:12px; color:#999;">Tidak ada data magang</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
</div>

<script>
// ================= TOGGLE SIDEBAR (MOBILE) =================
function toggleSidebar() {
  const sidebar = document.getElementById('sidebarMenu');
  sidebar.classList.toggle('active');
}

// Tutup sidebar otomatis jika user klik di luar area sidebar (untuk mobile)
document.addEventListener('click', function(event) {
  const sidebar = document.getElementById('sidebarMenu');
  const toggleBtn = document.querySelector('.toggle-btn');
  
  if (window.innerWidth <= 768) {
    if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
      sidebar.classList.remove('active');
    }
  }
});

// ================= RESET NAVIGASI =================
function hideAllViews() {
  const views = [
    'mainMenu', 'suratMenuArea', 'skArea', 'spArea', 'sopArea', 
    'pegawaiMenuArea', 'pnsArea', 'nonPnsArea', 'magangArea'
  ];
  views.forEach(v => {
    if(document.getElementById(v)) document.getElementById(v).style.display = 'none';
  });
}

// Navigasi Tampilan
function hideAll() { 
  hideAllViews(); 
  document.getElementById('mainMenu').style.display = 'grid'; 
}
function showSuratMenu() { 
  hideAllViews(); 
  document.getElementById('suratMenuArea').style.display = 'block'; 
}
function showPegawaiMenu() { 
  hideAllViews(); 
  document.getElementById('pegawaiMenuArea').style.display = 'block'; 
}
function showMagang() { 
  hideAllViews(); 
  document.getElementById('magangArea').style.display = 'block'; 
}
function showSK() { 
  hideAllViews(); 
  document.getElementById('skArea').style.display = 'block'; 
  filterData(); 
}
function showSP() { 
  hideAllViews(); 
  document.getElementById('spArea').style.display = 'block'; 
  filterSP(); 
}
function showSOP() { 
  hideAllViews(); 
  document.getElementById('sopArea').style.display = 'block'; 
  filterSOP(); 
}
function showPNS() { 
  hideAllViews(); 
  document.getElementById('pnsArea').style.display = 'block'; 
}
function showNonPNS() { 
  hideAllViews(); 
  document.getElementById('nonPnsArea').style.display = 'block'; 
}

// ================= COUNT SURAT =================
function loadCount(){
  fetch(`/sekretariat?jenis=sk`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
  .then(res => res.json())
  .then(res => {
    if(document.getElementById("countSK")) document.getElementById("countSK").innerText = res.jumlah.sk || 0;
    if(document.getElementById("countSP")) document.getElementById("countSP").innerText = res.jumlah.sp || 0;
    if(document.getElementById("countSOP")) document.getElementById("countSOP").innerText = res.jumlah.sop || 0;
  }).catch(err => console.log("Gagal memuat jumlah surat", err));
}

// ================= UTIL =================
function openPDF(file){ window.open('/pdf/' + file, '_blank'); }
function logout(){ location.href="/logout"; }

function getColor(id){
  const colors = ['blue','green','orange','teal','purple'];
  return colors[id % colors.length];
}

// ================= FILTER SK =================
function filterData(){
  let search = document.getElementById("search").value;
  let tahun  = document.getElementById("tahun").value;
  let container = document.getElementById("cardContainer");
  let select = document.getElementById("tahun");

  container.innerHTML = "Loading...";

  fetch(`/sekretariat?jenis=sk&search=${search}&tahun=${tahun}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
  .then(res => res.json())
  .then(res => {
    let selected = tahun;
    select.innerHTML = `<option value="all">Semua Tahun</option>`;
    if(res.tahunList) {
      res.tahunList.forEach(t=>{ select.innerHTML += `<option value="${t}">${t}</option>`; });
    }
    select.value = selected;

    container.innerHTML = "";
    if(!res.data || res.data.length === 0){ container.innerHTML = "Tidak ada data"; return; }

    res.data.forEach(item=>{
      let color = getColor(item.id);
      container.innerHTML += `
      <div class="card card-sm ${color}" onclick="openPDF('${item.file}')">
        <h4>${item.nomor}</h4>
        <p>${item.judul}</p>
        <small>Tahun: ${item.tahun}</small>
      </div>`;
    });
  });
}

// ================= FILTER SP =================
function filterSP(){
  let search = document.getElementById("searchSP").value;
  let tahun  = document.getElementById("tahunSP").value;
  let container = document.getElementById("cardContainerSP");
  let select = document.getElementById("tahunSP");

  container.innerHTML = "Loading...";

  fetch(`/sekretariat?jenis=sp&search=${search}&tahun=${tahun}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
  .then(res => res.json())
  .then(res => {
    let selected = tahun;
    select.innerHTML = `<option value="all">Semua Tahun</option>`;
    if(res.tahunList) {
      res.tahunList.forEach(t=>{ select.innerHTML += `<option value="${t}">${t}</option>`; });
    }
    select.value = selected;

    container.innerHTML = "";
    if(!res.data || res.data.length === 0){ container.innerHTML = "Tidak ada data"; return; }

    res.data.forEach(item=>{
      let color = getColor(item.id);
      container.innerHTML += `
      <div class="card card-sm ${color}" onclick="openPDF('${item.file}')">
        <h4>${item.nomor}</h4>
        <p>${item.judul}</p>
        <small>Tahun: ${item.tahun}</small>
      </div>`;
    });
  });
}

// ================= FILTER SOP =================
function filterSOP(){
  let search = document.getElementById("searchSOP").value;
  let tahun  = document.getElementById("tahunSOP").value;
  let container = document.getElementById("cardContainerSOP");
  let select = document.getElementById("tahunSOP");

  container.innerHTML = "Loading...";

  fetch(`/sekretariat?jenis=sop&search=${search}&tahun=${tahun}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
  .then(res => res.json())
  .then(res => {
    let selected = tahun;
    select.innerHTML = `<option value="all">Semua Tahun</option>`;
    if(res.tahunList) {
      res.tahunList.forEach(t=>{ select.innerHTML += `<option value="${t}">${t}</option>`; });
    }
    select.value = selected;

    container.innerHTML = "";
    if(!res.data || res.data.length === 0){ container.innerHTML = "Tidak ada data"; return; }

    res.data.forEach(item=>{
      let color = getColor(item.id);
      container.innerHTML += `
      <div class="card card-sm ${color}" onclick="openPDF('${item.file}')">
        <h4>${item.nomor}</h4>
        <p>${item.judul}</p>
        <small>Tahun: ${item.tahun}</small>
      </div>`;
    });
  });
}

// ================= DELAY FILTER =================
let t1, t2, t3;
function delayFilter(){ clearTimeout(t1); t1=setTimeout(filterData, 400); }
function delayFilterSP(){ clearTimeout(t2); t2=setTimeout(filterSP, 400); }
function delayFilterSOP(){ clearTimeout(t3); t3=setTimeout(filterSOP, 400); }

// ================= INIT =================
window.onload = function(){
  loadCount();
  // Sidebar Tanggal
  const el = document.getElementById('tanggalSidebar');
  if (el) {
    const now = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    el.textContent = now.toLocaleDateString('id-ID', options);
  }
};
</script>

</body>
</html>