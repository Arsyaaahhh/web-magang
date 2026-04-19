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
<div class="cards" id="menuUtama">

  <div class="card blue" onclick="showSK()">
    <h4>SK Kepala Dinas</h4>
    <p>Arsip keputusan kepala dinas</p>
    <h2 id="countSK">0</h2> <!-- 🔥 TAMBAHAN -->
  </div>

  <div class="card green" onclick="showSP()">
    <h4>Standar Pelayanan</h4>
    <h2 id="countSP">0</h2> <!-- 🔥 TAMBAHAN -->
  </div>

  <div class="card orange" onclick="showSOP()">
    <h4>SOP</h4>
    <h2 id="countSOP">0</h2> <!-- 🔥 TAMBAHAN -->
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
function showSK(){
  menuUtama.style.display="none";
  spArea.style.display="none";
  sopArea.style.display="none";
  skArea.style.display="block";
  filterData();
}

function showSP(){
  menuUtama.style.display="none";
  skArea.style.display="none";
  sopArea.style.display="none";
  spArea.style.display="block";
  filterSP();
}

function showSOP(){
  menuUtama.style.display="none";
  skArea.style.display="none";
  spArea.style.display="none";
  sopArea.style.display="block";
  filterSOP();
}

function hideAll(){
  menuUtama.style.display="grid";
  skArea.style.display="none";
  spArea.style.display="none";
  sopArea.style.display="none";
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