<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pemberdayaan Usaha Mikro</title>

  <!-- Menggunakan CSS asli Anda -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    .d-none { display: none !important; }

    /* ======================================================= */
    /* TOMBOL KEMBALI KECIL */
    /* ======================================================= */
    .btn-back-small {
        background-color: #6c757d; color: white; border: none; padding: 6px 12px; border-radius: 6px;
        cursor: pointer; font-size: 13px; font-family: 'Poppins', sans-serif; display: inline-flex;
        align-items: center; gap: 5px; transition: 0.2s; margin-bottom: 15px; font-weight: 500;
    }
    .btn-back-small:hover { background-color: #5a6268; }

    /* ======================================================= */
    /* GAYA TABEL & FILTER PERSIS SEPERTI DASHBOARD ADMIN      */
    /* ======================================================= */
    .filter { display: flex; gap: 10px; margin-bottom: 15px; align-items: center; }
    .filter input, .filter select { 
        padding: 8px; border-radius: 6px; border: 1px solid #d1d5db; 
        font-family: 'Poppins', sans-serif; font-size: 14px; min-width: 200px; outline: none;
    }
    
    table { width: 100%; border-collapse: collapse; border: 1px solid #e5e7eb; color: #333; white-space: nowrap; }
    th { padding: 12px; background: #0d6efd; color: white; font-size: 13px; text-align: left; border-bottom: 2px solid #0b5ed7; }
    td { padding: 12px; font-size: 14px; border-bottom: 1px solid #e5e7eb; }
    tbody tr:nth-child(even) { background: #f9fafb; }
    tr:hover { background: #eef4ff; }

    /* ======================================================= */
    /* RESPONSIVE UNTUK HP / MOBILE (Tanpa merubah UI Desktop) */
    /* ======================================================= */
    @media (max-width: 768px) {
        /* Kartu jadi ke bawah */
        .cards {
            display: grid;
            grid-template-columns: 1fr !important;
            gap: 15px;
        }
        /* Filter jadi ke bawah */
        .filter {
            flex-direction: column;
            align-items: flex-start;
        }
        .filter select {
            width: 100%;
        }
        /* Sidebar responsif (Sembunyi di HP) */
        .sidebar {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            position: fixed;
            z-index: 1000;
            height: 100vh;
        }
        /* Class tambahan untuk memunculkan sidebar via JS */
        .sidebar.active {
            transform: translateX(0);
        }
        /* Main content penuhi layar di HP */
        .main {
            margin-left: 0 !important;
            width: 100% !important;
        }
        .header { padding: 15px; }
        .container { padding: 15px; }
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
    <a href="/sekretariat"><i class="fas fa-user-tie"></i> Bidang Sekretariat</a>
    <a href="/mikro" class="active"><i class="fas fa-store"></i> Pemberdayaan Usaha Mikro</a>
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

  <!-- HEADER -->
  <div class="header">
    <div class="toggle-btn" onclick="toggleSidebar()">☰</div>
    <img src="{{ asset('images/logo.jpg') }}" class="logo">
    <div>
      <b>Pemberdayaan Usaha Mikro</b><br>
      <small>Dinkopumdag Surabaya</small>
    </div>
  </div>

  <!-- CONTENT -->
  <div class="container">

    <h2 id="pageTitle" style="margin-bottom: 20px;">Pilih Kategori : Pemberdayaan Usaha Mikro</h2>

    <!-- ============================================== -->
    <!-- TAMPILAN AWAL : PILIHAN UMKM ATAU SWK -->
    <!-- ============================================== -->
    <div id="menuSelection" class="cards">
        <!-- Card Pilihan UMKM -->
        <div class="card blue" onclick="showData('umkm')" style="cursor: pointer;">
            <h4>UMKM</h4>
            <p>Informasi Umkm</p>
        </div>

        <!-- Card Pilihan SWK -->
        <div class="card orange" onclick="showData('swk')" style="cursor: pointer;">
            <h4>Sentra Wista Kuliner</h4>
            <p>Informasi Sentra Wista Kuliner</p>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- KONTEN DATA UMKM -->
    <!-- ============================================== -->
    <div id="content-umkm" class="d-none">

        <!-- AREA TABEL & FILTER UMKM -->
        <div class="card" style="margin-top: 20px; overflow-x: auto;">
            
            <!-- TOMBOL KEMBALI KECIL DI ATAS FILTER -->
            <button class="btn-back-small" onclick="goBack()">
                <i class="fas fa-arrow-left"></i> Kembali ke Pilihan
            </button>

            <!-- FILTER KECAMATAN -->
            <div class="filter">
                <i class="fas fa-filter" style="color: #6b7280;"></i>
                <select id="filterKecamatanUmkm" onchange="fetchData('umkm')">
                    <option value="">Semua Kecamatan</option>
                    @foreach($kecamatan as $k)
                        <option value="{{ $k->ID_KECAMATAN }}">{{ $k->NM_KECAMATAN }}</option>
                    @endforeach
                </select>
                <span id="loadingUmkm" style="display: none; font-size: 13px; color: #0d6efd; padding-top: 2px;">
                    <i class="fas fa-spinner fa-spin"></i> Memuat data...
                </span>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kecamatan</th>
                        <th>Kelurahan</th>
                        <th>Total UMKM</th>
                        <th>Binaan</th>
                        <th>Halal</th>
                        <th>Merek</th>
                        <th>NIB</th>
                        <th>Peken</th>
                        <th>Padat Karya</th>
                    </tr>
                </thead>
                <tbody id="tableBodyUmkm">
                    @forelse($umkm as $index => $d)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $d->kelurahan->kecamatan->NM_KECAMATAN ?? '-' }}</td>
                        <td>{{ $d->kelurahan->NM_KELURAHAN ?? '-' }}</td>
                        <td>{{ $d->total_umkm }}</td>
                        <td>{{ $d->umkm_binaan }}</td>
                        <td>{{ $d->sertifikasi_halal }}</td>
                        <td>{{ $d->sertifikasi_merek }}</td>
                        <td>{{ $d->nib }}</td>
                        <td>{{ $d->peken }}</td>
                        <td>{{ $d->padat_karya }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="10" style="text-align: center;">Tidak ada data UMKM</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ============================================== -->
    <!-- KONTEN DATA SWK -->
    <!-- ============================================== -->
    <div id="content-swk" class="d-none">
    

        <!-- AREA TABEL & FILTER SWK -->
        <div class="card" style="margin-top: 20px; overflow-x: auto;">
            
            <!-- TOMBOL KEMBALI KECIL DI ATAS FILTER -->
            <button class="btn-back-small" onclick="goBack()">
                <i class="fas fa-arrow-left"></i> Kembali ke Pilihan
            </button>

            <!-- FILTER KECAMATAN -->
            <div class="filter">
                <i class="fas fa-filter" style="color: #6b7280;"></i>
                <select id="filterKecamatanSwk" onchange="fetchData('swk')">
                    <option value="">Semua Kecamatan</option>
                    @foreach($kecamatan as $k)
                        <option value="{{ $k->ID_KECAMATAN }}">{{ $k->NM_KECAMATAN }}</option>
                    @endforeach
                </select>
                <span id="loadingSwk" style="display: none; font-size: 13px; color: #0d6efd; padding-top: 2px;">
                    <i class="fas fa-spinner fa-spin"></i> Memuat data...
                </span>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kecamatan</th>
                        <th>Kelurahan</th>
                        <th>Nama SWK</th>
                        <th>Alamat</th>
                        <th>Jml. Pedagang</th>
                        <th>Jml. Stan</th>
                        <th>Stan Kosong</th>
                    </tr>
                </thead>
                <tbody id="tableBodySwk">
                    @forelse($swk as $index => $d)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $d->kelurahan->kecamatan->NM_KECAMATAN ?? '-' }}</td>
                        <td>{{ $d->kelurahan->NM_KELURAHAN ?? '-' }}</td>
                        <td>{{ $d->nama_swk }}</td>
                        <td>{{ $d->alamat }}</td>
                        <td>{{ $d->jumlah_pedagang }}</td>
                        <td>{{ $d->jumlah_stan }}</td>
                        <td>{{ $d->stan_belum_terisi }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="8" style="text-align: center;">Tidak ada data SWK</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

  </div>
</div>

<script src="{{ asset('js/script.js') }}"></script>

<script>
    // ==========================================
    // FUNGSI TOGGLE SIDEBAR (UNTUK TAMPILAN HP)
    // ==========================================
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('active');
    }

    // ==========================================
    // LOGIKA KLIK MENU KE TABEL (FLOW)
    // ==========================================
    function showData(type) {
        document.getElementById('menuSelection').classList.add('d-none');
        
        document.getElementById('content-umkm').classList.add('d-none');
        document.getElementById('content-swk').classList.add('d-none');

        if(type === 'umkm') {
            document.getElementById('content-umkm').classList.remove('d-none');
            document.getElementById('pageTitle').innerText = "Detail Data : UMKM";
        } else if(type === 'swk') {
            document.getElementById('content-swk').classList.remove('d-none');
            document.getElementById('pageTitle').innerText = "Detail Data : Sentra Wisata Kuliner";
        }
    }

    // LOGIKA TOMBOL KEMBALI
    function goBack() {
        document.getElementById('filterKecamatanUmkm').value = ""; 
        document.getElementById('filterKecamatanSwk').value = ""; 
        fetchData('umkm'); 
        fetchData('swk'); 

        document.getElementById('content-umkm').classList.add('d-none');
        document.getElementById('content-swk').classList.add('d-none');
        document.getElementById('menuSelection').classList.remove('d-none');
        document.getElementById('pageTitle').innerText = "Pilih Kategori : Pemberdayaan Usaha Mikro";
    }

    // ==========================================
    // LOGIKA AJAX FILTER KECAMATAN
    // ==========================================
    function fetchData(type) {
        let kecamatanId = '';
        let loadingId = '';

        if(type === 'umkm') {
            kecamatanId = document.getElementById('filterKecamatanUmkm').value;
            loadingId = 'loadingUmkm';
        } else {
            kecamatanId = document.getElementById('filterKecamatanSwk').value;
            loadingId = 'loadingSwk';
        }

        document.getElementById(loadingId).style.display = 'inline-flex';

        fetch(window.location.pathname + '?kecamatan_id=' + kecamatanId, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.json())
        .then(data => {
            if(type === 'umkm') {
                // UPDATE REKAP UMKM
                document.getElementById('sum_total_umkm').innerText = data.summary_umkm?.total_umkm || 0;
                document.getElementById('sum_binaan').innerText = data.summary_umkm?.umkm_binaan || 0;
                document.getElementById('sum_halal').innerText = data.summary_umkm?.sertifikasi_halal || 0;

                // UPDATE TABEL UMKM
                const tbodyUmkm = document.getElementById('tableBodyUmkm');
                tbodyUmkm.innerHTML = '';
                if(data.umkm.length > 0) {
                    data.umkm.forEach((d, index) => {
                        tbodyUmkm.innerHTML += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${d.kelurahan?.kecamatan?.NM_KECAMATAN || '-'}</td>
                                <td>${d.kelurahan?.NM_KELURAHAN || '-'}</td>
                                <td>${d.total_umkm}</td>
                                <td>${d.umkm_binaan}</td>
                                <td>${d.sertifikasi_halal}</td>
                                <td>${d.sertifikasi_merek}</td>
                                <td>${d.nib}</td>
                                <td>${d.peken}</td>
                                <td>${d.padat_karya}</td>
                            </tr>
                        `;
                    });
                } else {
                    tbodyUmkm.innerHTML = '<tr><td colspan="10" style="text-align:center;">Tidak ada data UMKM</td></tr>';
                }
            } else {
                // UPDATE REKAP SWK
                document.getElementById('sum_total_swk').innerText = data.summary_swk?.total_swk || 0;
                document.getElementById('sum_pedagang').innerText = data.summary_swk?.total_pedagang || 0;
                document.getElementById('sum_stan').innerText = data.summary_swk?.total_stan || 0;

                // UPDATE TABEL SWK
                const tbodySwk = document.getElementById('tableBodySwk');
                tbodySwk.innerHTML = '';
                if(data.swk.length > 0) {
                    data.swk.forEach((d, index) => {
                        tbodySwk.innerHTML += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${d.kelurahan?.kecamatan?.NM_KECAMATAN || '-'}</td>
                                <td>${d.kelurahan?.NM_KELURAHAN || '-'}</td>
                                <td>${d.nama_swk}</td>
                                <td>${d.alamat}</td>
                                <td>${d.jumlah_pedagang}</td>
                                <td>${d.jumlah_stan}</td>
                                <td>${d.stan_belum_terisi}</td>
                            </tr>
                        `;
                    });
                } else {
                    tbodySwk.innerHTML = '<tr><td colspan="8" style="text-align:center;">Tidak ada data SWK</td></tr>';
                }
            }

            document.getElementById(loadingId).style.display = 'none';
        })
        .catch(error => {
            console.error("Error: ", error);
            document.getElementById(loadingId).style.display = 'none';
        });
    }

    // FUNGSI LOGOUT
    function logout(){
      localStorage.removeItem("login");
      window.location.href = "/";
    }
</script>

</body>
</html>