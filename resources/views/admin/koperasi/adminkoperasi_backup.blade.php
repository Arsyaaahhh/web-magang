<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin Koperasi & Pegawai</title>

  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: #f8fafc;
    }

    main {
      flex: 1;
      display: flex;
      flex-direction: column;
      margin-left: 240px;
    }

    /* NAVBAR */
    .navbar {
      background: white;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    }

    .navbar h3 {
      color: #0d6efd;
    }

    /* CONTAINER */
    .container {
      padding: 30px;
    }

    /* TABS */
    .tabs {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
      border-bottom: 2px solid #e5e7eb;
    }

    .tab-btn {
      padding: 12px 24px;
      border: none;
      background: transparent;
      cursor: pointer;
      font-size: 16px;
      font-weight: 600;
      color: #6b7280;
      border-bottom: 3px solid transparent;
      transition: 0.3s ease;
      margin-bottom: -2px;
    }

    .tab-btn.active {
      color: #0d6efd;
      border-bottom-color: #0d6efd;
    }

    .tab-btn:hover {
      color: #0d6efd;
    }

    .tab-content {
      display: none;
    }

    .tab-content.active {
      display: block;
    }

    /* HEADER */
    .top {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
    }

    /* BUTTON */
    .btn {
      padding: 8px 14px;
      border-radius: 8px;
      font-size: 14px;
      border: none;
      cursor: pointer;
      text-decoration:none;
    }

    .btn-add {
      background: #20c997;
      color: white;
      font-size:18px !important;
    }

    .btn-add:hover{
      background:#1aa179;
      transition:0.2s ease;
    }

    .btn-edit {
      background: #ffc107;
      color: black;
    }

    .btn-delete {
      background: #dc3545;
      color: white;
    }

    /* CARD */
    .card {
      background: white;
      padding: 20px;
      border-radius: 12px;
      border: 1px solid #e5e7eb;
    }

    /* FILTER */
    .filter {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 10px;
      margin-bottom: 15px;
    }

    .filter input,
    .filter select {
      padding: 8px;
      border-radius: 6px;
      border: 1px solid #d1d5db;
    }

    .filter button {
      grid-column: 1 / -1;
    }

    .filter button:hover {
      background: #0d6efd;
      color: white;
    }

    /* TABLE */
    .table-wrapper {
      width: 100%;
      overflow-x: auto;
      margin: 0 auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border: 1px solid #e5e7eb;
      color: #333;
      table-layout: fixed;
      margin: 0 auto;
    }

    th,
    td {
      padding: 10px 12px;
      text-align: center;
      vertical-align: middle;
      white-space: normal;
    }

    /* KOPERASI TABLE */
    .table-koperasi th:nth-child(1),
    .table-koperasi td:nth-child(1) {
      width: 40px;
    }

    .table-koperasi th:nth-child(2),
    .table-koperasi td:nth-child(2) {
      width: 100px;
    }

    .table-koperasi th:nth-child(3),
    .table-koperasi td:nth-child(3) {
      width: 80px;
    }

    .table-koperasi th:nth-child(4),
    .table-koperasi td:nth-child(4),
    .table-koperasi th:nth-child(5),
    .table-koperasi td:nth-child(5),
    .table-koperasi th:nth-child(6),
    .table-koperasi td:nth-child(6) {
      width: 110px;
    }

    .table-koperasi th:nth-child(7),
    .table-koperasi td:nth-child(7),
    .table-koperasi th:nth-child(8),
    .table-koperasi td:nth-child(8) {
      width: 120px;
    }

    .table-koperasi th:nth-child(9),
    .table-koperasi td:nth-child(9) {
      width: 140px;
    }

    /* PEGAWAI TABLE */
    .table-pegawai th:nth-child(1),
    .table-pegawai td:nth-child(1) {
      width: 40px;
    }

    .table-pegawai th:nth-child(2),
    .table-pegawai td:nth-child(2) {
      width: 120px;
    }

    .table-pegawai th:nth-child(3),
    .table-pegawai td:nth-child(3),
    .table-pegawai th:nth-child(4),
    .table-pegawai td:nth-child(4) {
      width: 130px;
    }

    .table-pegawai th:nth-child(5),
    .table-pegawai td:nth-child(5) {
      width: 140px;
    }

    th {
      background: #eaf2ff;
    }

    td {
      border-bottom: 1px solid #e5e7eb;
    }

    tbody tr:nth-child(even) {
      background: #f9fafb;
    }

    tr:hover {
      background: #eef4ff;
    }

    /* BADGE */
    .badge {
      padding: 5px 10px;
      border-radius: 6px;
      font-size: 12px;
      background: #e5e7eb;
      white-space: nowrap;
      display: inline-flex;
      align-items: center;
    }

    /* ACTION */
    .action {
      display: flex;
      gap: 6px;
    }

    .action .btn {
      padding: 8px 12px;
      font-size: 13px;
      white-space: nowrap;
    }

    /* ALERT */
    .alert {
      padding: 10px;
      margin-bottom: 10px;
      background: #d1e7dd;
      border-radius: 6px;
    }

    /* PAGINATION */
    .pagination-wrapper {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 15px;
      flex-wrap: wrap;
      gap: 10px;
    }

    .pagination {
      display: flex;
      gap: 6px;
    }

    .pagination li {
      list-style: none;
    }

    .pagination a,
    .pagination span {
      display: inline-block;
      padding: 6px 12px;
      border-radius: 8px;
      border: 1px solid #d1d5db;
      background: white;
      color: #333;
      text-decoration: none;
      font-size: 14px;
      transition: 0.2s;
    }

    .pagination a:hover {
      background: #0d6efd;
      color: white;
    }

    .pagination .active span {
      background: #0d6efd;
      color: white;
      border-color: #0d6efd;
    }

    .pagination .disabled span {
      color: #aaa;
      background: #f3f4f6;
    }

    .pagination-info {
      font-size: 13px;
      color: #666;
    }
  </style>
