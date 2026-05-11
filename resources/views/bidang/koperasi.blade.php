<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Bidang Koperasi</title>

<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
  /* TABLE & CONTAINER UTAMA */
  .table-container {
    background: #ffffff;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    overflow-x: auto;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
    margin-bottom: 20px;
  }

  .data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
    border: none;
  }

  .data-table thead {
    background: #eaf2ff;
  }

  .data-table th {
    padding: 12px;
    text-align: center;
    font-weight: 600;
    color: #0d6efd;
    border-bottom: 1px solid #ddd;
  }

  .data-table td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
    text-align: center;
  }

  .data-table tbody tr:hover {
    background: #f9fafb;
  }

  .data-table tbody tr:nth-child(even) {
    background: #f5f8ff;
  }

  /* BADGES */
  .badge-status {
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
  }

  .badge-aktif {
    background: #d1e7dd;
    color: #155724;
  }

  .badge-tidak-aktif {
    background: #f8d7da;
    color: #721c24;
  }

  .badge-pns {
    background: #cce5ff;
    color: #004085;
  }

  .badge-non-pns {
    background: #fff3cd;
    color: #856404;
  }

  /* CARD CLICKABLE */
  .card {
    cursor: pointer;
  }

  .card:active {
    transform: scale(0.98);
  }

  /* NO DATA */
  .no-data {
    text-align: center;
    padding: 40px;
    color: #999;
  }

  /* TABLE VIEW CONTAINER */
  .table-view {
    display: none;
  }

  .table-view.active {
    display: block;
  }

  .cards.hidden {
    display: none !important; 
  }

  .back-btn {
    background: #6c757d;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    margin-bottom: 20px;
    transition: 0.3s;
  }

  .back-btn:hover {
    background: #5a6268;
  }

  .table-view-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    border-bottom: 2px solid #0d6efd;
    padding-bottom: 15px;
  }

  .table-view-header h3 {
    margin: 0;
    color: #0d6efd;
    font-size: 20px;
  }

  /* FILTER SECTION */
  .filter-section {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    border: 1px solid #dee2e6;
  }

  .filter-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 15px;
    align-items: end;
  }

  .filter-row-single {
    display: flex;
    gap: 10px;
    align-items: end;
  }

  .filter-group-single {
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .filter-group-single label {
    font-weight: 600;
    font-size: 13px;
    color: #333;
    margin-bottom: 5px;
  }

  .filter-group-single input {
    padding: 8px 12px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    font-size: 14px;
    background-color: white;
    color: #333;
    width: 100%;
  }

  .filter-group-single input::placeholder {
    color: #999;
  }

  .filter-group-single input:focus {
    outline: none;
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
  }

  .filter-btn-group {
    display: flex;
    gap: 10px;
  }

  .filter-btn {
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
    transition: 0.3s;
  }

  .filter-btn-apply {
    background: #0d6efd;
    color: white;
  }

  .filter-btn-apply:hover {
    background: #0b5ed7;
  }

  .filter-btn-reset {
    background: #6c757d;
    color: white;
  }

  .filter-btn-reset:hover {
    background: #5a6268;
  }

  /* =========================================
     PAGINATION STYLING (MODERN & COMFORT UX)
     ========================================= */
.pagination-wrapper {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 18px;
  background: #ffffff;
  border-top: 1px solid #eaebec;
  border-radius: 0 0 8px 8px;
  flex-wrap: wrap;
  gap: 12px;
}

/* Text info */
.pagination-info {
  font-size: 13px;
  color: #64748b;
  font-weight: 500;
}

/* Navigation */
.pagination-links {
  display: flex;
  align-items: center;
}

.pagination-links nav {
  display: flex;
  align-items: center;
}

/* Hide Laravel default text */
.pagination-links nav > div:first-of-type,
.pagination-links nav > div > p.text-sm,
.pagination-links nav > div.sm\:hidden,
.pagination-links nav p {
  display: none !important;
}

/* Pagination container */
.pagination-links ul,
.pagination-links .relative.z-0.inline-flex {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  margin: 0;
  padding: 0;
  box-shadow: none !important;
}

/* Item */
.pagination-links li,
.pagination-links .relative.z-0.inline-flex > span,
.pagination-links .relative.z-0.inline-flex > a {
  list-style: none;
  display: flex;
}

/* Button style */
.pagination-links a,
.pagination-links span {
  display: inline-flex;
  align-items: center;
  justify-content: center;

  min-width: 32px;
  height: 32px;

  padding: 0 10px;

  border-radius: 6px !important;
  border: 1px solid #dbe2ea;

  background: #ffffff;
  color: #334155;

  text-decoration: none;
  font-size: 13px;
  font-weight: 600;

  transition: all 0.18s ease;
  margin: 0 !important;
}

/* Hover */
.pagination-links a:hover {
  background: #f8fafc;
  border-color: #cbd5e1;
  transform: translateY(-1px);
}

/* Active */
.pagination-links .active span,
.pagination-links span[aria-current="page"] span {
  background: #0d6efd !important;
  color: #ffffff !important;
  border-color: #0d6efd !important;
  box-shadow: 0 2px 6px rgba(13, 110, 253, 0.18);
}

/* Disabled */
.pagination-links .disabled span,
.pagination-links span[aria-disabled="true"] span,
.pagination-links span[aria-disabled="true"] {
  color: #94a3b8 !important;
  background: #f8fafc !important;
  border-color: #e2e8f0 !important;
  cursor: not-allowed;
  opacity: 0.7;
}

/* SVG icon */
.pagination-links svg {
  width: 14px !important;
  height: 14px !important;
  stroke-width: 2.5;
}

  /* RESPONSIVE LAYOUT */
  @media (max-width: 768px) {
    .filter-row {
      grid-template-columns: 1fr;
    }

    .filter-btn-group {
      flex-direction: column;
    }

    .filter-btn {
      width: 100%;
    }

    /* Menyesuaikan pagination untuk layar kecil */
    .pagination-wrapper {
      flex-direction: column-reverse; /* Tombol navigasi di atas teks info */
      justify-content: center;
      text-align: center;
      padding: 16px;
      gap: 12px;
    }

    .pagination-links {
      width: 100%;
      justify-content: center;
    }
  }

  /* TAMBAHAN KHUSUS RESPONSIVE SIDEBAR & CHART */
  body {
    overflow-x: hidden; 
  }

  .toggle-btn {
    display: none; 
  }
  
  .chart-grid {
    width: 100%;
    box-sizing: border-box;
  }

  .chart-box {
    position: relative;
    height: 300px; 
    width: 100%;
    box-sizing: border-box;
  }

  .chart-box canvas {
    max-width: 100% !important;
  }

  @media screen and (max-width: 768px) {
    .toggle-btn {
      display: block;
      font-size: 24px;
      cursor: pointer;
      margin-right: 15px;
    }
    .sidebar {
      position: fixed;
      left: -250px;
      top: 0;
      height: 100vh;
      z-index: 1000;
      transition: left 0.3s ease;
    }
    .sidebar.active {
      left: 0;
    }
    .main {
      margin-left: 0 !important;
      width: 100%;
    }
    .cards {
      grid-template-columns: 1fr !important; 
      gap: 15px;
    }
    .chart-grid {
      display: grid !important;
      grid-template-columns: 1fr !important;
      gap: 20px;
    }
    .chart-box {
      height: 250px; 
    }
  }
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
        <a href="/koperasi" class="active"><i class="fas fa-building"></i> Bidang Koperasi</a>
        <a href="/pembinaan"><i class="fas fa-briefcase"></i> Pembinaan Usaha Perdagangan</a>
        <a href="/metrologi"><i class="fas fa-balance-scale"></i> UPTD Metrologi Legal</a>
    </div>
    <button onclick="logout()" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Keluar</button>
</div>


<div class="main">

  <div class="header">
    <div class="toggle-btn" onclick="toggleSidebar()">☰</div>
    <img src="{{ asset('images/logo.jpg') }}" class="logo">
    <div>
      <b>Bidang Koperasi</b><br>
      <small>Dinkopumdag Surabaya</small>
    </div>
  </div>

  <div class="container">

    <h2>Detail : Koperasi</h2>

    <div class="cards" id="cardsView">

      <div class="card purple" onclick="showTableView('totalKoperasi')">
        <h4>Jumlah Koperasi</h4>
        <h2>{{ $totalJumlah }}</h2>
      </div>

      <div class="card green" onclick="showTableView('koperasiAktif')">
        <h4>Koperasi Aktif</h4>
        <h2>{{ $jumlahAktif }}</h2>
      </div>

      <div class="card orange" onclick="showTableView('koperasiTidakAktif')">
        <h4>Koperasi Nonaktif</h4>
        <h2>{{ $jumlahTidakAktif }}</h2>
      </div>

      <div class="card cyan" onclick="showTableView('padatKarya')">
        <h4>Padat Karya</h4>
        <h2>{{ $jumlahPadatKarya }}</h2>
      </div>

      <div class="card yellow" onclick="showTableView('pelaksanaanRat')">
        <h4>Pelaksanaan RAT</h4>
        <h2>{{ $totalPelaksanaanRat }}</h2>
      </div>

    </div>

    <div id="totalKoperasi-table" class="table-view">
      <div class="table-view-header">
        <h3><i class="fas fa-building"></i> Data Semua Koperasi</h3>
        <button class="back-btn" onclick="hideTableView()">← Kembali</button>
      </div>

      <div class="filter-section">
        <div class="filter-row-single">
          <div class="filter-group-single">
            <label for="searchTotal">🔍 Cari Data</label>
            <input type="text" id="searchTotal" placeholder="Ketik untuk mencari...">
          </div>
          <div class="filter-btn-group">
            <button class="filter-btn filter-btn-apply" onclick="applySearch('totalKoperasi')">Filter</button>
            <button class="filter-btn filter-btn-reset" onclick="resetFilterSearch('totalKoperasi')">Reset</button>
          </div>
        </div>
      </div>

      <div class="table-container">
        @if($allKoperasi->count() > 0)
          <table class="data-table" id="tableKoperasiTotal">
            <thead>
              <tr>
                <th>No</th>
                <th>Jumlah</th>
                <th>Tahun</th>
                <th>Status</th>
                <th>Status Mitra</th>
                <th>Jenis Mitra</th>
                <th>Kelurahan</th>
                <th>Kecamatan</th>
                <th>Padat Karya</th>
                <th>Status LPJ</th>
                <th>Pelaksanaan RAT</th>
              </tr>
            </thead>
            <tbody>
              @foreach($allKoperasi as $k)
                <tr class="koperasi-row" data-kecamatan="{{ $k->kecamatan->NM_KECAMATAN ?? '' }}" data-kelurahan="{{ $k->kelurahan->NM_KELURAHAN ?? '' }}" data-tahun="{{ $k->tahun }}">
                  <td>{{ ($allKoperasi->currentPage() - 1) * $allKoperasi->perPage() + $loop->iteration }}</td>
                  <td>{{ $k->jumlah }}</td>
                  <td>{{ $k->tahun }}</td>
                  <td><span class="badge-status badge-{{ $k->status == 'aktif' ? 'aktif' : 'tidak-aktif' }}">{{ ucfirst($k->status) }}</span></td>
                  <td>{{ ucfirst($k->status_mitra) }}</td>
                  <td>{{ ucfirst($k->jenis_mitra) }}</td>
                  <td>{{ $k->kelurahan->NM_KELURAHAN ?? '-' }}</td>
                  <td>{{ $k->kecamatan->NM_KECAMATAN ?? '-' }}</td>
                  <td>{{ $k->padat_karya }}</td>
                  <td>{{ $k->status_lpj }}</td>
                  <td>{{ $k->pelaksanaan_rat }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <div class="pagination-wrapper">

            <div class="pagination-links">
              {{ $allKoperasi->appends(request()->except('total_p'))->onEachSide(1)->links() }}
            </div>

            <div class="pagination-info">
              Menampilkan {{ $allKoperasi->firstItem() ?? 0 }}
              hingga {{ $allKoperasi->lastItem() ?? 0 }}
              dari {{ $allKoperasi->total() }} data
            </div>

          </div>

          
          
        @else
          <div class="no-data">Tidak ada data koperasi</div>
        @endif
      </div>
    </div>

    <div id="koperasiAktif-table" class="table-view">
      <div class="table-view-header">
        <h3><i class="fas fa-check-circle"></i> Data Koperasi Aktif</h3>
        <button class="back-btn" onclick="hideTableView()">← Kembali</button>
      </div>

      <div class="filter-section">
        <div class="filter-row-single">
          <div class="filter-group-single">
            <label for="searchAktif">🔍 Cari Data</label>
            <input type="text" id="searchAktif" placeholder="Ketik untuk mencari...">
          </div>
          <div class="filter-btn-group">
            <button class="filter-btn filter-btn-apply" onclick="applySearch('koperasiAktif')">Filter</button>
            <button class="filter-btn filter-btn-reset" onclick="resetFilterSearch('koperasiAktif')">Reset</button>
          </div>
        </div>
      </div>

      <div class="table-container">
        @if($koperasiAktif->count() > 0)
          <table class="data-table" id="tableKoperasiAktif">
            <thead>
              <tr>
                <th>No</th>
                <th>Jumlah</th>
                <th>Tahun</th>
                <th>Status Mitra</th>
                <th>Jenis Mitra</th>
                <th>Kelurahan</th>
                <th>Kecamatan</th>
                <th>Padat Karya</th>
                <th>Status LPJ</th>
                <th>Pelaksanaan RAT</th>
              </tr>
            </thead>
            <tbody>
              @foreach($koperasiAktif as $k)
                <tr class="koperasi-row" data-kecamatan="{{ $k->kecamatan->NM_KECAMATAN ?? '' }}" data-kelurahan="{{ $k->kelurahan->NM_KELURAHAN ?? '' }}" data-tahun="{{ $k->tahun }}">
                  <td>{{ ($koperasiAktif->currentPage() - 1) * $koperasiAktif->perPage() + $loop->iteration }}</td>
                  <td>{{ $k->jumlah }}</td>
                  <td>{{ $k->tahun }}</td>
                  <td>{{ ucfirst($k->status_mitra) }}</td>
                  <td>{{ ucfirst($k->jenis_mitra) }}</td>
                  <td>{{ $k->kelurahan->NM_KELURAHAN ?? '-' }}</td>
                  <td>{{ $k->kecamatan->NM_KECAMATAN ?? '-' }}</td>
                  <td><span class="badge-status badge-{{ $k->padat_karya == 'YA' ? 'aktif' : 'tidak-aktif' }}">{{ $k->padat_karya }}</span></td>
                  <td><span class="badge-status badge-{{ $k->status_lpj == 'LENGKAP' ? 'aktif' : 'tidak-aktif' }}">{{ $k->status_lpj }}</span></td>
                  <td>{{ $k->pelaksanaan_rat }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <div class="pagination-wrapper">
            <div class="pagination-links">
              {{ $koperasiAktif->appends(request()->except('aktif_p'))->links() }}
            </div>

            <div class="pagination-info">
              Menampilkan {{ $koperasiAktif->firstItem() ?? 0 }} hingga {{ $koperasiAktif->lastItem() ?? 0 }} dari {{ $koperasiAktif->total() }} data
            </div>
          </div>
          
        @else
          <div class="no-data">Tidak ada data koperasi aktif</div>
        @endif
      </div>
    </div>

    <div id="koperasiTidakAktif-table" class="table-view">
      <div class="table-view-header">
        <h3><i class="fas fa-times-circle"></i> Data Koperasi Tidak Aktif</h3>
        <button class="back-btn" onclick="hideTableView()">← Kembali</button>
      </div>

      <div class="filter-section">
        <div class="filter-row-single">
          <div class="filter-group-single">
            <label for="searchTidakAktif">🔍 Cari Data</label>
            <input type="text" id="searchTidakAktif" placeholder="Ketik untuk mencari...">
          </div>
          <div class="filter-btn-group">
            <button class="filter-btn filter-btn-apply" onclick="applySearch('koperasiTidakAktif')">Filter</button>
            <button class="filter-btn filter-btn-reset" onclick="resetFilterSearch('koperasiTidakAktif')">Reset</button>
          </div>
        </div>
      </div>

      <div class="table-container">
        @if($koperasiTidakAktif->count() > 0)
          <table class="data-table" id="tableKoperasiTidakAktif">
            <thead>
              <tr>
                <th>No</th>
                <th>Jumlah</th>
                <th>Tahun</th>
                <th>Status Mitra</th>
                <th>Jenis Mitra</th>
                <th>Kelurahan</th>
                <th>Kecamatan</th>
                <th>Padat Karya</th>
                <th>Status LPJ</th>
                <th>Pelaksanaan RAT</th>
              </tr>
            </thead>
            <tbody>
              @foreach($koperasiTidakAktif as $k)
                <tr class="koperasi-row" data-kecamatan="{{ $k->kecamatan->NM_KECAMATAN ?? '' }}" data-kelurahan="{{ $k->kelurahan->NM_KELURAHAN ?? '' }}" data-tahun="{{ $k->tahun }}">
                  <td>{{ ($koperasiTidakAktif->currentPage() - 1) * $koperasiTidakAktif->perPage() + $loop->iteration }}</td>
                  <td>{{ $k->jumlah }}</td>
                  <td>{{ $k->tahun }}</td>
                  <td>{{ ucfirst($k->status_mitra) }}</td>
                  <td>{{ ucfirst($k->jenis_mitra) }}</td>
                  <td>{{ $k->kelurahan->NM_KELURAHAN ?? '-' }}</td>
                  <td>{{ $k->kecamatan->NM_KECAMATAN ?? '-' }}</td>
                  <td><span class="badge-status badge-{{ $k->padat_karya == 'YA' ? 'aktif' : 'tidak-aktif' }}">{{ $k->padat_karya }}</span></td>
                  <td><span class="badge-status badge-{{ $k->status_lpj == 'LENGKAP' ? 'aktif' : 'tidak-aktif' }}">{{ $k->status_lpj }}</span></td>
                  <td>{{ $k->pelaksanaan_rat }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <div class="pagination-wrapper">
            <div class="pagination-links">
              {{ $koperasiTidakAktif->appends(request()->except('tidak_aktif_p'))->links() }}
            </div>

            <div class="pagination-info">
              Menampilkan {{ $koperasiTidakAktif->firstItem() ?? 0 }} hingga {{ $koperasiTidakAktif->lastItem() ?? 0 }} dari {{ $koperasiTidakAktif->total() }} data
            </div>
          </div>
        @else
          <div class="no-data">Tidak ada data koperasi tidak aktif</div>
        @endif
      </div>
    </div>

    <div id="padatKarya-table" class="table-view">
      <div class="table-view-header">
        <h3><i class="fas fa-briefcase"></i> Data Koperasi dengan Padat Karya</h3>
        <button class="back-btn" onclick="hideTableView()">← Kembali</button>
      </div>

      <div class="filter-section">
        <div class="filter-row-single">
          <div class="filter-group-single">
            <label for="searchPadatKarya">🔍 Cari Data</label>
            <input type="text" id="searchPadatKarya" placeholder="Ketik untuk mencari...">
          </div>
          <div class="filter-btn-group">
            <button class="filter-btn filter-btn-apply" onclick="applySearch('padatKarya')">Filter</button>
            <button class="filter-btn filter-btn-reset" onclick="resetFilterSearch('padatKarya')">Reset</button>
          </div>
        </div>
      </div>

      <div class="table-container">
        @if($padatKaryaDetail->count() > 0)
          <table class="data-table" id="tablePadatKarya">
            <thead>
              <tr>
                <th>No</th>
                <th>Jumlah</th>
                <th>Tahun</th>
                <th>Status</th>
                <th>Status Mitra</th>
                <th>Jenis Mitra</th>
                <th>Kelurahan</th>
                <th>Kecamatan</th>
                <th>Padat Karya</th>
                <th>Status LPJ</th>
                <th>Pelaksanaan RAT</th>
              </tr>
            </thead>
            <tbody>
              @foreach($padatKaryaDetail as $k)
                <tr class="koperasi-row" data-kecamatan="{{ $k->kecamatan->NM_KECAMATAN ?? '' }}" data-kelurahan="{{ $k->kelurahan->NM_KELURAHAN ?? '' }}" data-tahun="{{ $k->tahun }}">
                  <td>{{ ($padatKaryaDetail->currentPage() - 1) * $padatKaryaDetail->perPage() + $loop->iteration }}</td>
                  <td>{{ $k->jumlah }}</td>
                  <td>{{ $k->tahun }}</td>
                  <td><span class="badge-status badge-{{ $k->status == 'aktif' ? 'aktif' : 'tidak-aktif' }}">{{ ucfirst($k->status) }}</span></td>
                  <td>{{ ucfirst($k->status_mitra) }}</td>
                  <td>{{ ucfirst($k->jenis_mitra) }}</td>
                  <td>{{ $k->kelurahan->NM_KELURAHAN ?? '-' }}</td>
                  <td>{{ $k->kecamatan->NM_KECAMATAN ?? '-' }}</td>
                  <td><span class="badge-status badge-{{ $k->padat_karya == 'YA' ? 'aktif' : 'tidak-aktif' }}">{{ $k->padat_karya }}</span></td>
                  <td><span class="badge-status badge-{{ $k->status_lpj == 'LENGKAP' ? 'aktif' : 'tidak-aktif' }}">{{ $k->status_lpj }}</span></td>
                  <td>{{ $k->pelaksanaan_rat }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <div class="pagination-wrapper">
            <div class="pagination-links">
              {{ $padatKaryaDetail->appends(request()->except('padat_karya_p'))->links() }}
            </div>

            <div class="pagination-info">
              Menampilkan {{ $padatKaryaDetail->firstItem() ?? 0 }} hingga {{ $padatKaryaDetail->lastItem() ?? 0 }} dari {{ $padatKaryaDetail->total() }} data
            </div>
          </div>
        @else
          <div class="no-data">Tidak ada data koperasi dengan padat karya</div>
        @endif
      </div>
    </div>

    <div id="pelaksanaanRat-table" class="table-view">
      <div class="table-view-header">
        <h3><i class="fas fa-chart-bar"></i> Data Pelaksanaan RAT</h3>
        <button class="back-btn" onclick="hideTableView()">← Kembali</button>
      </div>

      <div class="filter-section">
        <div class="filter-row-single">
          <div class="filter-group-single">
            <label for="searchPelaksanaanRat">🔍 Cari Data</label>
            <input type="text" id="searchPelaksanaanRat" placeholder="Ketik untuk mencari...">
          </div>
          <div class="filter-btn-group">
            <button class="filter-btn filter-btn-apply" onclick="applySearch('pelaksanaanRat')">Filter</button>
            <button class="filter-btn filter-btn-reset" onclick="resetFilterSearch('pelaksanaanRat')">Reset</button>
          </div>
        </div>
      </div>

      <div class="table-container">
        @if($pelaksanaanRatDetail->count() > 0)
          <table class="data-table" id="tablePelaksanaanRat">
            <thead>
              <tr>
                <th>No</th>
                <th>Jumlah</th>
                <th>Tahun</th>
                <th>Status</th>
                <th>Status Mitra</th>
                <th>Jenis Mitra</th>
                <th>Kelurahan</th>
                <th>Kecamatan</th>
                <th>Padat Karya</th>
                <th>Status LPJ</th>
                <th>Pelaksanaan RAT</th>
              </tr>
            </thead>
            <tbody>
              @foreach($pelaksanaanRatDetail as $k)
                <tr class="koperasi-row" data-kecamatan="{{ $k->kecamatan->NM_KECAMATAN ?? '' }}" data-kelurahan="{{ $k->kelurahan->NM_KELURAHAN ?? '' }}" data-tahun="{{ $k->tahun }}">
                  <td>{{ ($pelaksanaanRatDetail->currentPage() - 1) * $pelaksanaanRatDetail->perPage() + $loop->iteration }}</td>
                  <td>{{ $k->jumlah }}</td>
                  <td>{{ $k->tahun }}</td>
                  <td><span class="badge-status badge-{{ $k->status == 'aktif' ? 'aktif' : 'tidak-aktif' }}">{{ ucfirst($k->status) }}</span></td>
                  <td>{{ ucfirst($k->status_mitra) }}</td>
                  <td>{{ ucfirst($k->jenis_mitra) }}</td>
                  <td>{{ $k->kelurahan->NM_KELURAHAN ?? '-' }}</td>
                  <td>{{ $k->kecamatan->NM_KECAMATAN ?? '-' }}</td>
                  <td><span class="badge-status badge-{{ $k->padat_karya == 'YA' ? 'aktif' : 'tidak-aktif' }}">{{ $k->padat_karya }}</span></td>
                  <td><span class="badge-status badge-{{ $k->status_lpj == 'LENGKAP' ? 'aktif' : 'tidak-aktif' }}">{{ $k->status_lpj }}</span></td>
                  <td>{{ $k->pelaksanaan_rat }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <div class="pagination-wrapper">
            <div class="pagination-links">
              {{ $pelaksanaanRatDetail->appends(request()->except('pelaksanaan_rat_p'))->links() }}
            </div>

            <div class="pagination-info">
              Menampilkan {{ $pelaksanaanRatDetail->firstItem() ?? 0 }} hingga {{ $pelaksanaanRatDetail->lastItem() ?? 0 }} dari {{ $pelaksanaanRatDetail->total() }} data
            </div>
          </div>
        @else
          <div class="no-data">Tidak ada data pelaksanaan RAT</div>
        @endif
      </div>
    </div>

  </div>

<script src="{{ asset('js/script.js') }}"></script>

<script>
// TANGGAL DI SIDEBAR
document.addEventListener('DOMContentLoaded', function() {
    const elTanggal = document.getElementById('tanggalSidebar');
    if (elTanggal) {
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        elTanggal.textContent = now.toLocaleDateString('id-ID', options);
    }
});

// TOGGLE SIDEBAR UNTUK HP
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('active');
}

// Tutup sidebar jika klik di luar (layar HP)
document.addEventListener('click', function(event) {
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.querySelector(".toggle-btn");
    if (window.innerWidth <= 768 && sidebar && toggleBtn) {
        if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
            sidebar.classList.remove("active");
        }
    }
});

// Mapping untuk ID table yang benar
const tableIdMap = {
  'totalKoperasi': 'tableKoperasiTotal',
  'koperasiAktif': 'tableKoperasiAktif',
  'koperasiTidakAktif': 'tableKoperasiTidakAktif',
  'padatKarya': 'tablePadatKarya',
  'pelaksanaanRat': 'tablePelaksanaanRat'
};

// Mapping untuk search input ID
const searchIdMap = {
  'totalKoperasi': 'searchTotal',
  'koperasiAktif': 'searchAktif',
  'koperasiTidakAktif': 'searchTidakAktif',
  'padatKarya': 'searchPadatKarya',
  'pelaksanaanRat': 'searchPelaksanaanRat'
};

function logout(){
  localStorage.removeItem("login");
  window.location.href = "/";
}

// TABLE VIEW FUNCTIONS
function showTableView(tableId) {
  document.getElementById('cardsView').classList.add('hidden');
  document.querySelectorAll('.table-view.active').forEach(table => {
    table.classList.remove('active');
  });
  const table = document.getElementById(tableId + '-table');
  if (table) {
    table.classList.add('active');
  }
  // Scroll to top
  window.scrollTo(0, 0);
}

function hideTableView() {
  // Hide all table views
  document.querySelectorAll('.table-view.active').forEach(table => {
    table.classList.remove('active');
  });
  // Show cards again
  document.getElementById('cardsView').classList.remove('hidden');
  // Scroll to top
  window.scrollTo(0, 0);
}

// SEARCH FUNCTIONS
function getTableId(tableId) {
  return tableIdMap[tableId] || 'table' + capitalizeFirst(tableId);
}

function getSearchId(tableId) {
  return searchIdMap[tableId] || 'search' + capitalizeFirst(tableId);
}

function applySearch(tableId) {
  const searchInputId = getSearchId(tableId);
  const searchInput = document.getElementById(searchInputId);
  
  if (!searchInput) return;

  const searchTerm = searchInput.value.toLowerCase().trim();
  const tableElement = document.getElementById(getTableId(tableId));
  
  if (!tableElement) return;

  const rows = tableElement.querySelectorAll('tbody tr.koperasi-row');
  let visibleCount = 0;

  rows.forEach(row => {
    // Dapatkan semua text dari cells di row
    const rowText = row.textContent.toLowerCase();
    
    // Cek apakah search term ada di dalam row
    if (searchTerm === '' || rowText.includes(searchTerm)) {
      row.style.display = '';
      visibleCount++;
    } else {
      row.style.display = 'none';
    }
  });

  // Show no data message if no rows visible
  const tableContainer = tableElement.parentElement;
  let noDataDiv = tableContainer.querySelector('.no-data-filtered');
  
  if (visibleCount === 0 && searchTerm !== '') {
    if (!noDataDiv) {
      noDataDiv = document.createElement('div');
      noDataDiv.className = 'no-data no-data-filtered';
      noDataDiv.textContent = 'Tidak ada data yang sesuai dengan pencarian: "' + searchTerm + '"';
      tableContainer.appendChild(noDataDiv);
    }
    noDataDiv.style.display = 'block';
    tableElement.style.display = 'none';
  } else {
    if (noDataDiv) noDataDiv.style.display = 'none';
    tableElement.style.display = '';
  }
}

function resetFilterSearch(tableId) {
  const searchInputId = getSearchId(tableId);
  const searchInput = document.getElementById(searchInputId);
  
  if (searchInput) {
    searchInput.value = '';
  }

  // Show all rows
  const tableElement = document.getElementById(getTableId(tableId));
  if (tableElement) {
    tableElement.querySelectorAll('tbody tr.koperasi-row').forEach(row => {
      row.style.display = '';
    });
    tableElement.style.display = '';

    // Hide no data message
    const noDataDiv = tableElement.parentElement.querySelector('.no-data-filtered');
    if (noDataDiv) noDataDiv.style.display = 'none';
  }
}

// Allow Enter key to apply search
document.addEventListener('DOMContentLoaded', function() {
  // Logic to maintain table view on pagination reload
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has('total_p')) {
    showTableView('totalKoperasi');
  } else if (urlParams.has('aktif_p')) {
    showTableView('koperasiAktif');
  } else if (urlParams.has('tidak_aktif_p')) {
    showTableView('koperasiTidakAktif');
  } else if (urlParams.has('padat_karya_p')) {
    showTableView('padatKarya');
  } else if (urlParams.has('pelaksanaan_rat_p')) {
    showTableView('pelaksanaanRat');
  } else if (urlParams.has('pegawai_p')) {
    showTableView('totalPegawai');
  } else if (urlParams.has('pns_p')) {
    showTableView('pegawaiPNS');
  }

  Object.values(searchIdMap).forEach(searchId => {
    const searchInput = document.getElementById(searchId);
    if (searchInput) {
      searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
          // Find the tableId from searchId
          for (const [tableId, id] of Object.entries(searchIdMap)) {
            if (id === searchId) {
              applySearch(tableId);
              break;
            }
          }
        }
      });
    }
  });
});

function capitalizeFirst(str) {
  return str.charAt(0).toUpperCase() + str.slice(1);
}
</script>

</body>
</html>