<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Pemberdayaan Usaha Mikro</title>

  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <style>
    /* TABLE */
    table {
      width: 100%;
      border-collapse: collapse;
      border: 1px solid #e5e7eb;
      color: #333;
      font-weight: 400;
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
  </style>

</head>

<body>

<div class="sidebar">
  <h2>DINKOPUMDAG</h2>
  <div id="tanggalSidebar" style="margin:10px 0; font-size:14px; color:#fff; text-align: center;"></div>

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

<div class="main">

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

    <div class="cards" id="mainMenu">

      <div class="card green" onclick="showUmkm()">
        <h4>UMKM</h4>
        <p>Informasi UMKM</p>
      </div>

      <div class="card blue" onclick="showSwk()">
        <h4>Sentra Wisata Kuliner</h4>
        <p>Informasi Sentra Wisata Kuliner</p>
      </div>

    </div>

    <div id="umkmArea" style="display:none; margin-top:20px;">
      <h3>Data UMKM</h3>
      
      <div style="margin-bottom:10px;">
        <button onclick="hideAll()" style="background:#0d6efd;color:white;border:none;padding:8px 16px;border-radius:6px;cursor:pointer;font-size:14px;font-weight:500;">
          ← Kembali
        </button>
      </div>

        <div class="card" style="overflow-x:auto;">
          <table style="width:100%; border-collapse:collapse;">
            <thead>
              <tr style="background:#0d6efd; color:#333;">
                <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">No</th>
                <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Kecamatan</th>
                <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Kelurahan</th>
                <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Total UMKM</th>
                <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">UMKM Binaan</th>
                <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Sertifikasi Halal</th>
                <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Sertifikasi Merek</th>
                <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">NIB</th>
                <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Peken</th>
                <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Padat Karya</th>
              </tr>
            </thead>
            <tbody>
              @forelse($umkm as $u)
              <tr style="border:1px solid #d1d5db;">
                <td style="padding:10px; border:1px solid #d1d5db;">{{ $loop->iteration }}</td>
                <td style="padding:10px; border:1px solid #d1d5db;">{{ $u->kelurahan->kecamatan->NM_KECAMATAN ?? '-' }}</td>
                <td style="padding:10px; border:1px solid #d1d5db;">{{ $u->kelurahan->NM_KELURAHAN ?? '-' }}</td>
                <td style="padding:10px; border:1px solid #d1d5db;">{{ $u->total_umkm }}</td>
                <td style="padding:10px; border:1px solid #d1d5db;">{{ $u->umkm_binaan }}</td>
                <td style="padding:10px; border:1px solid #d1d5db;">{{ $u->sertifikasi_halal }}</td>
                <td style="padding:10px; border:1px solid #d1d5db;">{{ $u->sertifikasi_merek }}</td>
                <td style="padding:10px; border:1px solid #d1d5db;">{{ $u->nib }}</td>
                <td style="padding:10px; border:1px solid #d1d5db;">{{ $u->peken }}</td>
                <td style="padding:10px; border:1px solid #d1d5db;">{{ $u->padat_karya }}</td>
              </tr>
              @empty
                <tr>
                  <td colspan="11" style="padding:10px; border:1px solid #d1d5db; text-align:center; color:#999;">
                    Tidak ada data UMKM
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
    </div>

    <div id="swkArea" style="display:none; margin-top:20px;">
      <h3>Data Sentra Wisata Kuliner</h3>
      
      <div style="margin-bottom:10px;">
        <button onclick="hideAll()" style="background:#0d6efd;color:white;border:none;padding:8px 16px;border-radius:6px;cursor:pointer;font-size:14px;font-weight:500;">
          ← Kembali
        </button>
      </div>

        <div class="card" style="overflow-x:auto;">
          <table style="width:100%; border-collapse:collapse;">
            <thead>
              <tr style="background:#0d6efd; color:#333;">
                <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">No</th>
                <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Nama SWK</th>
                <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Alamat</th>
                <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Kecamatan</th>
                <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Kelurtahan</th>
                <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Jumlah Pedagang</th>
                <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Jumlah Stan</th>
                <th style="padding:10px; border:1px solid #d1d5db; text-align:left;">Stan Belum Terisi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($swk as $s)
              <tr style="border:1px solid #d1d5db;">
                <td style="padding:10px; border:1px solid #d1d5db;">{{ $loop->iteration }}</td>
                <td style="padding:10px; border:1px solid #d1d5db;">{{ $s->nama_swk }}</td>
                <td style="padding:10px; border:1px solid #d1d5db;">{{ $s->alamat }}</td>
                <td style="padding:10px; border:1px solid #d1d5db;">{{ $s->kelurahan->kecamatan->NM_KECAMATAN ?? '-' }}</td>
                <td style="padding:10px; border:1px solid #d1d5db;">{{ $s->kelurahan->NM_KELURAHAN ?? '-' }}</td>
                <td style="padding:10px; border:1px solid #d1d5db;">{{ $s->jumlah_pedagang }}</td>
                <td style="padding:10px; border:1px solid #d1d5db;">{{ $s->jumlah_stan }}</td>
                <td style="padding:10px; border:1px solid #d1d5db;">{{ $s->stan_belum_terisi }}</td>
              </tr>
              @empty
                <tr>
                  <td colspan="11" style="padding:10px; border:1px solid #d1d5db; text-align:center; color:#999;">
                    Tidak ada data SWK
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
    </div>

  </div>

  </div>

</div>

<script>
// ================= SCRIPT TANGGAL YANG DITAMBAHKAN =================
document.addEventListener('DOMContentLoaded', function() {
    const elTanggal = document.getElementById('tanggalSidebar');
    if (elTanggal) {
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        elTanggal.textContent = now.toLocaleDateString('id-ID', options);
    }
});

// ================= NAV =================
function showUmkm(){
  mainMenu.style.display="none";
  umkmArea.style.display="block";
  swkArea.style.display="none";
}

function showSwk(){
  mainMenu.style.display="none";
  umkmArea.style.display="none";
  swkArea.style.display="block";
}

function hideAll(){
  mainMenu.style.display="grid";
  umkmArea.style.display="none";
  swkArea.style.display="none";
}

// ================= COLOR =================
function getColor(id){
  const colors = ['blue','green','orange','teal','purple'];
  return colors[id % colors.length];
}

// logout
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