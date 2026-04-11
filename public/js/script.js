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
    cards.innerHTML = html;
}

// ================= SHOW DASHBOARD =================
function showDashboard() {
    document.querySelector(".cards").style.display = "grid";
    document.getElementById("detailArea").style.display = "none";
}
