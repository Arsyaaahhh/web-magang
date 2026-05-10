<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Potensi Alat Ukur</title>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
    body { background: #f8fafc; font-weight: 400; color: #333; overflow-x: hidden; }
    
    .overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 999; }
    main { flex: 1; display: flex; flex-direction: column; margin-left: 240px; transition: margin-left 0.3s ease; }
    .navbar { background: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.04); position: sticky; top: 0; z-index: 100; }
    .navbar-left { display: flex; align-items: center; gap: 15px; }
    .toggle-btn { display: none; font-size: 1.5rem; color: #0d6efd; cursor: pointer; background: none; border: none; }
    .navbar h3 { color: #0d6efd; }
    .container { padding: 25px; display: flex; flex-direction: column; gap: 25px; }
    .top { display: flex; justify-content: space-between; margin-bottom: 20px; align-items: center; flex-wrap: wrap; gap: 10px; }
    
    .btn { padding: 8px 14px; border-radius: 8px; font-size: 14px; border: none; cursor: pointer; text-decoration: none; display: inline-block; }
    .btn-add { background: #20c997; color: white; }
    .btn-add:hover { background: #1aa179; transition: 0.2s ease; }
    .btn-back { background: #6c757d; color: white; }
    .btn-back:hover { background: #5a6268; transition: 0.2s ease; }
    .btn-edit { background: #ffc107; color: black; }
    .btn-delete { background: #dc3545; color: white; }

    .card { background: white; padding: 18px; border-radius: 12px; border: 1px solid #e5e7eb; }
    .filter { display: flex; gap: 10px; margin-bottom: 15px; flex-wrap: wrap; }
    .filter input { padding: 8px; border-radius: 6px; border: 1px solid #d1d5db; min-width: 150px; }
    
    .table-responsive { width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }
    table { width: 100%; border-collapse: collapse; border: 1px solid #e5e7eb; color: #333; min-width: 500px; }
    th { padding: 12px; background: #eaf2ff; font-size: 13px; text-align: left; white-space: nowrap; }
    td { padding: 12px; font-size: 14px; border-bottom: 1px solid #e5e7eb; }
    tbody tr:nth-child(even) { background: #f9fafb; }
    tr:hover { background: #eef4ff; }
    .action { display: flex; gap: 6px; }

    .alert { padding: 10px; margin-bottom: 10px; background: #d1e7dd; border-radius: 6px; }

    .pagination-wrapper { display: flex; justify-content: space-between; align-items: center; margin-top: 15px; flex-wrap: wrap; gap: 10px; }
    .pagination { display: flex; gap: 6px; flex-wrap: wrap; }
    .pagination li { list-style: none; }
    .pagination a, .pagination span { display: inline-block; padding: 6px 12px; border-radius: 8px; border: 1px solid #d1d5db; background: white; color: #333; text-decoration: none; font-size: 14px; transition: 0.2s; }
    .pagination a:hover { background: #0d6efd; color: white; }
    .pagination .active span { background: #0d6efd; color: white; border-color: #0d6efd; }

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

    @media (max-width: 768px) {
        .sidebar { left: -240px; }
        .sidebar.active { left: 0; }
        main { margin-left: 0; }
        .toggle-btn { display: block; }
        .overlay.active { display: block; }
        .top { flex-direction: column; align-items: flex-start; gap: 15px; }
        .navbar { padding: 15px 20px; }
    }
  </style>
</head>
<body>

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

    <a href="/admin/pembinaan">
      <i class="fas fa-briefcase"></i> Pembinaan Usaha Perdagangan
    </a>

    <a href="/admin/perdagangan">
      <i class="fas fa-truck"></i> Distribusi Perdagangan
    </a>

        <a href="/admin/koperasi">
      <i class="fas fa-building"></i> Bidang Koperasi
    </a>

    <!-- Menu Metrologi Aktif -->
    <a class="active" href="/admin/admin_metro">
      <i class="fas fa-balance-scale"></i> Metrologi Legal
    </a>

    <button onclick="logout()" class="logout-btn">
      <i class="fas fa-sign-out-alt"></i> Logout
    </button>
  </div>

  <main>
    <div class="navbar">
      <div class="navbar-left">
        <button class="toggle-btn" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
        <h3>Admin Metrologi Legal</h3>
      </div>
      <div style="display:flex; gap:10px; align-items:center;">
        <span style="font-size: 14px;">Halo {{ session('username') ?? 'Admin' }} 👋</span>
      </div>
    </div>

    <div class="container">
      <div class="top">
        <h2>Jumlah Potensi Alat Ukur (UTTP)</h2>
        <div style="display: flex; gap: 10px;">
            <!-- Tombol kembali ke dashboard utama metrologi -->
            <a href="/admin/admin_metro" class="btn btn-back">← Kembali</a>
            <!-- Tombol tambah data -->
            <a href="/admin/admin_metro/alat/create" class="btn btn-add">+ Tambah Data</a>
        </div>
      </div>

      @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
      @endif

      <div class="card">
        <form method="GET">
          <div class="filter">
            <input type="number" name="tahun" placeholder="Cari Tahun..." value="{{ request('tahun') }}">
            <button type="submit" class="btn btn-add">Filter</button>
          </div>
        </form>

        <div class="table-responsive">
            <table>
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tahun</th>
                  <th>Jumlah Alat Ukur Wajib Tera</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($data as $d)
                  <tr>
                    <td>{{ ($data->currentPage()-1)*$data->perPage() + $loop->iteration }}</td>
                    <td><strong>{{ $d->tahun }}</strong></td>
                    <td>{{ number_format($d->jumlah, 0, ',', '.') }} Unit</td>
                    <td>
                      <div class="action">
                        <a href="/admin/admin_metro/alat/edit/{{ $d->id }}" class="btn btn-edit">Edit</a>
                        <!-- Pastikan Route delete Anda di web.php sesuai dengan URL ini -->
                        <form id="deleteForm{{ $d->id }}" action="/admin/admin_metro/alat/delete/{{ $d->id }}" method="POST" style="margin:0;">
                          @csrf 
                          @method('DELETE')
                          <button type="button" class="btn btn-delete" onclick="confirmDelete('deleteForm{{ $d->id }}')">Hapus</button>
                        </form>
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" style="text-align:center;">Tidak ada data</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
          <div class="pagination">{{ $data->links('components.pagination') ?? '' }}</div>
        </div>

      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('active');
        document.querySelector('.overlay').classList.toggle('active');
    }
    function confirmDelete(formId) {
      Swal.fire({ title: 'Yakin hapus?', text: "Data akan dihapus permanen!", icon: 'warning', showCancelButton: true, confirmButtonColor: '#dc3545', confirmButtonText: 'Ya, hapus!' })
      .then((result) => { if (result.isConfirmed) { document.getElementById(formId).submit(); } });
    }
    function logout() {
      Swal.fire({ title: 'Logout?', text: "Keluar dari sistem?", icon: 'warning', showCancelButton: true, confirmButtonColor: '#0d6efd', confirmButtonText: 'Ya, logout' })
      .then((result) => { if (result.isConfirmed) { localStorage.removeItem("login"); window.location.href = "/logout"; } });
    }
    if (localStorage.getItem("login") !== "true") { window.location.href = "/"; }
  </script>
</body>
</html>