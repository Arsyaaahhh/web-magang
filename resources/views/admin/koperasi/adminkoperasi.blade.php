﻿<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Koperasi</title>

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
      width:240px;height:100vh;background:#0d6efd;color:white;padding:20px;position:fixed;
      z-index: 1000; transition: left 0.3s ease;
    }
    .sidebar h2{margin-bottom:20px;}
    .sidebar a{
      display:block;color:white;padding:10px;border-radius:8px;margin-bottom:8px;text-decoration:none;
    }
    .sidebar a:hover,.sidebar .active{background:rgba(255,255,255,0.2);}
    .logout-btn{
      margin-top:20px;width:100%;padding:10px;border:none;border-radius:8px;background:#dc3545;color:white;
      cursor:pointer;
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

    .toggle-btn {
      display: none;
      font-size: 1.5rem;
      color: #0d6efd;
      cursor: pointer;
      background: none;
      border: none;
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

    /* BUNGKUSAN UNTUK TOMBOL */
    .top-actions {
      display: flex;
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
      grid-template-columns:repeat(auto-fit,minmax(100px,1fr));
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
    .btn-reset{
    padding: 10px 10px;
    background: #7a7a7a;
    color: white;
    border-radius: 6px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: 0.3s;
    text-align: center;
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

    

    /* 🔥 MEDIA QUERY RESPONSIVE (SMARTPHONE) */
    @media(max-width:768px){
      .sidebar { left: -240px; }
      .sidebar.active { left: 0; }
      main { margin-left: 0; width: 100%; }
      .toggle-btn { display: block; }
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
      <i class="fas fa-user-tie"></i> Sekretariat
    </a>

    <a href="/admin/admin_pum">
      <i class="fas fa-store"></i> Pemberdayaan Usaha Mikro
    </a>

    <a href="/admin/admin_pup">
      <i class="fas fa-briefcase"></i> Pembinaan Usaha Perdagangan
    </a>

    <a href="/admin/admin_perdagangan">
      <i class="fas fa-truck"></i> Distribusi Perdagangan
    </a>

    <a class="active" href="/admin/koperasi">
      <i class="fas fa-building"></i> Bidang Koperasi
    </a>

    <a href="/admin/admin_metro">
      <i class="fas fa-balance-scale"></i> Metrologi Legal
    </a>

    <button onclick="logout()" class="logout-btn">
      <i class="fas fa-sign-out-alt"></i> Logout
    </button>

  </div>

  <main>

    <div class="navbar">

      <div class="navbar-left">
        <button class="toggle-btn" onclick="toggleSidebar()">
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

        <button class="tab-btn" onclick="window.location.href='/admin/koperasi/kkmp'">
          <i class="fas fa-store"></i>
          Data KKMP
        </button>
      </div>

      <!-- TAB KOPERASI -->
      <div id="koperasi" class="tab-content active">
        <div class="top">
          <h2>Data Koperasi</h2>
          
          <!-- BUNGKUSAN TOMBOL -->
          <div class="top-actions">
            <a href="/admin/koperasi/create" class="btn btn-add">
              + Tambah
            </a>
          </div>

        </div>

        <div class="card">

          <!-- FILTER KOPERASI -->
          <form method="GET">

              <div class="filter">

                  <!-- SEARCH -->
                  <input
                      type="text"
                      name="search"
                      placeholder="Cari kecamatan, kelurahan, jumlah koperasi..."
                      value="{{ request('search') }}"
                  >

                  <!-- KECAMATAN -->
                  <select id="kecamatan" name="kecamatan_id">

                      <option value="">-- Pilih Kecamatan --</option>

                      @foreach($kecamatan as $k)

                          <option
                              value="{{ $k->ID_KECAMATAN }}"
                              {{ request('kecamatan_id') == $k->ID_KECAMATAN ? 'selected' : '' }}
                          >

                              {{ $k->NM_KECAMATAN }}

                          </option>

                      @endforeach

                  </select>

                  <!-- KELURAHAN -->
                  <select id="kelurahan" name="kelurahan_id">

                      <option value="">-- Pilih Kelurahan --</option>

                      @foreach($kelurahan as $kel)

                          <option
                              value="{{ $kel->ID_KELURAHAN }}"
                              {{ request('kelurahan_id') == $kel->ID_KELURAHAN ? 'selected' : '' }}
                          >

                              {{ $kel->NM_KELURAHAN }}

                          </option>

                      @endforeach

                  </select>

                  <!-- TAHUN -->
                  <select id="tahun" name="tahun">

                      <option value="">-- Pilih Tahun --</option>

                      @foreach($tahunOptions as $tahun)

                          <option
                              value="{{ $tahun }}"
                              {{ request('tahun') == $tahun ? 'selected' : '' }}
                          >

                              {{ $tahun }}

                          </option>

                      @endforeach

                  </select>

                  <!-- BUTTON -->
                  <button type="submit" class="btn">
                      Filter
                  </button>
                  <a href="{{ url()->current() }}" class="btn-reset">
                    Reset
                  </a>

              </div>

          </form>

          <!-- TABLE KOPERASI -->
          <div class="table-wrapper">
            <table class="table-koperasi">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kecamatan</th>
                  <th>Kelurahan</th>
                  <th>Tahun</th>
                  <th>Jumlah Koperasi</th>
                  <th>aktif</th>
                  <th>tidak aktif</th>
                  <th>bermitra</th>
                  <th>mitra_perbankan</th>
                  <th>Padat karya</th>
                  <th>LPJ</th>
                  <th>RAT</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody>
                @forelse($dataKoperasi as $d)
                <tr>
                    <td>{{ ($dataKoperasi->currentPage()-1)*$dataKoperasi->perPage() + $loop->iteration }}</td>
                    <td>{{ $d->kecamatan->NM_KECAMATAN ?? '-' }}</td>
                    <td>{{ $d->kelurahan->NM_KELURAHAN ?? '-' }}</td>
                    <td>{{ $d->tahun }}</td>
                    <td>{{ $d->jumlah }}</td>
                    <td>{{ $d->aktif }}</td>
                    <td>{{ $d->tidak_aktif }}</td>
                    <td>{{ $d->bermitra }}</td>
                    <td>{{ $d->mitra_perbankan }}</td>
                    <td>{{ $d->padat_karya }}</td>
                    <td>{{ $d->lpj_lengkap }}</td>
                    <td>{{ $d->pelaksanaan_rat }}</td>
                    
                    <td>
                      <div class="action">
                        <a href="/admin/koperasi/edit/{{ $d->id }}" class="btn btn-edit">Edit</a>
                        <button onclick="confirmDelete('/admin/koperasi/delete/{{ $d->id }}')" class="btn btn-delete">
                          Hapus
                        </button>
                      </div>
                    </td>
                @empty
                  <tr>
                    <td colspan="12" style="text-align:center;">Tidak ada data</td>
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

    document.getElementById('kecamatan').addEventListener('change', function () {

        let kecamatanId = this.value;

        let kelurahanSelect = document.getElementById('kelurahan');

        kelurahanSelect.innerHTML =
            '<option value="">-- Pilih Kelurahan --</option>';

        if (kecamatanId) {

            fetch('/get-kelurahan/' + kecamatanId)

                .then(response => response.json())

                .then(data => {

                    data.forEach(kel => {

                        kelurahanSelect.innerHTML += `
                            <option value="${kel.ID_KELURAHAN}">
                                ${kel.NM_KELURAHAN}
                            </option>
                        `;

                    });

                });

        }

    });



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