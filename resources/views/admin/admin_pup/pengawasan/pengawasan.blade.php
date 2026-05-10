<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Pengawasan</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{display:flex;background:#f4f7fb; min-height: 100vh;}

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
.main{margin-left:240px; width:calc(100% - 240px); transition: all 0.3s ease;}

/* NAVBAR */
.navbar{
    background:white; padding:15px 30px; display:flex; justify-content:space-between; align-items: center;
    box-shadow:0 2px 10px rgba(0,0,0,0.05);
}
.menu-toggle{display: none; background: none; border: none; font-size: 20px; cursor: pointer;}

/* CONTENT */
.container{padding:30px;}
.top{display:flex; justify-content:space-between; align-items: center; margin-bottom:20px; gap: 10px;}
.top h2 { font-size: 1.5rem; }

/* TABLE & CARD */
.card{background:white; padding:20px; border-radius:12px; border:1px solid #e5e7eb;}
.table-responsive{overflow-x:auto; -webkit-overflow-scrolling: touch;}
table{width:100%; border-collapse:collapse; min-width: 600px;} /* Sedikit dilebarkan untuk kolom jenis */
th{padding:12px; background:#eaf2ff; text-align:left;}
td{padding:12px; border-bottom:1px solid #e5e7eb;}

/* BUTTONS */
.btn{padding:10px 16px; border-radius:8px; border:none; cursor:pointer; background:#22c55e; color:white; text-decoration:none; white-space: nowrap; display: inline-block; transition: 0.2s ease;}
.btn:hover { background: #16a34a; }

.btn-back { background: #6c757d; }
.btn-back:hover { background: #5a6268; }

.alert{padding:10px; margin-bottom:10px; background:#d1e7dd; border-radius:6px; color:#0f5132;}

/* MOBILE RESPONSIVE */
@media (max-width: 768px) {
    .sidebar { left: -240px; }
    .sidebar.active { left: 0; }
    .main { margin-left: 0; width: 100%; }
    .menu-toggle { display: block; }
    .container { padding: 15px; }
    .top { flex-direction: column; align-items: flex-start; }
    .navbar { padding: 15px; }
    .top h2 { font-size: 1.2rem; }
}
</style>
</head>
<body>

  <div class="sidebar" id="sidebar">
    <h2>ADMIN</h2>

    <a href="/admin/admin_sekre">
      <i class="fas fa-user-tie"></i> Sekretariat
    </a>

    <a href="/admin/admin_pum">
      <i class="fas fa-store"></i> Pemberdayaan Usaha Mikro
    </a>

    <a class="active"  href="/admin/admin_pup">
      <i class="fas fa-briefcase"></i> Pembinaan Usaha Perdagangan
    </a>

    <a href="/admin/admin_perdagangan">
      <i class="fas fa-truck"></i> Distribusi Perdagangan
    </a>

        <a href="/admin/koperasi">
      <i class="fas fa-building"></i> Bidang Koperasi
    </a>

    <a href="/admin/admin_metro">
      <i class="fas fa-balance-scale"></i> Metrologi Legal
    </a>

    <button onclick="logout()" class="logout-btn">
      <i class="fas fa-sign-out-alt"></i> Logout
    </button>
  </div>
<div class="main">
    <div class="navbar">
        <button class="menu-toggle" onclick="toggleSidebar()"><i class="fas fa-bars"></i></button>
        <h3>Data Pengawasan</h3>
        <span style="font-size: 14px;">Halo {{ session('username') ?? 'Admin' }}</span>
    </div>

    <div class="container">
        <div class="top">
            <h2>Rekap Data Pengawasan</h2>
            
            <div style="display: flex; gap: 10px;">
                <a href="javascript:history.back()" class="btn btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
                <a href="{{ route('pengawasan.create') }}" class="btn"><i class="fas fa-plus"></i> Tambah Data</a>
            </div>
        </div>

        @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Jenis Pengawasan</th>
                            <th>Tahun</th>
                            <th>Jumlah</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $item)
                        <tr>
                            <td>{{ ($data->currentPage()-1)*$data->perPage()+$loop->iteration }}</td>
                            <td><strong>{{ $item->jenis_pengawasan }}</strong></td>
                            <td>{{ $item->tahun }}</td>
                            <td>{{ $item->jumlah }} </td>
                            <td>
                                <a href="{{ route('pengawasan.edit',$item->id) }}" style="color:#2563eb; margin-right: 10px;"><i class="fas fa-pen"></i></a>
                                <a href="{{ route('pengawasan.delete',$item->id) }}" style="color:#ef4444;" onclick="return confirm('Hapus data pengawasan ini?')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" align="center">Belum ada data Pengawasan</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div style="margin-top: 15px;">{{ $data->links() ?? '' }}</div>
        </div>
    </div>
</div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function toggleSidebar() { document.getElementById('sidebar').classList.toggle('active'); }
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
</script>
</body>
</html>