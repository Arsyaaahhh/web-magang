<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pemberdayaan Usaha Mikro</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/pum.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      overflow-x: hidden;
      min-height:100vh;
      display:flex;
      justify-content:center;
      align-items:center;
    }

    /* OVERLAY */
    .overlay {
      display: none;
      position: fixed;
      top: 0; left: 0; width: 100%; height: 100%;
      background: rgba(0,0,0,0.5);
      z-index: 999;
    }

    main {
      flex: 1;
      display: flex;
      flex-direction: column;
      margin-left: 240px;
      transition: margin-left 0.3s ease;
    }

    /* CONTAINER */
    .container {
        padding: 25px;
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    /* FILTER */
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

    /* TABLE */
    .table-responsive {
      width: 100%;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border: 1px solid #e5e7eb;
      color: #333;
      min-width: 600px;
    }

    th { padding: 12px; background: #eaf2ff; font-size: 13px; text-align: left; }
    td { padding: 12px; font-size: 15px; border-bottom: 1px solid #e5e7eb; }
    tbody tr:nth-child(even) { background: #f9fafb; }
    tr:hover { background: #eef4ff; }

    .btn { padding: 8px 14px; border-radius: 8px; font-size: 14px; border: none; cursor: pointer; text-decoration:none; }

    /* PAGINATION */
    .pagination-wrapper { display: flex; justify-content: space-between; align-items: center; margin-top: 15px; flex-wrap: wrap; gap: 10px; }
    .pagination { display: flex; gap: 6px; flex-wrap: wrap; }
    .pagination li { list-style: none; }
    .pagination a, .pagination span { display: inline-block; padding: 6px 12px; border-radius: 8px; border: 1px solid #d1d5db; background: white; color: #333; text-decoration: none; font-size: 14px; transition: 0.2s; }
    .pagination a:hover { background: #0d6efd; color: white; }
    .pagination .active span { background: #0d6efd; color: white; border-color: #0d6efd; }
    .pagination .disabled span { color: #aaa; background: #f3f4f6; }
    .pagination-info { font-size: 13px; color: #666; }

    .toggle-btn { display: none; }

    /* ======================================================= */
    /* RESPONSIVE KHUSUS SMARTPHONE & TABLET (< 768px)         */
    /* ======================================================= */
    @media (max-width: 768px) {
        .sidebar { left: -100% !important; position: fixed !important; z-index: 1000; transition: 0.3s ease; }
        .sidebar.active { left: 0 !important; }
        main { margin-left: 0 !important; width: 100% !important; }
        .toggle-btn { display: inline-block !important; margin-right: 15px; font-size: 24px; cursor: pointer; color: #0d6efd; }
        .overlay.active { display: block; }
        .header { display: flex; align-items: center; }
        .filter { flex-direction: column; }
        .filter input, .filter select, .filter button { width: 100%; }
        .cards, #mainMenu { display: grid !important; grid-template-columns: 1fr !important; gap: 15px; }
        .navbar { padding: 15px 20px; }
    }
  </style>
</head>

<body>

  <div class="overlay" onclick="toggleSidebar()"></div>

    <div class="sidebar">
        <h2>DINKOPUMDAG</h2>
        <div id="tanggalSidebar" style="margin:10px 0; font-size:14px; color:#fff;"></div>

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

  <main>

  <div class="header">
    <div class="toggle-btn" onclick="toggleSidebar()">☰</div>
    <img src="{{ asset('images/logo.jpg') }}" class="logo">
    <div>
      <b>Pemberdayaan Usaha Mikro</b><br>
      <small>Dinkopumdag Surabaya</small>
    </div>
  </div>

    <div class="container">

      <h2>Pemberdayaan Usaha Mikro</h2>

        <form method="GET">
          <div class="filter">
            <select id="kecamatan" name="kecamatan_id">
              <option value="">Semua Kecamatan</option>
              @foreach($kecamatan as $k)
                <option value="{{ $k->ID_KECAMATAN }}" {{ request('kecamatan_id') == $k->ID_KECAMATAN ? 'selected' : '' }}>
                  {{ $k->NM_KECAMATAN }}
                </option>
              @endforeach
            </select>
            <select id="kelurahan" name="kelurahan_id"><option value="">Semua Kelurahan</option></select>
            <input type="text" name="search" placeholder="Cari Tahun" value="{{ request('search') }}">
            <button type="submit" class="btn" style="background:#0d6efd; color:white;">Filter</button>
          </div>
        </form>

      <!-- MAIN MENU -->
        <!-- <div class="cards" id="mainMenu">
            <a class="card green">
                <h4>Total Umkm</h4>
                <h2>{{ $summary->jumlah ?? 0 }}</h2>
            </a>
        </div> -->
      
      <div class="card">

        <div class="table-responsive">
            <table>
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kecamatan</th>
                  <th>Kelurahan</th>
                  <th>Tahun</th>
                  <th>Jumlah Umkm</th>
                </tr>
              </thead>

              <tbody>
                @forelse($data as $d)
                  <tr>
                    <td>{{ ($data->currentPage()-1)*$data->perPage() + $loop->iteration }}</td>
                    <td>{{ $d->kelurahan->kecamatan->NM_KECAMATAN ?? '-' }}</td>   
                    <td>{{ $d->kelurahan->NM_KELURAHAN ?? '-' }}</td>
                    <td>{{ $d->tahun }}</td>
                    <td>{{ $d->jumlah }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" style="text-align:center;">Tidak ada data</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
          <div class="pagination">
            {{ $data->links('components.pagination') }}
          </div>

          <div class="pagination-info">
            Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} results
          </div>
        </div>

      </div>
    </div>

  </main>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    // TOGGLE SIDEBAR UNTUK HP
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('active');
        document.querySelector('.overlay').classList.toggle('active');
    }

    document.addEventListener('DOMContentLoaded', function () {

        let kecamatan = document.getElementById('kecamatan');
        let kelurahan = document.getElementById('kelurahan');

        let selectedKelurahan = "{{ request('kelurahan_id') }}";

        function loadKelurahan(kecamatan_id, selected = null){

            if(!kecamatan_id){
                kelurahan.innerHTML =
                    '<option value="">Semua Kelurahan</option>';
                return;
            }

            fetch('/get-kelurahan/' + kecamatan_id)
                .then(res => res.json())
                .then(data => {

                    kelurahan.innerHTML =
                        '<option value="">Semua Kelurahan</option>';

                    data.forEach(item => {

                        let isSelected =
                            item.ID_KELURAHAN == selected
                            ? 'selected'
                            : '';

                        kelurahan.innerHTML += `
                            <option value="${item.ID_KELURAHAN}" ${isSelected}>
                                ${item.NM_KELURAHAN}
                            </option>
                        `;
                    });

                });
        }

        // AUTO LOAD
        if(kecamatan.value){
            loadKelurahan(
                kecamatan.value,
                selectedKelurahan
            );
        }

        // CHANGE
        kecamatan.addEventListener('change', function () {
            loadKelurahan(this.value);
        });

    });
    
    // DELETE
    function confirmDelete(formId) {
      Swal.fire({
        title: 'Yakin?',
        text: "Data akan dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Ya, hapus!'
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById(formId).submit();
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