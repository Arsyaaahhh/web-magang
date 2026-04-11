// ================= TANGGAL =================
const hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
const bulan = [
    "Januari",
    "Februari",
    "Maret",
    "April",
    "Mei",
    "Juni",
    "Juli",
    "Agustus",
    "September",
    "Oktober",
    "November",
    "Desember",
];

const now = new Date();

document.getElementById("tanggalSidebar").innerText =
    hari[now.getDay()] +
    ", " +
    now.getDate() +
    " " +
    bulan[now.getMonth()] +
    " " +
    now.getFullYear();

// ================= SIDEBAR =================
function toggleSidebar() {
    document.querySelector(".sidebar").classList.toggle("hide");
    document.querySelector(".main").classList.toggle("full");
}

// ================= ACTIVE MENU =================
function setActive(el) {
    document
        .querySelectorAll(".menu a")
        .forEach((a) => a.classList.remove("active"));
    el.classList.add("active");

    let menuText = el.innerText.trim();

    if (menuText === "Dashboard Utama") showDashboard();
    if (menuText === "Pemberdayaan Usaha Mikro")
        cardClick("Pemberdayaan Usaha Mikro");
    if (menuText === "Distribusi Perdagangan")
        cardClick("Distribusi Perdagangan");
    if (menuText === "Bidang Koperasi") cardClick("Koperasi");
    if (menuText === "Pembinaan Usaha Perdagangan")
        cardClick("Pembinaan Usaha Perdagangan");
    if (menuText === "UPTD Metrologi Legal") cardClick("UPTD Metrologi Legal");
}

// ================= COUNTER =================
function runCounter() {
    document.querySelectorAll(".counter").forEach((counter) => {
        let target = +counter.dataset.target;
        let count = 0;
        let speed = target / 60;

        let update = setInterval(() => {
            count += speed;
            if (count >= target) {
                counter.innerText = target;
                clearInterval(update);
            } else {
                counter.innerText = Math.floor(count);
            }
        }, 20);
    });
}
runCounter();

// ================= STATE =================
let lastHTML = [];

// ================= CARD CLICK =================
function cardClick(nama) {
    const area = document.getElementById("detailArea");
    const title = document.getElementById("detailTitle");
    const cards = document.getElementById("detailCards");

    document.querySelector(".cards").style.display = "none";
    area.style.display = "block";

    title.innerText = "Detail : " + nama;

    let html = "";

    // ❌ SEKRETARIAT DIHAPUS

    if (nama === "Pemberdayaan Usaha Mikro") {
        html = `
        <div class="card green"><h4>Jumlah UMKM</h4><h3>850</h3></div>
        <div class="card blue"><h4>UMKM Aktif</h4><h3>720</h3></div>
        <div class="card orange"><h4>UMKM Binaan</h4><h3>130</h3></div>
        <div class="card white" onclick="showDashboard()"><h4>← Kembali</h4></div>
        `;
    }

    if (nama === "Distribusi Perdagangan") {
        html = `
        <div class="card orange"><h4>Jumlah Distribusi</h4><h3>42</h3></div>
        <div class="card blue"><h4>Pasar Aktif</h4><h3>25</h3></div>
        <div class="card green"><h4>Gudang Terdaftar</h4><h3>17</h3></div>
        <div class="card white" onclick="showDashboard()"><h4>← Kembali</h4></div>
        `;
    }

    if (nama === "Koperasi") {
        html = `
        <div class="card purple"><h4>Jumlah Koperasi</h4><h3>23</h3></div>
        <div class="card green"><h4>Koperasi Aktif</h4><h3>18</h3></div>
        <div class="card orange"><h4>Koperasi Nonaktif</h4><h3>5</h3></div>
        <div class="card white" onclick="showDashboard()"><h4>← Kembali</h4></div>
        `;
    }

    if (nama === "Pembinaan Usaha Perdagangan") {
        html = `
        <div class="card red"><h4>Program Pembinaan</h4><h3>31</h3></div>
        <div class="card blue"><h4>Peserta</h4><h3>540</h3></div>
        <div class="card green"><h4>Pelatihan Selesai</h4><h3>27</h3></div>
        <div class="card white" onclick="showDashboard()"><h4>← Kembali</h4></div>
        `;
    }

    if (nama === "UPTD Metrologi Legal") {
        html = `
        <div class="card teal"><h4>Jumlah Alat Ukur</h4><h3>68</h3></div>
        <div class="card blue"><h4>Sudah Tera</h4><h3>50</h3></div>
        <div class="card orange"><h4>Belum Tera</h4><h3>18</h3></div>
        <div class="card white" onclick="showDashboard()"><h4>← Kembali</h4></div>
        `;
    }

    cards.innerHTML = html;
}

// ================= SHOW DASHBOARD =================
function showDashboard() {
    document.querySelector(".cards").style.display = "grid";
    document.getElementById("detailArea").style.display = "none";
}
