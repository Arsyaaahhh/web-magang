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

/* 🔥 TAMBAHAN (TIDAK MERUSAK UI) */
.card h2{
  margin-top:8px;
  font-size:24px;
  font-weight:600;
}

#magangArea table,
#magangArea th,
#magangArea td {
  color: #000 !important;
}
</style>
</head>

<body>

<!-- SIDEBAR (TIDAK DIUBAH) -->
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
    <p>Informasi pegawai sekretariat</p>
  </div>

  <div class="card orange" onclick="showMagang()">
    <h4>Data Magang</h4>
    <p>Rekap peserta magang</p>
  </div>

</div>

<div class="cards" id="suratMenu" style="display:none; margin-top:20px;">
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

  <div class="card white" onclick="hideAll()" style="width:100%; text-align:center;">
    ← Kembali
  </div>
</div>

<div id="pegawaiArea" style="display:none; margin-top:20px;">
  <h3>Data Pegawai</h3>
  
  <div style="margin-bottom:10px;">
    <button onclick="hideAll()" style="background:#0d6efd;color:white;border:none;padding:8px 16px;border-radius:6px;cursor:pointer;font-size:14px;font-weight:500;">
      ← Kembali
    </button>
  </div>

  <div class="card" style="overflow-x:auto;">
    <table style="width:100%; border-collapse:collapse; font-size:13px;">
      <thead>
        <tr style="background:#0d6efd; color:white;">
          <th style="padding:10px; border:1px solid #000000; text-align:left;">No</th>
          <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Nama</th>
          <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">NIP</th>
          <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Bidang</th>
          <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Posisi</th>
          <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Alamat</th>
        </tr>
      </thead>
      <tbody>
        @forelse($pegawai as $p)
        <tr style="border:1px solid #d1d5db;">
          <td style="padding:10px; border:1px solid #000000;">{{ $loop->iteration }}</td>
          <td style="padding:10px; border:1px solid #08090a;">{{ $p->nama }}</td>
          <td style="padding:10px; border:1px solid #000000;">{{ $p->nip }}</td>
          <td style="padding:10px; border:1px solid #000000;">{{ $p->bidang }}</td>
          <td style="padding:10px; border:1px solid #000000;">{{ $p->posisi }}</td>
          <td style="padding:10px; border:1px solid #000000;">{{ $p->alamat }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="6" style="padding:10px; border:1px solid #d1d5db; text-align:center; color:#999;">
            Tidak ada data pegawai
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div id="magangArea" style="display:none; margin-top:20px;">
  <h3>Data Magang</h3>
  
  <div style="margin-bottom:10px;">
    <button onclick="hideAll()" style="background:#0d6efd;color:white;border:none;padding:8px 16px;border-radius:6px;cursor:pointer;font-size:14px;font-weight:500;">
      ← Kembali
    </button>
  </div>

  <div class="card" style="overflow-x:auto;">
    <table style="width:100%; border-collapse:collapse; font-size:13px;">
      <thead>
        <tr style="background:#0d6efd; color:white;">
          <th style="padding:10px; border:1px solid #000000; text-align:left;">No</th>
          <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Email</th>
          <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Nama</th>
          <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">NIM</th>
          <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Asal Univ</th>
          <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Awal</th>
          <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Akhir</th>
          <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Durasi</th>
          <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">No HP</th>
          <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Bidang</th>
          <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Posisi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($magang as $m)
        <tr style="border:1px solid #d1d5db;">
          <td style="padding:10px; border:1px solid #000000;">{{ $loop->iteration }}</td>
          <td style="padding:10px; border:1px solid #08090a;">{{ $m->email }}</td>
          <td style="padding:10px; border:1px solid #000000;">{{ $m->nama }}</td>
          <td style="padding:10px; border:1px solid #000000;">{{ $m->nim }}</td>
          <td style="padding:10px; border:1px solid #000000;">{{ $m->asal_univ }}</td>
          <td style="padding:10px; border:1px solid #000000;">{{ $m->awal_pelaksanaan }}</td>
          <td style="padding:10px; border:1px solid #010202;">{{ $m->akhir_pelaksanaan }}</td>
          <td style="padding:10px; border:1px solid #000000;">{{ $m->durasi }}</td>
          <td style="padding:10px; border:1px solid #000000;">{{ $m->no_hp }}</td>
          <td style="padding:10px; border:1px solid #010202;">{{ $m->bidang }}</td>
          <td style="padding:10px; border:1px solid #000000;">{{ $m->posisi }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="11" style="padding:10px; border:1px solid #d1d5db; text-align:center; color:#999;">
            Tidak ada data magang
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<!-- ================= SK ================= -->
<div id="skArea" style="display:none; margin-top:20px;">
  <h3>Detail : Sekretariat (SK)</h3>

  <div style="display:flex; gap:10px; margin-bottom:20px;">
    <input id="search" placeholder="🔎 Cari..." onkeyup="delayFilter()">
    <select id="tahun" onchange="filterData()">
      <option value="all">Semua Tahun</option>
    </select>
  </div>

  <div class="cards" id="cardContainer"></div>
</div>

<!-- ================= SP ================= -->
<div id="spArea" style="display:none; margin-top:20px;">
  <h3>Detail : Standar Pelayanan</h3>

  <div style="display:flex; gap:10px; margin-bottom:20px;">
    <input id="searchSP" placeholder="🔎 Cari..." onkeyup="delayFilterSP()">
    <select id="tahunSP" onchange="filterSP()">
      <option value="all">Semua Tahun</option>
    </select>
  </div>

  <div class="cards" id="cardContainerSP"></div>
</div>

<!-- ================= SOP ================= -->
<div id="sopArea" style="display:none; margin-top:20px;">
  <h3>Detail : SOP</h3>

  <div style="display:flex; gap:10px; margin-bottom:20px;">
    <input id="searchSOP" placeholder="🔎 Cari..." onkeyup="delayFilterSOP()">
    <select id="tahunSOP" onchange="filterSOP()">
      <option value="all">Semua Tahun</option>
    </select>
  </div>

  <div class="cards" id="cardContainerSOP"></div>
</div>

</div>
</div>

<script>

// ================= COUNT =================
function loadCount(){
  fetch(`/sekretariat?jenis=sk`, {
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(res => {
    document.getElementById("countSK").innerText = res.jumlah.sk;
    document.getElementById("countSP").innerText = res.jumlah.sp;
    document.getElementById("countSOP").innerText = res.jumlah.sop;
  });
}

// ================= NAV =================
function showSurat(){
  mainMenu.style.display="none";
  suratMenu.style.display="grid";
  pegawaiArea.style.display="none";
  magangArea.style.display="none";
}

function showPegawai(){
  mainMenu.style.display="none";
  suratMenu.style.display="none";
  pegawaiArea.style.display="block";
  magangArea.style.display="none";
}

function showMagang(){
  mainMenu.style.display="none";
  suratMenu.style.display="none";
  pegawaiArea.style.display="none";
  magangArea.style.display="block";
}

function showSK(){
  mainMenu.style.display="none";
  suratMenu.style.display="none";
  spArea.style.display="none";
  sopArea.style.display="none";
  skArea.style.display="block";
  pegawaiArea.style.display="none";
  magangArea.style.display="none";
  filterData();
}

function showSP(){
  mainMenu.style.display="none";
  suratMenu.style.display="none";
  skArea.style.display="none";
  sopArea.style.display="none";
  spArea.style.display="block";
  pegawaiArea.style.display="none";
  magangArea.style.display="none";
  filterSP();
}

function showSOP(){
  mainMenu.style.display="none";
  suratMenu.style.display="none";
  skArea.style.display="none";
  spArea.style.display="none";
  sopArea.style.display="block";
  pegawaiArea.style.display="none";
  magangArea.style.display="none";
  filterSOP();
}

function hideAll(){
  mainMenu.style.display="grid";
  suratMenu.style.display="none";
  skArea.style.display="none";
  spArea.style.display="none";
  sopArea.style.display="none";
  pegawaiArea.style.display="none";
  magangArea.style.display="none";
}

// ================= UTIL =================
function openPDF(file){
  window.open('/pdf/' + file, '_blank');
}

function logout(){
  location.href="/logout";
}

// ================= COLOR =================
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

  fetch(`/sekretariat?jenis=sk&search=${search}&tahun=${tahun}`, {
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(res => {

    // 🔥 SIMPAN PILIHAN USER
    let selected = tahun;

    // 🔥 REBUILD DROPDOWN
    select.innerHTML = `<option value="all">Semua Tahun</option>`;
    res.tahunList.forEach(t=>{
      select.innerHTML += `<option value="${t}">${t}</option>`;
    });

    // 🔥 BALIKIN PILIHAN
    select.value = selected;

    container.innerHTML = "";

    if(res.data.length === 0){
      container.innerHTML = "Tidak ada data";
      return;
    }

    res.data.forEach(item=>{
      let color = getColor(item.id);
      container.innerHTML += `
      <div class="card ${color}" onclick="openPDF('${item.file}')">
        <h4>${item.nomor}</h4>
        <p>${item.judul}</p>
        <small>Tahun: ${item.tahun}</small>
      </div>`;
    });

    container.innerHTML += `<div class="card white" onclick="hideAll()">← Kembali</div>`;
  });
}
// ================= FILTER SP =================
function filterSP(){
  let search = document.getElementById("searchSP").value;
  let tahun  = document.getElementById("tahunSP").value;
  let container = document.getElementById("cardContainerSP");
  let select = document.getElementById("tahunSP");

  container.innerHTML = "Loading...";

  fetch(`/sekretariat?jenis=sp&search=${search}&tahun=${tahun}`, {
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(res => {

    let selected = tahun;

    select.innerHTML = `<option value="all">Semua Tahun</option>`;
    res.tahunList.forEach(t=>{
      select.innerHTML += `<option value="${t}">${t}</option>`;
    });

    select.value = selected;

    container.innerHTML = "";

    if(res.data.length === 0){
      container.innerHTML = "Tidak ada data";
      return;
    }

    res.data.forEach(item=>{
      let color = getColor(item.id);
      container.innerHTML += `
      <div class="card ${color}" onclick="openPDF('${item.file}')">
        <h4>${item.nomor}</h4>
        <p>${item.judul}</p>
        <small>Tahun: ${item.tahun}</small>
      </div>`;
    });

    container.innerHTML += `<div class="card white" onclick="hideAll()">← Kembali</div>`;
  });
}

function filterSOP(){
  let search = document.getElementById("searchSOP").value;
  let tahun  = document.getElementById("tahunSOP").value;
  let container = document.getElementById("cardContainerSOP");
  let select = document.getElementById("tahunSOP");

  container.innerHTML = "Loading...";

  fetch(`/sekretariat?jenis=sop&search=${search}&tahun=${tahun}`, {
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
  .then(res => res.json())
  .then(res => {

    let selected = tahun;

    select.innerHTML = `<option value="all">Semua Tahun</option>`;
    res.tahunList.forEach(t=>{
      select.innerHTML += `<option value="${t}">${t}</option>`;
    });

    select.value = selected;

    container.innerHTML = "";

    if(res.data.length === 0){
      container.innerHTML = "Tidak ada data";
      return;
    }

    res.data.forEach(item=>{
      let color = getColor(item.id);
      container.innerHTML += `
      <div class="card ${color}" onclick="openPDF('${item.file}')">
        <h4>${item.nomor}</h4>
        <p>${item.judul}</p>
        <small>Tahun: ${item.tahun}</small>
      </div>`;
    });

    container.innerHTML += `<div class="card white" onclick="hideAll()">← Kembali</div>`;
  });
}

// ================= DELAY =================
let t1,t2,t3;
function delayFilter(){ clearTimeout(t1); t1=setTimeout(filterData,400); }
function delayFilterSP(){ clearTimeout(t2); t2=setTimeout(filterSP,400); }
function delayFilterSOP(){ clearTimeout(t3); t3=setTimeout(filterSOP,400); }

// ================= INIT =================
window.onload = function(){
  loadCount();
};

</script>

</body>
</html>