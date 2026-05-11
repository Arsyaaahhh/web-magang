<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>UPTD Metrologi Legal</title>

<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
/* RESPONSIVE SIDEBAR & MAIN */
@media (max-width: 768px) {
    .sidebar { left: -100% !important; position: fixed !important; z-index: 9999; transition: 0.3s; }
    .sidebar.active { left: 0 !important; }
    .main { margin-left: 0 !important; width: 100% !important; }
    .cards { grid-template-columns: 1fr !important; }
    .filter-container { flex-direction: column; align-items: flex-start; }
    .filter-input { width: 100% !important; }
}

/* STYLE UNTUK KONTEN DALAM */
.cards { display: grid; grid-template-columns: repeat(2, 1fr); gap: 18px; }
.card { padding: 16px 18px; border-radius: 16px; min-height: 110px; display: flex; flex-direction: column; justify-content: space-between; color: white; cursor: pointer; transition: 0.25s; box-sizing: border-box; }
.card.blue { background: #0d6efd; }
.card.teal { background: #20c997; }
.card:hover { transform: translateY(-5px); box-shadow: 0 8px 15px rgba(0,0,0,0.1); }

.btn-back { display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; background: #fff; border: 1px solid #ccc; border-radius: 8px; color: #333; cursor: pointer; font-size: 14px; font-weight: 500; margin-bottom: 15px; transition: 0.2s; }
.btn-back:hover { background: #f8fafc; }

.table { width: 100%; border-collapse: collapse; text-align: left; }
.table th { background: #0d6efd; color: white; padding: 12px; white-space: nowrap; }
.table td { padding: 12px; border-bottom: 1px solid #e5e7eb; color: #000; }

.filter-container { display: flex; align-items: center; gap: 10px; margin-bottom: 15px; background: #fff; padding: 10px 15px; border-radius: 12px; border: 1px solid #e5e7eb; flex-wrap: wrap; }
.filter-input { padding: 8px 12px; border-radius: 8px; border: 1px solid #d1d5db; outline: none; background: white; font-size: 14px; min-width: 160px; }
.filter-input:focus { border-color: #0d6efd; }
</style>
</head>

<body>

<div class="sidebar" id="sidebar">
    <h2 style="text-align: center;">DINKOPUMDAG</h2>

    <div id="tanggalSidebar" style="margin-bottom:20px; font-size:13px; color:#e0e7ff; text-align: center; font-weight: 400;"></div>
    
    <div class="menu">
        <a href="/dashboard"><i class="fas fa-chart-line"></i> Dashboard Utama</a>
        <a href="/sekretariat"><i class="fas fa-user-tie"></i> Bidang Sekretariat</a>
        <a href="/mikro"><i class="fas fa-store"></i> Pemberdayaan Usaha Mikro</a>
        <a href="/perdagangan"><i class="fas fa-truck"></i> Distribusi Perdagangan</a>
        <a href="/koperasi"><i class="fas fa-building"></i> Bidang Koperasi</a>
        <a href="/pembinaan"><i class="fas fa-briefcase"></i> Pembinaan Usaha Perdagangan</a>
        <a href="/metrologi" class="active"><i class="fas fa-balance-scale"></i> UPTD Metrologi Legal</a>
    </div>
    <button onclick="logout()" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Keluar</button>
</div>

<div class="main">

    <div class="header">
        <div class="toggle-btn" onclick="toggleMenu()" style="cursor:pointer; font-size: 20px; margin-right: 15px;">☰</div>
        <img src="{{ asset('images/logo.jpg') }}" class="logo" style="width:40px; height:40px;">
        <div>
            <b>UPTD Metrologi Legal</b><br>
            <small>Dinkopumdag Surabaya</small>
        </div>
    </div>

    <div class="container" style="padding: 20px;">
        <h2 style="margin-bottom: 15px;">Detail : UPTD Metrologi Legal</h2>

        <div class="cards" id="menuUtama">
            <div class="card blue" onclick="loadJenis('alat')">
                <h4>Alat-alat Ukur, Takar, Timbang, dan Perlengkapannya (UTTP)</h4>
            </div>
            <div class="card teal" onclick="loadJenis('reparasi')">
                <h4>Tanda Daftar Reparasi</h4>
            </div>
        </div>

        <div id="dataArea" style="display:none;">
            <button class="btn-back" onclick="backToUtama()"><i class="fas fa-arrow-left"></i> Kembali</button>
            <h3 id="judulArea" style="margin-bottom:15px;"></h3>
            
            <div class="filter-container">
                <div>
                    <strong style="display:block; font-size:12px; margin-bottom:4px; color:#6b7280;">Filter Tahun</strong>
                    <select id="filterTahun" class="filter-input" onchange="loadData()">
                        <option value="">-- Semua Tahun --</option>
                    </select>
                </div>
                
                <div id="wrapperKecamatan" style="display:none;">
                    <strong style="display:block; font-size:12px; margin-bottom:4px; color:#6b7280;">Filter Kecamatan</strong>
                    <select id="filterKecamatan" class="filter-input" onchange="loadData()">
                        <option value="">-- Semua Kecamatan --</option>
                    </select>
                </div>
            </div>

            <div class="card" style="padding:0; overflow:hidden; background: white; border: 1px solid #e5e7eb; cursor: default;">
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

// Fungsi Buka-Tutup Sidebar di HP
function toggleMenu() { document.getElementById("sidebar").classList.toggle("active"); }

document.addEventListener('click', function(event) {
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.querySelector(".toggle-btn");
    if (window.innerWidth <= 768 && !sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
        sidebar.classList.remove("active");
    }
});

// Load total data untuk card
function loadCount(){
    fetch('/metrologi-data',{ headers:{'X-Requested-With':'XMLHttpRequest'} })
    .then(res=>res.json())
    .then(res=>{
        let countAlat = document.getElementById("countAlat");
        let countReparasi = document.getElementById("countReparasi");
        if(countAlat) countAlat.innerText = res.jumlah.alat;
        if(countReparasi) countReparasi.innerText = res.jumlah.reparasi;
    })
    .catch(err => console.error("Error mengambil data count:", err));
}

// Munculkan tabel berdasarkan jenis (alat atau reparasi)
function loadJenis(jenis){
    currentJenis = jenis;
    
    // Reset Filter
    document.getElementById("filterTahun").innerHTML = '<option value="">-- Semua Tahun --</option>';
    document.getElementById("filterKecamatan").innerHTML = '<option value="">-- Semua Kecamatan --</option>';
    
    document.getElementById("menuUtama").style.display = "none";
    document.getElementById("dataArea").style.display = "block";

    if(jenis === 'alat'){
        document.getElementById("wrapperKecamatan").style.display = "none";
        document.getElementById("judulArea").innerText = "Alat-alat Ukur, Takar, Timbang, dan Perlengkapannya (UTTP)";
        document.getElementById("tableHeader").innerHTML = `<tr><th width="10%">No</th><th>Tahun</th><th>Jumlah Alat Ukur</th></tr>`;
    } else if(jenis === 'reparasi'){
        document.getElementById("wrapperKecamatan").style.display = "block";
        document.getElementById("judulArea").innerText = "Data Tanda Daftar Reparasi (TDR)";
        document.getElementById("tableHeader").innerHTML = `<tr><th width="5%">No</th><th>Tahun</th><th>Kecamatan</th><th>Jumlah</th></tr>`;
    }
    
    loadData();
}

// Ambil data dari server untuk diisi ke tabel
function loadData(){
    let container = document.getElementById("containerData");
    let filterTahun = document.getElementById("filterTahun");
    let filterKecamatan = document.getElementById("filterKecamatan");
    
    let tahunTerpilih = filterTahun.value;
    let kecamatanTerpilih = filterKecamatan.value;
    
    container.innerHTML = "<tr><td colspan='4' align='center'>Memuat...</td></tr>";

    fetch(`/metrologi-data?jenis=${currentJenis}&tahun=${tahunTerpilih}&kecamatan=${kecamatanTerpilih}`,{
        headers:{'X-Requested-With':'XMLHttpRequest'}
    })
    .then(res=>res.json())
    .then(res=>{
        container.innerHTML = "";
        if(res.data.length === 0){
            container.innerHTML = `<tr><td colspan="${currentJenis === 'reparasi' ? '4' : '3'}" align="center" style="padding:20px;">Tidak ada data.</td></tr>`;
        } else {
            res.data.forEach((item, index)=>{
                let satuan = currentJenis === 'alat' ? 'Unit' : 'Lokasi';
                
                // Render baris (Dengan atau tanpa kecamatan)
                let row = `<tr><td>${index + 1}</td><td>${item.tahun}</td>`;
                if(currentJenis === 'reparasi') {
                    row += `<td>${item.kecamatan ?? '-'}</td>`;
                }
                row += `<td><b>${item.jumlah}</b> ${satuan}</td></tr>`;
                
                container.innerHTML += row;
            });
        }
        
        // Isi dropdown tahun jika sedang reset
        if (tahunTerpilih === "") {
            filterTahun.innerHTML = '<option value="">-- Semua Tahun --</option>'; 
            if(res.tahun_list) {
                res.tahun_list.forEach(tahun => { filterTahun.innerHTML += `<option value="${tahun}">${tahun}</option>`; });
            }
        }

        // Isi dropdown kecamatan jika sedang reset (Khusus reparasi)
        if (kecamatanTerpilih === "" && currentJenis === 'reparasi') {
            filterKecamatan.innerHTML = '<option value="">-- Semua Kecamatan --</option>'; 
            if(res.kecamatan_list) {
                res.kecamatan_list.forEach(kec => { filterKecamatan.innerHTML += `<option value="${kec}">${kec}</option>`; });
            }
        }
    })
    .catch(err => {
        console.error("Error mengambil data tabel:", err);
        container.innerHTML = `<tr><td colspan="4" align="center" style="color:red;">Gagal memuat data. Periksa koneksi.</td></tr>`;
    });
}

// Kembali ke menu card utama
function backToUtama(){
    document.getElementById("dataArea").style.display = "none";
    document.getElementById("menuUtama").style.display = "grid";
    
    // Reset Filter value
    document.getElementById("filterTahun").value = "";
    document.getElementById("filterKecamatan").value = "";
}

// Menjalankan fungsi saat halaman selesai dimuat
document.addEventListener('DOMContentLoaded', function() {
    loadCount();
    
    // Tampilkan Hari, Tanggal, Bulan, Tahun di Sidebar
    const elTanggal = document.getElementById('tanggalSidebar');
    if (elTanggal) {
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        elTanggal.textContent = now.toLocaleDateString('id-ID', options);
    }
});

function logout(){ localStorage.removeItem("login"); window.location.href="/logout"; }

if (localStorage.getItem("login") !== "true") { window.location.href = "/"; }
</script>
</body>
</html>