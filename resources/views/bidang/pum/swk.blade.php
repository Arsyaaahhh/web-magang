<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pemberdayaan Usaha Mikro</title>

    <link rel="stylesheet" href="{{ asset('css/pum.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link 
        rel="stylesheet" 
        href="https://unpkg.com/leaflet/dist/leaflet.css"
    />

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-x: hidden;
        }

        /* OVERLAY */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }

        .overlay.active {
            display: block;
        }

        .swkcard-image {
            position: relative;
            height: 290px;
        }

        .swkcard-image img {
            width: 100%;
            height: 100%;
            opacity: 0.75;
            object-fit: cover;
            display: block;
        }

        /* overlay gradient */
        .swkcard-image::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to top,
                rgba(24,34,52,0.95) 20%,
                rgba(24,34,52,0.4) 50%,
                rgba(24,34,52,0.05) 75%
            );
        }

        /* content */
        .swkcard-content {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 18px;
            z-index: 2;
            color: white;
        }

        .top-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            gap: 10px;
        }

        .title {
            font-size: 16px;
            font-weight: 600;
            line-height: 1.2;
        }

        .description {
            color: rgba(255,255,255,0.8);
            font-size: 11px;
            line-height: 1.6;
            margin-bottom: 8px;
        }

        .tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .tag {
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 6px 10px;
            font-size: 12px;
            color: white;
        }

        .button {
            width: 100%;
            border: none;
            border-radius: 16px;
            padding: 12px;
            background: white;
            color: black;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.3s;
        }

        .button:hover {
            transform: translateY(-2px);
        }

        .swk-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 7px;
        }

        .swkcard {
            width: 220px;
            border-radius: 22px;
            overflow: hidden;
            position: relative;
            background: #253047;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            flex-shrink: 0;
            transition: 0.3s;
        }

        .swkcard:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 14px rgba(0,0,0,0.12);
        }

        .detail-modal {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            padding: 20px;
        }

        .detail-box {
            width: 100%;
            max-width: 800px;
            background: white;
            border-radius: 24px;
            padding: 30px;
            position: relative;
            animation: popup 0.25s ease;
            max-height: 90vh;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 transparent;
        }

        .detail-box::-webkit-scrollbar {
            width: 8px;
        }

        .detail-box::-webkit-scrollbar-track {
            background: transparent;
        }

        .detail-box::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 20px;
        }

        .detail-box::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        @keyframes popup {
            from {
                transform: scale(0.9);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 30px;
            cursor: pointer;
        }

        .detail-box h2 {
            margin-bottom: 15px;
        }

        .detail-item {
            margin-bottom: 25px;
        }

        .detail-item p {
            margin-top: 5px;
            color: #555;
            line-height: 1.6;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 10px;
        }

        .detail-card {
            background: #f5f5f5;
            border-radius: 18px;
            padding: 20px;
            text-align: center;
        }

        .detail-card.full {
            grid-column: 1 / -1;
        }

        .detail-card h4 {
            margin-bottom: 10px;
            color: #666;
        }

        .detail-card h2 {
            color: #111;
        }

        .filter {
            display: flex;
            gap: 10px;
            margin-bottom: 5px;
        }

        .filter input,
        .filter select {
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #d1d5db;
        }

        .btn {
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 14px;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .empty-data {
            width: 100%;
            height: 270px;
            padding: 60px 20px;
            background: #f4f6f9;
            border-radius: 24px;
            text-align: center;
        }

        .empty-data p {
            font-size: 16px;
            margin-bottom: 10px;
            color: #111827;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

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
            text-decoration: none;
            margin-bottom: 5px;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }

        /* =========================================
           CSS RESPONSIVE (MEDIA QUERIES)
           ========================================= */

        /* Untuk Tablet / Layar Menengah */
        @media (max-width: 992px) {
            .swkcard {
                width: calc(33.33% - 14px);
            }
        }

        /* Untuk Tablet Kecil dan HP Horizontal */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -100%;
                transition: left 0.3s ease;
                z-index: 1000;
            }

            .sidebar.active {
                left: 0 !important;
            }

            .main {
                width: 100% !important;
                margin-left: 0 !important;
            }

            .top {
                flex-direction: column-reverse;
                align-items: flex-start;
                gap: 15px;
            }

            .filter {
                flex-direction: column;
                width: 100%;
            }

            .filter input,
            .filter select,
            .filter button {
                width: 100%;
            }

            .swk-wrapper {
                justify-content: center;
            }

            .swkcard {
                width: calc(50% - 10px);
            }
        }

        /* Untuk HP Layar Kecil (Potret) */
        @media (max-width: 576px) {
            .swkcard {
                width: 100%;
            }

            .detail-grid {
                grid-template-columns: 1fr;
            }

            .detail-box {
                padding: 20px;
                margin: 15px;
            }
        }

        .map-wrapper {
            width: 100%;
            margin-bottom: 7px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.06);
        }

        #map {
            width: 100%;
            height: 400px;
            border-radius: 10px;
            overflow: hidden;
        }
    </style>