</head>

<body>

  <!-- SIDEBAR -->
  <div class="sidebar">
    <h2>DINKOPUMDAG</h2>
    <div class="sidebar-date" id="tanggalSidebar"></div>

    <div class="menu">
      <a href="/admin/index"><i class="fas fa-user-tie"></i> Bidang Sekretariat</a>
      <a href="/admin/adminpum"><i class="fas fa-store"></i> Pemberdayaan Usaha Mikro</a>
      <a href="/admin/distribusi"><i class="fas fa-truck"></i> Distribusi Perdagangan</a>
      <a href="/admin/koperasi/adminkoperasi" class="active"><i class="fas fa-building"></i> Bidang Koperasi</a>
      <a href="/admin/pembinaan"><i class="fas fa-briefcase"></i> Pembinaan Usaha Perdagangan</a>
      <a href="/admin/metrologi"><i class="fas fa-balance-scale"></i> UPTD Metrologi Legal</a>
    </div>

    <button onclick="logout()" class="logout-btn">
      <i class="fas fa-sign-out-alt"></i> Keluar
    </button>
  </div>

  <!-- MAIN -->
  <main>

    <!-- NAVBAR -->
    <div class="navbar">
      <h3>Bidang Koperasi</h3>

      <div style="display:flex; gap:10px; align-items:center;">
        <span>Halo {{ session('username') ?? 'Admin' }} 👋</span>
        <button onclick="logout()" class="btn btn-delete">Logout</button>
      </div>
    </div>

    <!-- CONTENT -->
    <div class="container">

      @if(session('success'))
        <div class="alert">
          {{ session('success') }}
        </div>
      @endif

      <!-- TABS -->
      <div class="tabs">
        <button class="tab-btn active" onclick="switchTab('koperasi')">
          <i class="fas fa-building"></i> Data Koperasi
        </button>
        <button class="tab-btn" onclick="switchTab('pegawai')">
          <i class="fas fa-users"></i> Data Pegawai
        </button>
      </div>

      <!-- TAB KOPERASI -->
      <div id="koperasi" class="tab-content active">
        <div class="top">
          <h2>Data Koperasi</h2>
          <a href="/admin/koperasi/create" class="btn btn-add">+ Tambah</a>
        </div>

        <div class="card">

          <!-- FILTER KOPERASI -->
          <form method="GET">
            <div class="filter">

              <input
                type="text"
                name="search"
                placeholder="Cari jumlah, status, mitra, jenis, kelurahan, kecamatan..."
                value="{{ request('search') }}"
              >

              <select name="status">
                <option value="">Semua Status</option>
                <option value="aktif" {{ request('status')=='aktif'?'selected':'' }}>Aktif</option>
                <option value="tidak aktif" {{ request('status')=='tidak aktif'?'selected':'' }}>Tidak Aktif</option>
              </select>

              <select name="status_mitra">
                <option value="">Semua Mitra</option>
                <option value="bermitra" {{ request('status_mitra')=='bermitra'?'selected':'' }}>Bermitra</option>
                <option value="belum" {{ request('status_mitra')=='belum'?'selected':'' }}>Belum</option>
              </select>

              <select name="jenis_mitra">
                <option value="">Semua Jenis Mitra</option>
                <option value="perbankan" {{ request('jenis_mitra')=='perbankan'?'selected':'' }}>Perbankan</option>
                <option value="non" {{ request('jenis_mitra')=='non'?'selected':'' }}>Non Perbankan</option>          
              </select>

              <button type="submit" class="btn">Filter</button>

            </div>
          </form>

          <!-- TABLE KOPERASI -->
          <div class="table-wrapper">
            <table class="table-koperasi">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Jumlah Koperasi</th>
                  <th>Tahun</th>
                  <th>Status</th>
                  <th>Status Mitra</th>
                  <th>Jenis Mitra</th>
                  <th>Kelurahan</th>
                  <th>Kecamatan</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody>
                @forelse($dataKoperasi as $d)
                  <tr>
                    <td>{{ ($dataKoperasi->currentPage()-1)*$dataKoperasi->perPage() + $loop->iteration }}</td>
                    <td>{{ $d->jumlah }}</td>
                    <td>{{ $d->tahun }}</td>
                    <td><span class="badge" style="background: {{ $d->status == 'aktif' ? '#d1e7dd' : '#f8d7da' }}">{{ ucfirst($d->status) }}</span></td>
                    <td>{{ ucfirst($d->status_mitra) }}</td>
                    <td>{{ ucfirst($d->jenis_mitra) }}</td>
                    <td>{{ $d->kelurahan->NM_KELURAHAN ?? '-' }}</td>
                    <td>{{ $d->kecamatan->NM_KECAMATAN ?? '-' }}</td>
                    <td>
                      <div class="action">
                        <a href="/admin/koperasi/edit/{{ $d->id }}" class="btn btn-edit">Edit</a>
                        <button onclick="confirmDelete('/admin/koperasi/delete/{{ $d->id }}')" class="btn btn-delete">
                          Hapus
                        </button>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="9" style="text-align:center;">Tidak ada data</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <!-- PAGINATION KOPERASI -->
          <div class="pagination-wrapper">
            <div class="pagination">
              {{ $dataKoperasi->links('components.pagination', ['paginator' => $dataKoperasi]) }}
            </div>

            <div class="pagination-info">
              Menampilkan {{ $dataKoperasi->firstItem() ?? 0 }} hingga {{ $dataKoperasi->lastItem() ?? 0 }} dari {{ $dataKoperasi->total() }} data
            </div>
          </div>

        </div>
      </div>

      <!-- TAB PEGAWAI -->
      <div id="pegawai" class="tab-content">
        <div class="top">
          <h2>Data Pegawai</h2>
          <a href="/admin/pegawai/create" class="btn btn-add">+ Tambah</a>
        </div>

        <div class="card">

          <!-- FILTER PEGAWAI -->
          <form method="GET">
            <div class="filter">

              <input
                type="text"
                name="search_pegawai"
                placeholder="Cari jumlah, status, program..."
                value="{{ request('search_pegawai') }}"
              >

              <select name="status_pegawai">
                <option value="">Semua Status</option>
                <option value="pns" {{ request('status_pegawai')=='pns'?'selected':'' }}>PNS</option>
                <option value="non_pns" {{ request('status_pegawai')=='non_pns'?'selected':'' }}>Non PNS</option>
              </select>

              <select name="program_pegawai">
                <option value="">Semua Program</option>
                <option value="diklat" {{ request('program_pegawai')=='diklat'?'selected':'' }}>Diklat</option>
                <option value="bimtek" {{ request('program_pegawai')=='bimtek'?'selected':'' }}>Bimtek</option>
                <option value="tidak ada" {{ request('program_pegawai')=='tidak ada'?'selected':'' }}>Tidak Ada</option>
              </select>

              <button type="submit" class="btn">Filter</button>

            </div>
          </form>

          <!-- TABLE PEGAWAI -->
          <div class="table-wrapper">
            <table class="table-pegawai">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Jumlah Pegawai</th>
                  <th>Status</th>
                  <th>Program</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody>
                @forelse($dataPegawai as $p)
                  <tr>
                    <td>{{ ($dataPegawai->currentPage()-1)*$dataPegawai->perPage() + $loop->iteration }}</td>
                    <td>{{ $p->jumlah_pegawai }}</td>
                    <td><span class="badge">{{ ucfirst(str_replace('_', ' ', $p->status)) }}</span></td>
                    <td>{{ ucfirst($p->program) }}</td>
                    <td>
                      <div class="action">
                        <a href="/admin/pegawai/edit/{{ $p->id }}" class="btn btn-edit">Edit</a>
                        <button onclick="confirmDelete('/admin/pegawai/delete/{{ $p->id }}')" class="btn btn-delete">
                          Hapus
                        </button>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" style="text-align:center;">Tidak ada data</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <!-- PAGINATION PEGAWAI -->
          <div class="pagination-wrapper">
            <div class="pagination">
              {{ $dataPegawai->links('components.pagination', ['paginator' => $dataPegawai]) }}
            </div>

            <div class="pagination-info">
              Menampilkan {{ $dataPegawai->firstItem() ?? 0 }} hingga {{ $dataPegawai->lastItem() ?? 0 }} dari {{ $dataPegawai->total() }} data
            </div>
          </div>

        </div>
      </div>

    </div>

  </main>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    // TANGGAL SIDEBAR
    const tanggalSidebar = document.getElementById('tanggalSidebar');

    if (tanggalSidebar) {
      const hariNama = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
      const bulanNama = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

      const sekarang = new Date();

      const hari = hariNama[sekarang.getDay()];
      const tanggal = sekarang.getDate();
      const bulan = bulanNama[sekarang.getMonth()];
      const tahun = sekarang.getFullYear();

      tanggalSidebar.textContent = `${hari}, ${tanggal} ${bulan} ${tahun}`;
    }

    // SWITCH TABS
    function switchTab(tab) {
      // Hide all tabs
      document.querySelectorAll('.tab-content').forEach(el => {
        el.classList.remove('active');
      });

      // Remove active class from all buttons
      document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
      });

      // Show selected tab
      document.getElementById(tab).classList.add('active');

      // Add active class to clicked button
      event.target.classList.add('active');
    }

    // DELETE
    function confirmDelete(url) {
      Swal.fire({
        title: 'Yakin?',
        text: "Data akan dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Ya, hapus!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = url;
        }
      });
    }

    // LOGOUT
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
