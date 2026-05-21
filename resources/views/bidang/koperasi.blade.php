<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Bidang Koperasi</title>

<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
  body {
      background: #f8fafc;
      display: flex;
      min-height: 100vh;
      overflow-x: hidden;
  }

  /* HEADER TETAP */
  .header {
    position: sticky !important;
    top: 0 !important;
    z-index: 100 !important;
  }

  /* --- PERBAIKAN LAYOUT UTAMA --- */
  .main {
    flex: 1;
    min-width: 0; 
    box-sizing: border-box;
    padding-bottom: 40px;
  }

  /* --- WRAPPER KOTAK KONTEN --- */
  .content-wrapper-box {
    background: #ffffff;
    border: 1px solid #dee2e6;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    margin-bottom: 20px;
    width: 100%;
    box-sizing: border-box;
  }

  /* TABLE & CONTAINER UTAMA */
  .table-container {
    width: 100%;
    overflow-x: auto; 
    -webkit-overflow-scrolling: touch;
    border-radius: 8px;
    border: 1px solid #dee2e6;
    background: transparent;
    box-shadow: none; 
    margin-bottom: 0;
  }

  .data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
    border: none;
    min-width: 1100px; 
  }

  .data-table thead {
    background: #eaf2ff;
  }

  .data-table th, .data-table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #e5e7eb;
    white-space: nowrap;
  }

  .data-table th {
    font-weight: 600;
    color: #333;
  }

  .data-table tbody tr:nth-child(even) { background: #f9fafb; }
  .data-table tbody tr:hover { background: #eef4ff; }

  /* CARDS */
  .card { cursor: pointer; }
  .card:active { transform: scale(0.98); }

  .main-cards-view {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 30px;
  }

  .main-card {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    padding: 30px !important;
    text-align: left;
    border-radius: 14px;
    transition: all 0.3s ease;
    color: white;
    border: none;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    position: relative;
    overflow: hidden;
  }

  .main-card h3 { margin: 0 0 10px 0; font-size: 18px; }
  .main-card p { margin: 0; font-size: 14px; opacity: 0.7; }
  .main-card:hover { transform: translateY(-6px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); }
  .main-card::after {
    content: "Klik Detail →";
    position: absolute;
    bottom: 12px;
    right: 15px;
    font-size: 11px;
    opacity: 0.7;
  }

  .koperasi-main-card { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
  .kkmp-main-card { background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%); }

  /* STATISTIK VIEW */
  .statistik-view, .table-view { display: none; }
  .statistik-view.active, .table-view.active { display: block; animation: slideIn 0.3s ease-out; }
  .statistik-view h3 { margin-bottom: 20px; color: #0d6efd; font-size: 18px; }

  @keyframes slideIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .no-data { text-align: center; padding: 40px; color: #999; }
  .cards.hidden, .main-cards-view.hidden { display: none !important; }

  .back-btn {
    background: #6c757d; color: white; border: none; padding: 8px 16px;
    border-radius: 6px; cursor: pointer; font-size: 14px; margin-bottom: 20px; transition: 0.3s;
  }
  .back-btn:hover { background: #5a6268; }

  .table-view-header {
    display: flex; justify-content: space-between; align-items: center;
    margin-bottom: 20px; border-bottom: 2px solid #0d6efd; padding-bottom: 15px;
  }
  .table-view-header h3 { margin: 0; color: #0d6efd; font-size: 20px; }

  /* FILTER SECTION (GLOBAL) */
  /* Sembunyikan filter global secara default */
  #globalFilterWrapper {
      display: none;
  }

  /* Class untuk menampilkan kembali via JS */
  #globalFilterWrapper.active {
      display: block;
      animation: slideIn 0.3s ease-out;
  }

  .filter-row-single {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 15px; align-items: end;
  }

  .filter-group-single { display: flex; flex-direction: column; }
  .filter-group-single label { font-weight: 600; font-size: 12px; color: #333; margin-bottom: 4px; }
  .filter-group-single select {
    padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px;
    font-size: 13px; background-color: white; width: 100%;
  }
  .filter-group-single select:focus {
    outline: none; border-color: #0d6efd; box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
  }

  .filter-btn-group { display: flex; gap: 8px; align-items: center; }
  .filter-btn {
    padding: 8px 14px; border: none; border-radius: 4px; cursor: pointer;
    font-size: 13px; font-weight: 600; transition: 0.3s; white-space: nowrap;
  }
  .filter-btn-apply { background: #0d6efd; color: white; }
  .filter-btn-apply:hover { background: #0b5ed7; }
  .filter-btn-reset { background: #6c757d; color: white; }
  .filter-btn-reset:hover { background: #5a6268; }

  /* PAGINATION */
  .pagination-wrapper {
    display: flex; justify-content: space-between; align-items: center;
    margin-top: 15px; padding-top: 15px; border-top: 1px solid #e5e7eb; flex-wrap: wrap; gap: 10px;
  }
  .pagination-links { flex: 1; }
  .pagination-info { font-size: 13px; color: #666; white-space: nowrap; }
  .pagination-links nav > div:first-of-type, .pagination-links nav > div > p.text-sm,
  .pagination-links nav > div.sm\:hidden, .pagination-links nav p { display: none !important; }
  .pagination-links ul, .pagination-links .relative.z-0.inline-flex {
    display: inline-flex; align-items: center; gap: 4px; margin: 0; padding: 0; box-shadow: none !important;
  }
  .pagination-links li, .pagination-links .relative.z-0.inline-flex > span,
  .pagination-links .relative.z-0.inline-flex > a { list-style: none; display: flex; }
  .pagination-links a, .pagination-links span {
    display: inline-flex; align-items: center; justify-content: center; min-width: 32px;
    height: 32px; padding: 0 10px; border-radius: 6px !important; border: 1px solid #dbe2ea;
    background: #ffffff; color: #334155; text-decoration: none; font-size: 13px; font-weight: 600;
    transition: all 0.18s ease; margin: 0 !important;
  }
  .pagination-links a:hover { background: #f8fafc; border-color: #cbd5e1; transform: translateY(-1px); }
  .pagination-links .active span, .pagination-links span[aria-current="page"] span {
    background: #0d6efd !important; color: #ffffff !important; border-color: #0d6efd !important;
  }
  .pagination-links .disabled span, .pagination-links span[aria-disabled="true"] span,
  .pagination-links span[aria-disabled="true"] {
    color: #94a3b8 !important; background: #f8fafc !important; border-color: #e2e8f0 !important; cursor: not-allowed;
  }
  .pagination-links svg { width: 14px !important; height: 14px !important; stroke-width: 2.5; }

  /* RESPONSIVE LAYOUT */
  @media (max-width: 768px) {
    .filter-btn-group { flex-direction: column; }
    .filter-btn { width: 100%; }
    .pagination-wrapper { flex-direction: column-reverse; justify-content: center; text-align: center; padding: 16px; }
    .pagination-links { width: 100%; justify-content: center; }
    .data-table { font-size: 12px; }
    .data-table th, .data-table td { padding: 10px 8px; }
    .content-wrapper-box { padding: 15px; }
    
    .toggle-btn { display: block; font-size: 24px; cursor: pointer; margin-right: 15px; }
    .sidebar {
      position: fixed; left: -250px; top: 0; height: 100vh; z-index: 1000; transition: left 0.3s ease;
    }
    .sidebar.active { left: 0; }
    .main { margin-left: 0 !important; width: 100%; }
    .cards, .main-cards-view { grid-template-columns: 1fr !important; gap: 15px; }
  }
  
  .toggle-btn { display: none; }
  @media screen and (max-width: 768px) { .toggle-btn { display: block; } }
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
    <h2>Bidang Koperasi</h2>

    <div id="globalFilterWrapper" class="content-wrapper-box" style="margin-bottom: 30px;">
        <form method="GET" action="{{ url()->current() }}" id="globalFilterForm">
            <input type="hidden" name="view" id="current_view_input" value="{{ request('view') }}">
            
            <div class="filter-row-single">
                <div class="filter-group-single">
                    <label>Kecamatan</label>
                    <select name="kecamatan_id" id="global_kecamatan">
                        <option value="">Semua Kecamatan</option>
                        @foreach($kecamatan as $kec)
                            <option value="{{ $kec->ID_KECAMATAN }}" {{ request('kecamatan_id') == $kec->ID_KECAMATAN ? 'selected' : '' }}>
                                {{ $kec->NM_KECAMATAN }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group-single">
                    <label>Kelurahan</label>
                    <select name="kelurahan_id" id="global_kelurahan">
                        <option value="">Semua Kelurahan</option>
                        @foreach($kelurahan as $kel)
                            <option value="{{ $kel->ID_KELURAHAN }}" {{ request('kelurahan_id') == $kel->ID_KELURAHAN ? 'selected' : '' }}>
                                {{ $kel->NM_KELURAHAN }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group-single">
                    <label>Tahun</label>
                    <select name="tahun">
                        <option value="">Semua Tahun</option>
                        @foreach($tahunOptions as $thn)
                            <option value="{{ $thn }}" {{ request('tahun') == $thn ? 'selected' : '' }}>
                                {{ $thn }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-btn-group">
                    <button type="submit" class="filter-btn filter-btn-apply">Terapkan Filter</button>
                    <button type="button" class="filter-btn filter-btn-reset" onclick="resetGlobalFilter()">Reset</button>
                </div>
            </div>
        </form>
    </div>
    <div class="main-cards-view" id="mainCardsView">
      <div class="card main-card koperasi-main-card" onclick="showKoperasiCards()">
        <h4>Koperasi</h4>
        <p>Informasi tentang koperasi</p>
      </div>

      <div class="card main-card kkmp-main-card" onclick="showKKMPCards()">
        <h4>KKMP</h4>
        <p>Informasi tentang KKMP</p>
      </div>
    </div>

    <div class="statistik-view" id="koperasiStatistikView">
      <button class="back-btn" onclick="showMainCards()">← Kembali</button>
      <h3>Statistik Koperasi</h3>
      <div class="cards" id="koperasiCardsView">
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
    </div>

    <div class="statistik-view" id="kkmpStatistikView">
      <button class="back-btn" onclick="showMainCards()">← Kembali</button>
      <h3>Statistik KKMP</h3>
      <div class="cards" id="kkmpCardsView">
        <div class="card blue" onclick="showTableView('totalKKMP')">
          <h4>Jumlah KKMP</h4>
          <h2>{{ $totalKKMP }}</h2>
        </div>
      </div>
    </div>


    <div id="totalKoperasi-table" class="table-view">
      <div class="table-view-header">
        <h3><i class="fas fa-building"></i> Data Semua Koperasi</h3>
        <button class="back-btn" onclick="hideTableView()">← Kembali</button>
      </div>
      <div class="content-wrapper-box">
          <div class="table-container">
            @if($allKoperasi->count() > 0)
              <table class="data-table" id="tableKoperasiTotal">
                <thead>
                  <tr>
                    <th>No</th><th>Kecamatan</th><th>Kelurahan</th><th>Tahun</th><th>Jumlah Koperasi</th>
                    <th>Aktif</th><th>Tidak Aktif</th><th>Bermitra</th><th>Mitra Perbankan</th>
                    <th>Padat Karya</th><th>LPJ</th><th>RAT</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($allKoperasi as $k)
                    <tr>
                      <td>{{ ($allKoperasi->currentPage() - 1) * $allKoperasi->perPage() + $loop->iteration }}</td>
                      <td>{{ $k->kecamatan->NM_KECAMATAN ?? '-' }}</td>
                      <td>{{ $k->kelurahan->NM_KELURAHAN ?? '-' }}</td>
                      <td>{{ $k->tahun }}</td>
                      <td>{{ $k->jumlah }}</td>
                      <td>{{ $k->aktif }}</td>
                      <td>{{ $k->tidak_aktif }}</td>
                      <td>{{ $k->bermitra }}</td>
                      <td>{{ $k->mitra_perbankan }}</td>
                      <td>{{ $k->padat_karya }}</td>
                      <td>{{ $k->lpj_lengkap }}</td>
                      <td>{{ $k->pelaksanaan_rat }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="pagination-wrapper">
                <div class="pagination-links">{{ $allKoperasi->links() }}</div>
                <div class="pagination-info">Menampilkan {{ $allKoperasi->firstItem() ?? 0 }} hingga {{ $allKoperasi->lastItem() ?? 0 }} dari {{ $allKoperasi->total() }} data</div>
              </div>
            @else
              <div class="no-data">Tidak ada data koperasi</div>
            @endif
          </div>
      </div>
    </div>

    <div id="koperasiAktif-table" class="table-view">
      <div class="table-view-header">
        <h3><i class="fas fa-check-circle"></i> Data Koperasi Aktif</h3>
        <button class="back-btn" onclick="hideTableView()">← Kembali</button>
      </div>
      <div class="content-wrapper-box">
          <div class="table-container">
            @if($koperasiAktif->count() > 0)
              <table class="data-table" id="tableKoperasiAktif">
                <thead>
                  <tr>
                    <th>No</th><th>Kecamatan</th><th>Kelurahan</th><th>Tahun</th><th>Jumlah Koperasi</th>
                    <th>Aktif</th><th>Tidak Aktif</th><th>Bermitra</th><th>Mitra Perbankan</th>
                    <th>Padat Karya</th><th>LPJ</th><th>RAT</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($koperasiAktif as $k)
                    <tr>
                      <td>{{ ($koperasiAktif->currentPage() - 1) * $koperasiAktif->perPage() + $loop->iteration }}</td>
                      <td>{{ $k->kecamatan->NM_KECAMATAN ?? '-' }}</td>
                      <td>{{ $k->kelurahan->NM_KELURAHAN ?? '-' }}</td>
                      <td>{{ $k->tahun }}</td>
                      <td>{{ $k->jumlah }}</td>
                      <td>{{ $k->aktif }}</td>
                      <td>{{ $k->tidak_aktif }}</td>
                      <td>{{ $k->bermitra }}</td>
                      <td>{{ $k->mitra_perbankan }}</td>
                      <td>{{ $k->padat_karya }}</td>
                      <td>{{ $k->lpj_lengkap }}</td>
                      <td>{{ $k->pelaksanaan_rat }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="pagination-wrapper">
                <div class="pagination-links">{{ $koperasiAktif->links() }}</div>
                <div class="pagination-info">Menampilkan {{ $koperasiAktif->firstItem() ?? 0 }} hingga {{ $koperasiAktif->lastItem() ?? 0 }} dari {{ $koperasiAktif->total() }} data</div>
              </div>
            @else
              <div class="no-data">Tidak ada data koperasi aktif</div>
            @endif
          </div>
      </div>
    </div>

    <div id="koperasiTidakAktif-table" class="table-view">
      <div class="table-view-header">
        <h3><i class="fas fa-times-circle"></i> Data Koperasi Tidak Aktif</h3>
        <button class="back-btn" onclick="hideTableView()">← Kembali</button>
      </div>
      <div class="content-wrapper-box">
          <div class="table-container">
            @if($koperasiTidakAktif->count() > 0)
              <table class="data-table" id="tableKoperasiTidakAktif">
                <thead>
                  <tr>
                    <th>No</th><th>Kecamatan</th><th>Kelurahan</th><th>Tahun</th><th>Jumlah Koperasi</th>
                    <th>Aktif</th><th>Tidak Aktif</th><th>Bermitra</th><th>Mitra Perbankan</th>
                    <th>Padat Karya</th><th>LPJ</th><th>RAT</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($koperasiTidakAktif as $k)
                    <tr>
                      <td>{{ ($koperasiTidakAktif->currentPage() - 1) * $koperasiTidakAktif->perPage() + $loop->iteration }}</td>
                      <td>{{ $k->kecamatan->NM_KECAMATAN ?? '-' }}</td>
                      <td>{{ $k->kelurahan->NM_KELURAHAN ?? '-' }}</td>
                      <td>{{ $k->tahun }}</td>
                      <td>{{ $k->jumlah }}</td>
                      <td>{{ $k->aktif }}</td>
                      <td>{{ $k->tidak_aktif }}</td>
                      <td>{{ $k->bermitra }}</td>
                      <td>{{ $k->mitra_perbankan }}</td>
                      <td>{{ $k->padat_karya }}</td>
                      <td>{{ $k->lpj_lengkap }}</td>
                      <td>{{ $k->pelaksanaan_rat }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="pagination-wrapper">
                <div class="pagination-links">{{ $koperasiTidakAktif->links() }}</div>
                <div class="pagination-info">Menampilkan {{ $koperasiTidakAktif->firstItem() ?? 0 }} hingga {{ $koperasiTidakAktif->lastItem() ?? 0 }} dari {{ $koperasiTidakAktif->total() }} data</div>
              </div>
            @else
              <div class="no-data">Tidak ada data koperasi tidak aktif</div>
            @endif
          </div>
      </div>
    </div>

    <div id="padatKarya-table" class="table-view">
      <div class="table-view-header">
        <h3><i class="fas fa-briefcase"></i> Data Koperasi Padat Karya</h3>
        <button class="back-btn" onclick="hideTableView()">← Kembali</button>
      </div>
      <div class="content-wrapper-box">
          <div class="table-container">
            @if($padatKaryaDetail->count() > 0)
              <table class="data-table" id="tablePadatKarya">
                <thead>
                  <tr>
                    <th>No</th><th>Kecamatan</th><th>Kelurahan</th><th>Tahun</th><th>Jumlah Koperasi</th>
                    <th>Aktif</th><th>Tidak Aktif</th><th>Bermitra</th><th>Mitra Perbankan</th>
                    <th>Padat Karya</th><th>LPJ</th><th>RAT</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($padatKaryaDetail as $k)
                    <tr>
                      <td>{{ ($padatKaryaDetail->currentPage() - 1) * $padatKaryaDetail->perPage() + $loop->iteration }}</td>
                      <td>{{ $k->kecamatan->NM_KECAMATAN ?? '-' }}</td>
                      <td>{{ $k->kelurahan->NM_KELURAHAN ?? '-' }}</td>
                      <td>{{ $k->tahun }}</td>
                      <td>{{ $k->jumlah }}</td>
                      <td>{{ $k->aktif }}</td>
                      <td>{{ $k->tidak_aktif }}</td>
                      <td>{{ $k->bermitra }}</td>
                      <td>{{ $k->mitra_perbankan }}</td>
                      <td>{{ $k->padat_karya }}</td>
                      <td>{{ $k->lpj_lengkap }}</td>
                      <td>{{ $k->pelaksanaan_rat }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="pagination-wrapper">
                <div class="pagination-links">{{ $padatKaryaDetail->links() }}</div>
                <div class="pagination-info">Menampilkan {{ $padatKaryaDetail->firstItem() ?? 0 }} hingga {{ $padatKaryaDetail->lastItem() ?? 0 }} dari {{ $padatKaryaDetail->total() }} data</div>
              </div>
            @else
              <div class="no-data">Tidak ada data padat karya</div>
            @endif
          </div>
      </div>
    </div>

    <div id="pelaksanaanRat-table" class="table-view">
      <div class="table-view-header">
        <h3><i class="fas fa-chart-bar"></i> Data Pelaksanaan RAT</h3>
        <button class="back-btn" onclick="hideTableView()">← Kembali</button>
      </div>
      <div class="content-wrapper-box">
          <div class="table-container">
            @if($pelaksanaanRatDetail->count() > 0)
              <table class="data-table" id="tablePelaksanaanRat">
                <thead>
                  <tr>
                    <th>No</th><th>Kecamatan</th><th>Kelurahan</th><th>Tahun</th><th>Jumlah Koperasi</th>
                    <th>Aktif</th><th>Tidak Aktif</th><th>Bermitra</th><th>Mitra Perbankan</th>
                    <th>Padat Karya</th><th>LPJ</th><th>RAT</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($pelaksanaanRatDetail as $k)
                    <tr>
                      <td>{{ ($pelaksanaanRatDetail->currentPage() - 1) * $pelaksanaanRatDetail->perPage() + $loop->iteration }}</td>
                      <td>{{ $k->kecamatan->NM_KECAMATAN ?? '-' }}</td>
                      <td>{{ $k->kelurahan->NM_KELURAHAN ?? '-' }}</td>
                      <td>{{ $k->tahun }}</td>
                      <td>{{ $k->jumlah }}</td>
                      <td>{{ $k->aktif }}</td>
                      <td>{{ $k->tidak_aktif }}</td>
                      <td>{{ $k->bermitra }}</td>
                      <td>{{ $k->mitra_perbankan }}</td>
                      <td>{{ $k->padat_karya }}</td>
                      <td>{{ $k->lpj_lengkap }}</td>
                      <td>{{ $k->pelaksanaan_rat }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="pagination-wrapper">
                <div class="pagination-links">{{ $pelaksanaanRatDetail->links() }}</div>
                <div class="pagination-info">Menampilkan {{ $pelaksanaanRatDetail->firstItem() ?? 0 }} hingga {{ $pelaksanaanRatDetail->lastItem() ?? 0 }} dari {{ $pelaksanaanRatDetail->total() }} data</div>
              </div>
            @else
              <div class="no-data">Tidak ada data RAT</div>
            @endif
          </div>
      </div>
    </div>

    <div id="totalKKMP-table" class="table-view">
      <div class="table-view-header">
        <h3><i class="fas fa-briefcase"></i> Data KKMP</h3>
        <button class="back-btn" onclick="hideTableView()">← Kembali</button>
      </div>
      <div class="content-wrapper-box">
          <div class="table-container">
            @if($allKKMP->count() > 0)
              <table class="data-table" id="tableKKMP">
                <thead>
                  <tr>
                    <th>No</th><th>Kecamatan</th><th>Kelurahan</th><th>Tahun</th><th>Nama KKMP</th>
                    <th>Alamat</th><th>No. Badan Hukum</th><th>Jenis KKMP</th><th>Jumlah Anggota</th><th>Total Omzet</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($allKKMP as $k)
                    <tr>
                      <td>{{ ($allKKMP->currentPage() - 1) * $allKKMP->perPage() + $loop->iteration }}</td>
                      <td>{{ $k->kecamatan->NM_KECAMATAN ?? '-' }}</td>
                      <td>{{ $k->kelurahan->NM_KELURAHAN ?? '-' }}</td>
                      <td>{{ $k->tahun }}</td>
                      <td>{{ $k->nama_kkmp ?? '-' }}</td>
                      <td>{{ $k->alamat ?? '-' }}</td>
                      <td>{{ $k->no_badan_hukum ?? '-' }}</td>
                      <td>{{ $k->jenis_kkmp ?? '-' }}</td>
                      <td>{{ $k->jumlah_anggota ?? '-' }}</td>
                      <td>Rp. {{ number_format($k->total_omzet ?? 0, 0, ',', '.') }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="pagination-wrapper">
                <div class="pagination-links">{{ $allKKMP->links() }}</div>
                <div class="pagination-info">Menampilkan {{ $allKKMP->firstItem() ?? 0 }} hingga {{ $allKKMP->lastItem() ?? 0 }} dari {{ $allKKMP->total() }} data</div>
              </div>
            @else
              <div class="no-data">Tidak ada data KKMP</div>
            @endif
          </div>
      </div>
    </div>

  </div> 
</div> 
<script>
// TANGGAL DI SIDEBAR
document.addEventListener('DOMContentLoaded', function() {
    const elTanggal = document.getElementById('tanggalSidebar');
    if (elTanggal) {
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        elTanggal.textContent = now.toLocaleDateString('id-ID', options);
    }

    // AJAX KELURAHAN (Berdasarkan Kecamatan yang dipilih di Global Filter)
    const kecSelect = document.getElementById('global_kecamatan');
    const kelSelect = document.getElementById('global_kelurahan');

    if (kecSelect) {
        kecSelect.addEventListener('change', function() {
            const id = this.value;
            kelSelect.innerHTML = '<option value="">Semua Kelurahan</option>';

            if (id) {
                fetch(`/get-kelurahan/${id}`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(kel => {
                            const opt = document.createElement('option');
                            opt.value = kel.ID_KELURAHAN;
                            opt.textContent = kel.NM_KELURAHAN;
                            kelSelect.appendChild(opt);
                        });
                    })
                    .catch(error => console.error('Error fetching kelurahan:', error));
            }
        });
    }

    // LOGIKA PENAHAN TAMPILAN VIEW SAAT REFRESH / PAGINATION
    const urlParams = new URLSearchParams(window.location.search);
    const currentView = urlParams.get('view');

    // Jika ada parameter view, filter, atau pagination aktif, otomatis tampilkan filter
    if (currentView || urlParams.has('total_p') || urlParams.has('aktif_p') || urlParams.has('tidak_aktif_p') || urlParams.has('padat_karya_p') || urlParams.has('pelaksanaan_rat_p') || urlParams.has('kkmp_p') || urlParams.has('kecamatan_id')) {
        toggleGlobalFilter(true);
    } else {
        // Jika tidak ada apa-apa (halaman awal murni), sembunyikan filter
        toggleGlobalFilter(false);
    }

    // Buka tampilan yang relevan
    if (urlParams.has('total_p') || currentView === 'totalKoperasi') {
        showTableView('totalKoperasi');
    } else if (urlParams.has('aktif_p') || currentView === 'koperasiAktif') {
        showTableView('koperasiAktif');
    } else if (urlParams.has('tidak_aktif_p') || currentView === 'koperasiTidakAktif') {
        showTableView('koperasiTidakAktif');
    } else if (urlParams.has('padat_karya_p') || currentView === 'padatKarya') {
        showTableView('padatKarya');
    } else if (urlParams.has('pelaksanaan_rat_p') || currentView === 'pelaksanaanRat') {
        showTableView('pelaksanaanRat');
    } else if (urlParams.has('kkmp_p') || currentView === 'totalKKMP') {
        showTableView('totalKKMP');
    } else if (currentView === 'koperasiCards') {
        showKoperasiCards();
    } else if (currentView === 'kkmpCards') {
        showKKMPCards();
    } else {
        showMainCards();
    }
});

// FUNGSI TOGGLE FILTER GLOBAL
function toggleGlobalFilter(show) {
    const filterWrapper = document.getElementById('globalFilterWrapper');
    if (filterWrapper) {
        if (show) {
            filterWrapper.classList.add('active');
        } else {
            filterWrapper.classList.remove('active');
        }
    }
}

// TOGGLE SIDEBAR UNTUK LAYAR KECIL (HP)
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('active');
}

document.addEventListener('click', function(event) {
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.querySelector(".toggle-btn");
    if (window.innerWidth <= 768 && sidebar && toggleBtn) {
        if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
            sidebar.classList.remove("active");
        }
    }
});

function logout(){
  localStorage.removeItem("login");
  window.location.href = "/";
}

// UPDATE HIDDEN INPUT KETIKA BERPINDAH MENU
function updateCurrentView(viewName) {
    const viewInput = document.getElementById('current_view_input');
    if (viewInput) viewInput.value = viewName;
}

// MAIN CARD NAVIGATION (Halaman Utama)
function showMainCards() {
  updateCurrentView('');
  toggleGlobalFilter(false); // SEMBUNYIKAN FILTER
  document.querySelectorAll('.statistik-view.active').forEach(v => v.classList.remove('active'));
  document.querySelectorAll('.table-view.active').forEach(t => t.classList.remove('active'));
  document.getElementById('mainCardsView').classList.remove('hidden');
  window.scrollTo(0, 0);
}

// SUB MENU KOPERASI
function showKoperasiCards() {
  updateCurrentView('koperasiCards');
  toggleGlobalFilter(true); // TAMPILKAN FILTER
  document.getElementById('mainCardsView').classList.add('hidden');
  document.getElementById('koperasiStatistikView').classList.add('active');
  window.scrollTo(0, 0);
}

// SUB MENU KKMP
function showKKMPCards() {
  updateCurrentView('kkmpCards');
  toggleGlobalFilter(true); // TAMPILKAN FILTER
  document.getElementById('mainCardsView').classList.add('hidden');
  document.getElementById('kkmpStatistikView').classList.add('active');
  window.scrollTo(0, 0);
}

// TABLE VIEW NAVIGATION
function showTableView(tableId) {
  updateCurrentView(tableId);
  toggleGlobalFilter(true); // TAMPILKAN FILTER
  window.currentStatistikView = (tableId.includes('KKMP') || tableId === 'totalKKMP') ? 'kkmp' : 'koperasi';
  
  document.getElementById('mainCardsView').classList.add('hidden');
  document.querySelectorAll('.statistik-view.active').forEach(v => v.classList.remove('active'));
  document.querySelectorAll('.table-view.active').forEach(t => t.classList.remove('active'));
  
  const table = document.getElementById(tableId + '-table');
  if (table) table.classList.add('active');
  window.scrollTo({ top: 300, behavior: 'smooth' }); // Sedikit scroll otomatis ke area tabel
}

function hideTableView() {
  document.querySelectorAll('.table-view.active').forEach(t => t.classList.remove('active'));
  
  // Deteksi harus kembali ke statistik view Koperasi atau KKMP
  if (window.currentStatistikView === 'kkmp') {
    showKKMPCards();
  } else {
    showKoperasiCards();
  }
}
// FUNGSI RESET FILTER (HAPUS FILTER TAPI TETAP DI VIEW YANG SAMA)
function resetGlobalFilter() {
    // Ambil data view apa yang sedang aktif saat ini
    const viewInput = document.getElementById('current_view_input');
    const currentView = viewInput ? viewInput.value : '';

    let newUrl = window.location.pathname;
    let hash = '';

    if (currentView) {
        // Jika sedang di tampilan detail/tabel, pertahankan parameter view
        newUrl += '?view=' + currentView;
        
        // Tambahkan anchor (#) jika sedang di dalam tabel agar auto-scroll
        if (!currentView.includes('Cards')) {
            hash = '#' + currentView + '-table';
        }
    }

    // Arahkan ke URL baru (Membersihkan filter seperti kecamatan_id & tahun, tanpa pindah halaman)
    window.location.href = newUrl + hash;
}
</script>
</body>
</html>