<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin Pasar</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
      font-weight: 400;
      color: #333;
      overflow-x: hidden;
    }

    /* OVERLAY (Background gelap saat sidebar terbuka di HP) */
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

    /* NAVBAR */
    .navbar {
      background: white;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 10px rgba(0,0,0,0.04);
      position: sticky;
      top: 0;
      z-index: 100;
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
    }

    .navbar h3 {
      color: #0d6efd;
    }

    /* CONTAINER */
    .container {
        padding: 25px;
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    /* HEADER */
    .top {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
      align-items: center;
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
      padding: 18px;
      border-radius: 12px;
      border: 1px solid #e5e7eb;
    }

    /* FILTER */
    .filter {
      display: flex;
      gap: 10px;
      margin-bottom: 15px;
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
      min-width: 600px; /* Menjaga tabel agar tetap bisa discroll di HP */
    }

    th {
      padding: 12px;
      background: #eaf2ff;
      font-size: 13px;
      text-align: left;
    }

    td {
      padding: 12px;
      font-size: 15px;
      border-bottom: 1px solid #e5e7eb;
    }

    tbody tr:nth-child(even) {
      background: #f9fafb;
    }

    tr:hover {
      background: #eef4ff;
    }

    /* ACTION */
    .action {
      display: flex;
      gap: 6px;
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
      flex-wrap: wrap;
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

    /* SIDEBAR */
    .sidebar {
      width: 240px;
      height: 100vh;
      background: #0d6efd;
      color: white;
      padding: 20px;
      position: fixed;
      left: 0;
      top: 0;
      z-index: 1000;
      transition: left 0.3s ease;
    }

    .sidebar h2 {
      margin-bottom: 20px;
    }

    .sidebar a {
      display: block;
      color: white;
      padding: 10px;
      border-radius: 8px;
      margin-bottom: 8px;
      font-weight: 500;
      cursor: pointer;
      text-decoration: none;
    }

    .sidebar a i{
        margin-right: 6px;
    }

    .sidebar a:hover,
    .sidebar .active {
      background: rgba(255, 255, 255, 0.2);
    }

    /* TOMBOL KELUAR */
    .logout-btn {
        margin-top: 20px;
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 8px;
        background: #ef4444;
        color: white;
        cursor: pointer;
        font-size: 14px;
        text-align: left;
        font-weight: 500;
    }

    .logout-btn i {
        margin-right: 6px;
    }

    .logout-btn:hover {
        background: #dc2626;
    }

    .card h4 {
        font-weight: 500;
        letter-spacing: 0.3px;
    }

    .card h2 {
        font-weight: 600;
    }

    .card p {
        font-weight: 400;
        opacity: 0.85;
    }

    .card i {
        font-size: 20px;
        margin-bottom: 8px;
        opacity: 0.85;
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.12);
    }

    /* ======================================================= */
    /* RESPONSIVE KHUSUS SMARTPHONE & TABLET (< 768px)         */
    /* ======================================================= */
    @media (max-width: 768px) {
        .sidebar {
            left: -240px;
        }
        .sidebar.active {
            left: 0;
        }

        main {
            margin-left: 0;
        }

        .toggle-btn {
            display: block;
        }

        .overlay.active {
            display: block;
        }

        .top {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .filter {
            flex-direction: column;
        }

        .filter input,
        .filter select,
        .filter button {
            width: 100%;
        }

        .navbar {
            padding: 15px 20px;
        }
    }
  </style>
</head>

<body>

  <!-- OVERLAY (Muncul di HP saat sidebar terbuka) -->
  <div class="overlay" onclick="toggleSidebar()"></div>

  <!-- SIDEBAR -->
  <div class="sidebar">
    <h2>ADMIN</h2>
    
    <a href="/admin/admin_sekre">
      <i class="fas fa-user-tie"></i> Sekretariat
    </a>

    <a href="/admin/admin_pum">
      <i class="fas fa-store"></i> Pemberdayaan Usaha Mikro
    </a>

    <a href="/admin/admin_pup">
      <i class="fas fa-briefcase"></i> Pembinaan
    </a>

    <a class="active" href="/admin/admin_perdagangan/">
      <i class="fas fa-truck"></i> Perdagangan
    </a>

    <button onclick="logout()" class="logout-btn">
      <i class="fas fa-sign-out-alt"></i> Logout
    </button>
  </div>

  <!-- MAIN -->
  <main>

    <!-- NAVBAR -->
    <div class="navbar">
      <div class="navbar-left">
        <i class="fas fa-bars toggle-btn" onclick="toggleSidebar()"></i>
        <h3>Admin Perdagangan</h3>
      </div>

      <div style="display:flex; gap:10px; align-items:center;">
        <span style="font-size: 14px;">Halo {{ session('username') ?? 'Admin' }} 👋</span>
      </div>
    </div>

    <!-- CONTENT -->
    <div class="container">

      <div class="top">
        <h2>Data Toko Kelontong</h2>
        <a href="/admin/admin_perdagangan/tokokelontong/tokokelontongcreate" class="btn btn-add">+ Tambah</a>
      </div>

      @if(session('success'))
        <div class="alert">
          {{ session('success') }}
        </div>
      @endif

      <div class="card">

        <!-- FILTER -->
        <form method="GET">
          <div class="filter">

            <!-- KECAMATAN -->
            <select id="kecamatan" name="kecamatan_id">
              <option value="">Semua Kecamatan</option>

              @foreach($kecamatan as $k)
                <option value="{{ $k->ID_KECAMATAN }}"
                  {{ request('kecamatan_id') == $k->ID_KECAMATAN ? 'selected' : '' }}>
                  {{ $k->NM_KECAMATAN }}
                </option>
              @endforeach
            </select>

            <!-- KELURAHAN -->
            <select id="kelurahan" name="kelurahan_id">
              <option value="">Semua Kelurahan</option>
            </select>

            <button type="submit" class="btn" style="background:#0d6efd; color:white;">Filter</button>

          </div>
        </form>

        <!-- TABLE -->
        <div class="table-responsive">
            <table>
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kecamatan</th>
                  <th>Kelurahan</th>
                  <th>Jumlah Toko</th>
                  <th>Peken</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody>
                @forelse($data as $d)
                  <tr>
                    <td>{{ ($data->currentPage()-1)*$data->perPage() + $loop->iteration }}</td>
                    <td>{{ $d->kelurahan->kecamatan->NM_KECAMATAN ?? '-' }}</td>   
                    <td>{{ $d->kelurahan->NM_KELURAHAN ?? '-' }}</td>
                    <td>{{ $d->total_toko }}</td>
                    <td>{{ $d->peken }}</td>
                    <td>
                      <div class="action">
                        <a href="/admin/admin_perdagangan/tokokelontong/tokokelontongedit/{{ $d->id }}" class="btn btn-edit">Edit</a>
                        <form id="deleteForm{{ $d->id }}" action="/admin/admin_perdagangan/tokokelontong/tokokelontongdelete/{{ $d->id }}" method="POST">
                          @csrf
                          @method('DELETE')

                          <button
                            type="button"
                            class="btn btn-delete"
                            onclick="confirmDelete('deleteForm{{ $d->id }}')"
                          >
                            Hapus
                          </button>

                        </form>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" style="text-align:center;">Tidak ada data</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
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

  <!-- JS -->
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