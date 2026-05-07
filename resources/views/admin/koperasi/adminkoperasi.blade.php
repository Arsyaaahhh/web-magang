<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Koperasi & Pegawai</title>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <style>
    *{
      margin:0;
      padding:0;
      box-sizing:border-box;
      font-family:'Poppins',sans-serif;
    }

    body{
      background:#f8fafc;
      display:flex;
      min-height:100vh;
      overflow-x:hidden;
    }

    /* OVERLAY UNTUK MOBILE */
    .overlay {
      display: none;
      position: fixed;
      top: 0; left: 0; width: 100%; height: 100%;
      background: rgba(0,0,0,0.5);
      z-index: 999;
    }

    /* SIDEBAR */
    .sidebar{
      width:240px;
      height:100vh;
      background:#0d6efd;
      color:white;
      padding:20px;
      position:fixed;
      top:0;
      left:0;
      overflow-y:auto;
      z-index:1000;
      transition: left 0.3s ease;
    }

    .sidebar h2{
      margin-bottom:30px;
      font-size:20px;
      font-weight:600;
    }

    .sidebar a{
      display:block;
      color:white;
      text-decoration:none;
      padding:12px 14px;
      border-radius:10px;
      margin-bottom:10px;
      transition:0.2s ease;
      font-size:15px;
    }

    .sidebar a i{
      margin-right:10px;
      width:18px;
    }

    .sidebar a:hover,
    .sidebar a.active{
      background:rgba(255,255,255,0.2);
    }

    .logout-btn{
      width:100%;
      margin-top:25px;
      padding:12px;
      border:none;
      border-radius:10px;
      background:#dc3545;
      color:white;
      cursor:pointer;
      font-size:15px;
      transition:0.2s ease;
    }

    .logout-btn:hover{
      background:#bb2d3b;
    }

    /* MAIN */
    main{
      margin-left:240px;
      width:calc(100% - 240px);
      min-height:100vh;
      display:flex;
      flex-direction:column;
      transition: margin-left 0.3s ease, width 0.3s ease;
    }

    /* NAVBAR */
    .navbar{
      background:white;
      padding:18px 30px;
      display:flex;
      justify-content:space-between;
      align-items:center;
      border-bottom:1px solid #e5e7eb;
      box-shadow:0 2px 10px rgba(0,0,0,0.04);
    }

    .navbar-left {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .menu-toggle {
      display: none;
      background: none;
      border: none;
      font-size: 20px;
      cursor: pointer;
      color: #0d6efd;
    }

    .navbar h3{
      color:#0d6efd;
      font-size:22px;
      font-weight:600;
    }

    .navbar-right{
      display:flex;
      align-items:center;
      gap:12px;
      font-size:14px;
      color:#555;
    }

    /* CONTAINER */
    .container{
      padding:30px;
    }

    /* ALERT */
    .alert{
      padding:12px;
      border-radius:8px;
      background:#d1e7dd;
      margin-bottom:20px;
      color:#0f5132;
    }

    /* TABS */
    .tabs{
      display:flex;
      gap:10px;
      margin-bottom:25px;
      border-bottom:2px solid #e5e7eb;
    }

    .tab-btn{
      padding:12px 20px;
      border:none;
      background:none;
      cursor:pointer;
      font-size:15px;
      font-weight:600;
      color:#6b7280;
      border-bottom:3px solid transparent;
      transition:0.2s ease;
    }

    .tab-btn.active{
      color:#0d6efd;
      border-bottom-color:#0d6efd;
    }

    .tab-content{
      display:none;
    }

    .tab-content.active{
      display:block;
    }

    /* TOP */
    .top{
      display:flex;
      justify-content:space-between;
      align-items:center;
      margin-bottom:20px;
      flex-wrap: wrap;
      gap: 10px;
    }

    /* BUTTON */
    .btn{
      padding:8px 14px;
      border:none;
      border-radius:8px;
      cursor:pointer;
      text-decoration:none;
      font-size:14px;
      transition:0.2s ease;
      display: inline-block;
    }

    .btn-add{
      background:#20c997;
      color:white;
    }
    .btn-add:hover{
      background:#1aa179;
    }

    /* TAMBAHAN UNTUK TOMBOL KEMBALI */
    .btn-back {
      background: #6c757d;
      color: white;
    }
    .btn-back:hover {
      background: #5a6268;
    }

    .btn-edit{
      background:#ffc107;
      color:black;
    }

    .btn-delete{
      background:#dc3545;
      color:white;
    }

    /* CARD */
    .card{
      background:white;
      border-radius:14px;
      padding:20px;
      border:1px solid #e5e7eb;
    }

    /* FILTER */
    .filter{
      display:grid;
      grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
      gap:10px;
      margin-bottom:20px;
    }

    .filter input,
    .filter select{
      padding:10px;
      border:1px solid #d1d5db;
      border-radius:8px;
      outline:none;
    }

    .filter button{
      background:#0d6efd;
      color:white;
    }

    /* TABLE */
    .table-wrapper{
      width:100%;
      overflow-x:auto;
      -webkit-overflow-scrolling: touch;
    }

    table{
      width:100%;
      border-collapse:collapse;
      min-width:900px;
    }

    th{
      background:#eaf2ff;
      color:#333;
      font-weight:600;
    }

    th,
    td{
      padding:12px;
      text-align:center;
      border-bottom:1px solid #e5e7eb;
      white-space:nowrap;
    }

    tbody tr:nth-child(even){
      background:#f9fafb;
    }

    tbody tr:hover{
      background:#eef4ff;
    }

    /* BADGE */
    .badge{
      display:inline-block;
      padding:5px 10px;
      border-radius:6px;
      font-size:12px;
      background:#e5e7eb;
    }

    /* ACTION */
    .action{
      display:flex;
      justify-content:center;
      gap:6px;
    }

    /* PAGINATION */
    .pagination-wrapper{
      margin-top:20px;
      display:flex;
      justify-content:space-between;
      align-items:center;
      flex-wrap:wrap;
      gap:10px;
    }

    .pagination-info{
      font-size:13px;
      color:#666;
    }

    /* 🔥 MEDIA QUERY RESPONSIVE (SMARTPHONE) */
    @media(max-width:768px){
      .sidebar { left: -240px; }
      .sidebar.active { left: 0; }
      main { margin-left: 0; width: 100%; }
      .menu-toggle { display: block; }
      .overlay.active { display: block; }
      .navbar { padding: 15px 20px; }
      .navbar h3 { font-size: 18px; }
      .container { padding: 15px; }
      .top { flex-direction: column; align-items: flex-start; }
      .filter { grid-template-columns: 1fr; }
    }
  </style>
</head>

<body>

  <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

  <div class="sidebar" id="sidebarMenu">

    <h2>ADMIN</h2>

    <a href="/admin/admin_sekre">
      <i class="fas fa-user-tie"></i>
      Sekretariat
    </a>

    <a href="/admin/admin_pum">
      <i class="fas fa-store"></i>
      Pemberdayaan Usaha Mikro
    </a>

    <a href="/admin/admin_pup/adminpup">
      <i class="fas fa-briefcase"></i>
      Pembinaan
    </a>

    <a class="active" href="/admin/koperasi">
      <i class="fas fa-building"></i>
      Koperasi
    </a>

    <a href="/admin/admin_perdagangan">
      <i class="fas fa-truck"></i>
      Perdagangan
    </a>

    <button onclick="logout()" class="logout-btn">
      <i class="fas fa-sign-out-alt"></i>
      Logout
    </button>

  </div>

  <main>

    <div class="navbar">

      <div class="navbar-left">
        <button class="menu-toggle" onclick="toggleSidebar()">
          <i class="fas fa-bars"></i>
        </button>
        <h3>Bidang Koperasi</h3>
      </div>

      <div class="navbar-right">
        <span>Halo {{ session('username') ?? 'Admin' }} 👋</span>
      </div>

    </div>

    <div class="container">

      @if(session('success'))
      <div class="alert">
        {{ session('success') }}
      </div>
      @endif

      <div class="tabs">

        <button class="tab-btn active" onclick="switchTab(event, 'koperasi')">
          <i class="fas fa-building"></i>
          Data Koperasi
        </button>

        <button class="tab-btn" onclick="switchTab(event, 'pegawai')">
          <i class="fas fa-users"></i>
          Data Pegawai
        </button>

      </div>

      <div id="koperasi" class="tab-content active">

        <div class="top">
          <h2>Data Koperasi</h2>

          <div style="display: flex; gap: 10px;">
            <a href="#" onclick="history.back()" class="btn btn-back">
              ← Kembali
            </a>
            <a href="/admin/koperasi/create" class="btn btn-add">
              + Tambah
            </a>
          </div>
        </div>

        <div class="card">

          <form method="GET">

            <div class="filter">

              <input
                type="text"
                name="search"
                placeholder="Cari data..."
                value="{{ request('search') }}"
              >

              <select name="status">
                <option value="">Semua Status</option>
                <option value="aktif">Aktif</option>
                <option value="tidak aktif">Tidak Aktif</option>
              </select>

              <select name="status_mitra">
                <option value="">Semua Mitra</option>
                <option value="bermitra">Bermitra</option>
                <option value="belum">Belum</option>
              </select>

              <button type="submit" class="btn">
                Filter
              </button>

            </div>

          </form>

          <div class="table-wrapper">

            <table>

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
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody>

                @forelse($dataKoperasi as $d)

                <tr>

                  <td>
                    {{ ($dataKoperasi->currentPage()-1)*$dataKoperasi->perPage() + $loop->iteration }}
                  </td>

                  <td>{{ $d->jumlah }}</td>

                  <td>{{ $d->tahun }}</td>

                  <td>
                    <span class="badge">
                      {{ ucfirst($d->status) }}
                    </span>
                  </td>

                  <td>{{ ucfirst($d->status_mitra) }}</td>

                  <td>{{ ucfirst($d->jenis_mitra) }}</td>

                  <td>{{ $d->kelurahan->NM_KELURAHAN ?? '-' }}</td>

                  <td>{{ $d->kecamatan->NM_KECAMATAN ?? '-' }}</td>

                  <td>
                    <div class="action">

                      <a href="/admin/koperasi/edit/{{ $d->id }}" class="btn btn-edit">
                        Edit
                      </a>

                      <button
                        onclick="confirmDelete('/admin/koperasi/delete/{{ $d->id }}')"
                        class="btn btn-delete"
                      >
                        Hapus
                      </button>

                    </div>
                  </td>

                </tr>

                @empty

                <tr>
                  <td colspan="9">Tidak ada data</td>
                </tr>

                @endforelse

              </tbody>

            </table>

          </div>

          <div class="pagination-wrapper">

            <div>
              {{ $dataKoperasi->links() }}
            </div>

            <div class="pagination-info">
              Menampilkan
              {{ $dataKoperasi->firstItem() ?? 0 }}
              -
              {{ $dataKoperasi->lastItem() ?? 0 }}
              dari
              {{ $dataKoperasi->total() }}
              data
            </div>

          </div>

        </div>

      </div>

      <div id="pegawai" class="tab-content">

        <div class="top">

          <h2>Data Pegawai</h2>

          <div style="display: flex; gap: 10px;">
            <a href="#" onclick="history.back()" class="btn btn-back">
              ← Kembali
            </a>
            <a href="/admin/pegawai/create" class="btn btn-add">
              + Tambah
            </a>
          </div>

        </div>

        <div class="card">

          <div class="table-wrapper">

            <table>

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

                  <td>
                    {{ ($dataPegawai->currentPage()-1)*$dataPegawai->perPage() + $loop->iteration }}
                  </td>

                  <td>{{ $p->jumlah_pegawai }}</td>

                  <td>
                    <span class="badge">
                      {{ ucfirst(str_replace('_', ' ', $p->status)) }}
                    </span>
                  </td>

                  <td>{{ ucfirst($p->program) }}</td>

                  <td>

                    <div class="action">

                      <a href="/admin/pegawai/edit/{{ $p->id }}" class="btn btn-edit">
                        Edit
                      </a>

                      <button
                        onclick="confirmDelete('/admin/pegawai/delete/{{ $p->id }}')"
                        class="btn btn-delete"
                      >
                        Hapus
                      </button>

                    </div>

                  </td>

                </tr>

                @empty

                <tr>
                  <td colspan="5">Tidak ada data</td>
                </tr>

                @endforelse

              </tbody>

            </table>

          </div>

        </div>

      </div>

    </div>

  </main>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>

    // TOGGLE SIDEBAR MOBILE
    function toggleSidebar() {
      document.getElementById('sidebarMenu').classList.toggle('active');
      document.getElementById('overlay').classList.toggle('active');
    }

    // TAB
    function switchTab(event, tabId){

      document.querySelectorAll('.tab-content').forEach(tab=>{
        tab.classList.remove('active');
      });

      document.querySelectorAll('.tab-btn').forEach(btn=>{
        btn.classList.remove('active');
      });

      document.getElementById(tabId).classList.add('active');

      event.currentTarget.classList.add('active');
    }

    // DELETE
    function confirmDelete(url){

      Swal.fire({
        title:'Yakin?',
        text:'Data akan dihapus',
        icon:'warning',
        showCancelButton:true,
        confirmButtonColor:'#dc3545',
        confirmButtonText:'Ya, hapus'
      }).then((result)=>{

        if(result.isConfirmed){
          window.location.href = url;
        }

      });
    }

    // LOGOUT
    function logout(){

      Swal.fire({
        title:'Logout?',
        text:'Kamu akan keluar',
        icon:'warning',
        showCancelButton:true,
        confirmButtonColor:'#0d6efd',
        confirmButtonText:'Ya, logout'
      }).then((result)=>{

        if(result.isConfirmed){

          localStorage.removeItem("login");

          window.location.href = "/logout";
        }

      });
    }

    // LOGIN CHECK
    if(localStorage.getItem("login") !== "true"){
      window.location.href = "/";
    }

  </script>

</body>
</html>