</head>

<body>

    <div class="overlay" onclick="toggleSidebar()"></div>

    <div class="sidebar">
        <h2>DINKOPUMDAG</h2>

        <div id="tanggalSidebar" style="margin:10px 0; font-size:14px; color:#fff;"></div>

        <div class="menu">
            <a href="/dashboard">
                <i class="fas fa-chart-line"></i> Dashboard Utama
            </a>

            <a href="/sekretariat">
                <i class="fas fa-user-tie"></i> Bidang Sekretariat
            </a>

            <a href="/mikro" class="active">
                <i class="fas fa-store"></i> Pemberdayaan Usaha Mikro
            </a>

            <a href="/perdagangan">
                <i class="fas fa-truck"></i> Distribusi Perdagangan
            </a>

            <a href="/koperasi">
                <i class="fas fa-building"></i> Bidang Koperasi
            </a>

            <a href="/pembinaan">
                <i class="fas fa-briefcase"></i> Pembinaan Usaha Perdagangan
            </a>

            <a href="/metrologi">
                <i class="fas fa-balance-scale"></i> UPTD Metrologi Legal
            </a>
        </div>

        <button onclick="logout()" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Keluar
        </button>
    </div>

    <div class="main">

        <div class="header">
            <div class="toggle-btn" onclick="toggleSidebar()">☰</div>

            <img src="{{ asset('images/logo.jpg') }}" class="logo">

            <div>
                <b>Pemberdayaan Usaha Mikro</b><br>
                <small>Dinkopumdag Surabaya</small>
            </div>
        </div>

        <div class="container">

            <h2>Sentra Wisata Kuliner</h2>

            <div class="top">

                <form method="GET" style="width: 100%;">
                    <div class="filter">

                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Cari SWK" 
                            value="{{ request('search') }}"
                        >

                        <select id="kecamatan" name="kecamatan_id">
                            <option value="">Semua Kecamatan</option>

                            @foreach($kecamatan as $k)
                                <option 
                                    value="{{ $k->ID_KECAMATAN }}"
                                    {{ request('kecamatan_id') == $k->ID_KECAMATAN ? 'selected' : '' }}
                                >
                                    {{ $k->NM_KECAMATAN }}
                                </option>
                            @endforeach
                        </select>

                        <select id="kelurahan" name="kelurahan_id">
                            <option value="">Semua Kelurahan</option>
                        </select>

                        <button 
                            type="submit" 
                            class="btn" 
                            style="background:#0d6efd; color:white;"
                        >
                            Filter
                        </button>

                    </div>
                </form>

                <a href="/mikro" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

            </div>

            <!-- MAIN MENU -->
            <div class="map-wrapper">

                <!-- 
                <h3 style="margin-bottom:15px;">
                    Persebaran Sentra Usaha
                </h3> 
                -->

                <div id="map"></div>

            </div>

            <div class="swk-wrapper">

                @forelse($swks as $item)

                    <div class="swkcard">

                        <div class="swkcard-image">

                            <img 
                                src="{{ $item->foto 
                                    ? asset('storage/' . $item->foto) 
                                    : 'https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?q=80&w=1200&auto=format&fit=crop' 
                                }}" 
                                alt="{{ $item->nama_swk }}"
                            >

                            <div class="swkcard-content">

                                <div class="top-row">
                                    <h2 class="title">
                                        {{ $item->nama_swk }}
                                    </h2>
                                </div>

                                <p class="description">
                                    Luas: {{ $item->luas }} m² |
                                    Kapasitas: {{ $item->kapasitas }} orang
                                </p>

                                <div class="tags">

                                    <div class="tag">
                                        Pedagang: {{ $item->jumlah_pedagang }}
                                    </div>

                                    <div class="tag">
                                        Stan: {{ $item->jumlah_stan }}
                                    </div>

                                </div>

                                <a href="#">

                                    <button 
                                        class="button"
                                        onclick="showDetail(
                                            '{{ $item->nama_swk }}',
                                            '{{ $item->alamat }}',
                                            '{{ $item->jumlah_pedagang }}',
                                            '{{ $item->jumlah_stan }}',
                                            '{{ $item->stan_belum_terisi }}',
                                            '{{ $item->latitude }}',
                                            '{{ $item->longitude }}'
                                        )"
                                    >
                                        Detail
                                    </button>

                                </a>

                            </div>
                        </div>

                    </div>

                @empty

                    <div class="empty-data">
                        <p>Tidak Ada Data</p>
                    </div>

                @endforelse

            </div>

            <div class="detail-modal" id="detailModal">

                <div class="detail-box">

                    <span class="close-btn" onclick="closeDetail()">
                        &times;
                    </span>

                    <h2 id="detailNama"></h2>

                    <div class="detail-item">
                        <b>Alamat:</b>
                        <p id="detailAlamat"></p>
                    </div>

                    <div class="detail-grid">

                        <div class="detail-card">
                            <h4>Total Pedagang</h4>
                            <h2 id="detailPedagang"></h2>
                        </div>

                        <div class="detail-card">
                            <h4>Total Stan</h4>
                            <h2 id="detailStan"></h2>
                        </div>

                        <div class="detail-card full">
                            <h4>Stan Belum Terisi</h4>
                            <h2 id="detailKosong"></h2>
                        </div>

                    </div>

                    <div class="detail-item">
                        <b>Koordinat:</b>
                        <p id="detailKoordinat"></p>
                    </div>

                    <div class="detail-item">

                        <iframe
                            id="mapsFrame"
                            width="100%"
                            height="280"
                            style="border:0; border-radius:16px;"
                            loading="lazy"
                            allowfullscreen>
                        </iframe>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
            document.querySelector('.overlay').classList.toggle('active');
        }

        // filter
        document.addEventListener('DOMContentLoaded', function () {

            let kecamatan = document.getElementById('kecamatan');
            let kelurahan = document.getElementById('kelurahan');

            let selectedKelurahan = "{{ request('kelurahan_id') }}";

            function loadKelurahan(kecamatan_id, selected = null) {

                if (!kecamatan_id) {
                    kelurahan.innerHTML = '<option value="">Semua Kelurahan</option>';
                    return;
                }

                fetch('/get-kelurahan/' + kecamatan_id)
                    .then(res => res.json())
                    .then(data => {

                        kelurahan.innerHTML = '<option value="">Semua Kelurahan</option>';

                        data.forEach(item => {

                            let isSelected =
                                item.ID_KELURAHAN == selected
                                ? 'selected'
                                : '';

                            kelurahan.innerHTML += `
                                <option 
                                    value="${item.ID_KELURAHAN}" 
                                    ${isSelected}
                                >
                                    ${item.NM_KELURAHAN}
                                </option>
                            `;
                        });
                    });
            }

            if (kecamatan.value) {
                loadKelurahan(kecamatan.value, selectedKelurahan);
            }

            kecamatan.addEventListener('change', function () {
                loadKelurahan(this.value);
            });
        });

        // detail modal
        function showDetail(
            nama,
            alamat,
            pedagang,
            stan,
            kosong,
            latitude,
            longitude
        ) {
            document.getElementById('detailNama').innerText = nama;
            document.getElementById('detailAlamat').innerText = alamat;
            document.getElementById('detailPedagang').innerText = pedagang;
            document.getElementById('detailStan').innerText = stan;
            document.getElementById('detailKosong').innerText = kosong;

            document.getElementById('detailKoordinat').innerText =
                latitude + ', ' + longitude;

            // iframe maps
            document.getElementById('mapsFrame').src =
                `https://maps.google.com/maps?q=${latitude},${longitude}&z=15&output=embed`;

            document.getElementById('detailModal').style.display = 'flex';
        }

        function closeDetail() {
            document.getElementById('detailModal').style.display = 'none';
        }

        // klik luar modal untuk close
        window.onclick = function(e) {

            const modal = document.getElementById('detailModal');

            if (e.target === modal) {
                modal.style.display = 'none';
            }
        }

        // ================= MAP PERSEBARAN =================

        // default view Surabaya
        let map = L.map('map').setView([-7.2575, 112.7521], 12);

        // tile
        L.tileLayer(
            'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            {
                attribution: '&copy; OpenStreetMap'
            }
        ).addTo(map);

        // data sentra usaha dari Laravel
        let sentraUsaha = @json($swks);

        // loop marker
        sentraUsaha.forEach(item => {

            // skip jika tidak ada koordinat
            if (!item.latitude || !item.longitude) {
                return;
            }

            // marker
            let marker = L.marker([
                parseFloat(item.latitude),
                parseFloat(item.longitude)
            ]).addTo(map);

            // popup
            marker.bindPopup(`
                <div style="width:220px;">

                    <img 
                        src="${item.foto 
                            ? '/storage/' + item.foto
                            : 'https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?q=80&w=1200&auto=format&fit=crop'}"
                        style="
                            width:100%;
                            height:120px;
                            object-fit:cover;
                            border-radius:10px;
                            margin-bottom:10px;
                        "
                    >

                    <h4 style="margin-bottom:8px;">
                        ${item.nama_swk}
                    </h4>

                    <p style="font-size:12px; color:#555;">
                        ${item.alamat}
                    </p>

                </div>
            `);

        });

        // logout
        function logout() {

            Swal.fire({
                title: 'Logout?',
                text: "Kamu akan keluar",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0d6efd',
                confirmButtonText: 'Ya, logout'
            }).then((result) => {

                if (result.isConfirmed) {

                    localStorage.removeItem("login");
                    window.location.href = "/logout";
                }
            });
        }

        // LOGIN CHECK
        if (localStorage.getItem("login") !== "true") {
            window.location.href = "/";
        }
    </script>

</body>
</html>