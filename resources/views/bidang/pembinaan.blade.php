<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Pembinaan Usaha Perdagangan</title>

<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
/* 1. PERBAIKAN RESPONSIVE SIDEBAR & MAIN */
@media (max-width: 768px) {
    /* Paksa sidebar sembunyi ke kiri */
    .sidebar {
        left: -100% !important;
        position: fixed !important;
        z-index: 9999;
        transition: 0.3s;
    }
    
    /* Munculkan sidebar saat ada class .active */
    .sidebar.active {
        left: 0 !important;
    }

    /* Hilangkan margin kiri konten utama agar tidak terhimpit */
    .main {
        margin-left: 0 !important;
        width: 100% !important;
    }

    /* Penyesuaian Grid Card menjadi 1 kolom */
    .cards, .sub-cards {
        grid-template-columns: 1fr !important;
    }

    /* Penyesuaian Filter */
    .filter-container {
        flex-direction: column;
        align-items: flex-start;
    }
    .filter-input {
        width: 100% !important;
    }
}

/* 2. STYLE UNTUK KONTEN DALAM */
.cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
}

.card {
    padding: 16px 18px;
    border-radius: 16px;
    min-height: 110px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    color: white;
    cursor: pointer;
    transition: 0.25s;
    box-sizing: border-box;
}

