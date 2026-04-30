<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Pembinaan Usaha Perdagangan</title>

<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>

/* GRID */
.cards{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:18px;
}

/* CARD */
.card{
  padding:16px 18px;
  border-radius:16px;
  min-height:110px;
  display:flex;
  flex-direction:column;
  justify-content:space-between;
  color:white;
  cursor:pointer;
  transition:0.25s;
}

.card.white{
  background:#fff;
  color:#333;
}

/* TABLE */
.table{
  width:100%;
  border-collapse:collapse;
}

.table th{
  background:#0d6efd;
  color:white;
  padding:10px;
}

.table td{
  padding:10px;
  border-bottom:1px solid #e5e7eb;
  color:#000;
}

.table tr:nth-child(even){
  background:#f9fafb;
}

.table tr:hover{
  background:#eef4ff;
}

</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <h2>DINKOPUMDAG</h2>

  <div class="menu">
    <a href="/dashboard"><i class="fas fa-chart-line"></i> Dashboard Utama</a>
    <a href="/sekretariat"><i class="fas fa-user-tie"></i> Bidang Sekretariat</a>
    <a href="/mikro"><i class="fas fa-store"></i> Pemberdayaan Usaha Mikro</a>
    <a href="/perdagangan"><i class="fas fa-truck"></i> Distribusi Perdagangan</a>
    <a href="/koperasi"><i class="fas fa-building"></i> Bidang Koperasi</a>
    <a href="/pembinaan" class="active"><i class="fas fa-briefcase"></i> Pembinaan Usaha Perdagangan</a>
    <a href="/metrologi"><i class="fas fa-balance-scale"></i> UPTD Metrologi Legal</a>
  </div>

  <button onclick="logout()" class="logout-btn">
    <i class="fas fa-sign-out-alt"></i> Keluar
  </button>
</div>

<!-- MAIN -->
<div class="main">

  <div class="header">
    <div class="toggle-btn">☰</div>
    <img src="{{ asset('images/logo.jpg') }}" class="logo">
    <div>
      <b>Pembinaan Usaha Perdagangan</b><br>
      <small>Dinkopumdag Surabaya</small>
    </div>
  </div>

  <div class="container">

    <h2>Detail : Pembinaan Usaha Perdagangan</h2>

    <!-- MENU -->
    <div class="cards" id="menuUtama">

      <div class="card blue" onclick="loadJenis('tdg')">
        <h4>Data TDG</h4>
        <h2 id="countTDG">0</h2>
      </div>

      <div class="card orange" onclick="loadJenis('pengawasan')">
        <h4>Data Pengawasan</h4>
        <h2 id="countPengawasan">0</h2>
      </div>

      <div class="card green" onclick="loadJenis('minol')">
        <h4>Minuman Alkohol</h4>
        <h2 id="countMinol">0</h2>
      </div>

    </div>

    <!-- DATA -->
    <div id="dataArea" style="display:none; margin-top:20px;">
      <h3 id="judulArea"></h3>

      <div class="card" style="overflow-x:auto;">

        <table class="table">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Usaha</th>
              <th>Nomor</th>
              <th>Tanggal</th>
              <th>Status</th>
            </tr>
          </thead>

          <tbody id="containerData"></tbody>

        </table>

      </div>

      <br>

      <div class="card white" onclick="backMenu()" style="text-align:center;">
        ← Kembali
      </div>

    </div>

  </div>

</div>

<script>

// COUNT
function loadCount(){
  fetch('/pembinaan-data',{
    headers:{'X-Requested-With':'XMLHttpRequest'}
  })
  .then(res=>res.json())
  .then(res=>{
    document.getElementById("countTDG").innerText = res.jumlah.tdg;
    document.getElementById("countPengawasan").innerText = res.jumlah.pengawasan;
    document.getElementById("countMinol").innerText = res.jumlah.minol;
  });
}

// NAV
let currentJenis='';

function loadJenis(jenis){
  currentJenis = jenis;

  document.getElementById("menuUtama").style.display="none";
  document.getElementById("dataArea").style.display="block";

  let title={
    tdg:'Data TDG',
    pengawasan:'Data Pengawasan',
    minol:'Data Minol'
  };

  document.getElementById("judulArea").innerText = title[jenis];

  loadData();
}

// LOAD DATA (🔥 FIX UTAMA)
function loadData(){
  let container = document.getElementById("containerData");

  container.innerHTML = "Loading...";

  fetch(`/pembinaan-data?jenis=${currentJenis}`,{
    headers:{'X-Requested-With':'XMLHttpRequest'}
  })
  .then(res=>res.json())
  .then(res=>{

    container.innerHTML="";

    if(res.data.length===0){
      container.innerHTML=`
        <tr>
          <td colspan="5" style="text-align:center;">Tidak ada data</td>
        </tr>
      `;
      return;
    }

    res.data.forEach((item,index)=>{

      container.innerHTML += `
        <tr>
          <td>${index+1}</td>
          <td>${item.nama_usaha}</td>
          <td>${item.nomor_tdg ?? item.nomor_izin ?? '-'}</td>
          <td>${item.tanggal_terbit ?? '-'}</td>
          <td>
            <span style="
              padding:4px 10px;
              border-radius:6px;
              background:${item.status=='Aktif'?'#22c55e':(item.status=='Tidak Aktif'?'#dc2626':'#e5e7eb')};
              color:green;
            ">
              ${item.status ?? '-'}
            </span>
          </td>
        </tr>
      `;
    });

  });
}

// BACK
function backMenu(){
  document.getElementById("menuUtama").style.display="grid";
  document.getElementById("dataArea").style.display="none";
}

// INIT
window.onload = function(){
  loadCount();
}

// LOGOUT
function logout(){
  localStorage.removeItem("login");
  window.location.href="/";
}

</script>

</body>
</html>