.card.blue { background: #0d6efd; }
.card.orange { background: #fd7e14; }
.card.green { background: #198754; }
.card.purple { background: #6f42c1; }

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 8px;
    color: #333;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 15px;
}

.table { width: 100%; border-collapse: collapse; text-align: left; }
.table th { background: #0d6efd; color: white; padding: 12px; white-space: nowrap; }
.table td { padding: 12px; border-bottom: 1px solid #e5e7eb; color: #000; }

.filter-container {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
    background: #fff;
    padding: 10px 15px;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
}

.sub-cards {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
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
    <button onclick="logout()" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Keluar</button>
</div>

<!-- MAIN -->
<div class="main">

    <div class="header">
        <!-- Tombol Hamburger (☰) -->
        <div class="toggle-btn" onclick="toggleMenu()" style="cursor:pointer; font-size: 20px; margin-right: 15px;">☰</div>
        <img src="{{ asset('images/logo.jpg') }}" class="logo" style="width:40px; height:40px;">
        <div>
            <b>Pembinaan Usaha Perdagangan</b><br>
            <small>Dinkopumdag Surabaya</small>
        </div>
    </div>

    <div class="container" style="padding: 20px;">
        <h2 style="margin-bottom: 15px;">Detail : Pembinaan Usaha Perdagangan</h2>

        <!-- AREA 1: MENU UTAMA -->
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

        <!-- AREA 2: SUB-MENU -->
        <div id="subMenuArea" style="display:none;">
            <button class="btn-back" onclick="backToUtama()"><i class="fas fa-arrow-left"></i> Kembali</button>
            <h3 id="judulSubArea" style="margin-bottom:15px;"></h3>
            <div class="sub-cards" id="subCards"></div>
        </div>

        <!-- AREA 3: DATA TABEL -->
        <div id="dataArea" style="display:none;">
            <button class="btn-back" onclick="backToPrevious()"><i class="fas fa-arrow-left"></i> Kembali</button>
            <h3 id="judulArea" style="margin-bottom:15px;"></h3>
            <div class="filter-container">
                <strong>Filter Tahun:</strong>
                <select id="filterTahun" class="filter-input" style="padding:8px; border-radius:8px;" onchange="loadData()">
                    <option value="">-- Semua Tahun --</option>
                </select>
            </div>
            <div class="card" style="padding:0; overflow:hidden; background: white; border: 1px solid #e5e7eb;">
                <div style="overflow-x:auto;">
                    <table class="table">
                        <thead id="tableHeader"></thead>
                        <tbody id="containerData"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let currentJenis = '';
let currentSubJenis = '';

// Fungsi Buka-Tutup Sidebar di HP
function toggleMenu() {
    document.getElementById("sidebar").classList.toggle("active");
}

// Tutup sidebar jika klik di luar (layar HP)
document.addEventListener('click', function(event) {
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.querySelector(".toggle-btn");
    if (window.innerWidth <= 768 && !sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
        sidebar.classList.remove("active");
    }
});

function loadCount(){
    fetch('/pembinaan-data',{ headers:{'X-Requested-With':'XMLHttpRequest'} })
    .then(res=>res.json())
    .then(res=>{
        document.getElementById("countTDG").innerText = res.jumlah.tdg;
        document.getElementById("countPengawasan").innerText = res.jumlah.pengawasan;
        document.getElementById("countMinol").innerText = res.jumlah.minol;
    });
}

function loadJenis(jenis){
    currentJenis = jenis;
    currentSubJenis = ''; 
    document.getElementById("filterTahun").innerHTML = '<option value="">-- Semua Tahun --</option>';
    document.getElementById("menuUtama").style.display = "none";

    if(jenis === 'tdg'){
        document.getElementById("dataArea").style.display = "block";
        document.getElementById("judulArea").innerText = "Data TDG";
        document.getElementById("tableHeader").innerHTML = `<tr><th width="10%">No</th><th>Tahun</th><th>Jumlah</th></tr>`;
        loadData();
    } else if(jenis === 'pengawasan'){
        document.getElementById("subMenuArea").style.display = "block";
        document.getElementById("judulSubArea").innerText = "Kategori Pengawasan";
        document.getElementById("subCards").innerHTML = `
            <div class="card blue" onclick="loadSubJenis('Toko Swalayan')"><h4>Toko Swalayan</h4></div>
            <div class="card purple" onclick="loadSubJenis('Gudang Minuman Beralkohol')"><h4>Gudang</h4></div>`;
    } else if(jenis === 'minol'){
        document.getElementById("subMenuArea").style.display = "block";
        document.getElementById("judulSubArea").innerText = "Golongan Alkohol";
        document.getElementById("subCards").innerHTML = `
            <div class="card green" onclick="loadSubJenis('Golongan B')"><h4>Golongan B</h4></div>
            <div class="card orange" onclick="loadSubJenis('Golongan C')"><h4>Golongan C</h4></div>`;
    }
}

function loadSubJenis(subJenis){
    currentSubJenis = subJenis;
    document.getElementById("subMenuArea").style.display = "none";
    document.getElementById("dataArea").style.display = "block";
    let judul = currentJenis === 'pengawasan' ? 'Pengawasan' : 'Alkohol';
    document.getElementById("judulArea").innerText = `${judul} - ${subJenis}`;
    document.getElementById("tableHeader").innerHTML = `<tr><th width="10%">No</th><th>Tahun</th><th>Jumlah</th></tr>`;
    loadData();
}

function loadData(){
    let container = document.getElementById("containerData");
    let filterSelect = document.getElementById("filterTahun");
    let tahunTerpilih = filterSelect.value;
    container.innerHTML = "<tr><td colspan='3' align='center'>Memuat...</td></tr>";

    fetch(`/pembinaan-data?jenis=${currentJenis}&sub_jenis=${currentSubJenis}&tahun=${tahunTerpilih}`,{
        headers:{'X-Requested-With':'XMLHttpRequest'}
    })
    .then(res=>res.json())
    .then(res=>{
        container.innerHTML = "";
        if(res.data.length === 0){
            container.innerHTML = `<tr><td colspan="3" align="center">Tidak ada data.</td></tr>`;
        } else {
            res.data.forEach((item, index)=>{
                let satuan = currentJenis === 'tdg' ? 'Dokumen' : (currentJenis === 'pengawasan' ? '' : 'Penjual');
                container.innerHTML += `<tr><td>${index + 1}</td><td>${item.tahun}</td><td><b>${item.jumlah}</b> ${satuan}</td></tr>`;
            });
        }
        if (tahunTerpilih === "") {
            filterSelect.innerHTML = '<option value="">-- Semua Tahun --</option>'; 
            res.tahun_list.forEach(tahun => { filterSelect.innerHTML += `<option value="${tahun}">${tahun}</option>`; });
        }
    });
}

function backToUtama(){
    document.getElementById("subMenuArea").style.display = "none";
    document.getElementById("menuUtama").style.display = "grid";
}

function backToPrevious(){
    document.getElementById("dataArea").style.display = "none";
    if(currentJenis === 'tdg') document.getElementById("menuUtama").style.display = "grid";
    else document.getElementById("subMenuArea").style.display = "block";
}

window.onload = loadCount;
function logout(){ localStorage.removeItem("login"); window.location.href="/"; }
</script>
</body>
</html>