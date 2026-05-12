<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data KKMP</title>

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
      background: linear-gradient(135deg, #eef4ff, #f8fafc);
      min-height: 100vh;
    }

    .navbar {
      background: white;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
    }

    .navbar h3 {
      color: #0d6efd;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: calc(100vh - 60px);
      padding: 20px;
    }

    /* BENTUK CARD */
    .card {
      background: rgba(255, 255, 255, 1);
      padding: 30px;
      width: 100%;
      max-width: 800px;
      border-radius: 14px;
      box-shadow: 0 8px 20px rgba(13, 110, 253, 0.08);
      border: 1px solid #e5e7eb;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
      padding-bottom: 15px;
      border-bottom: 1px solid #f3f4f6;
    }

    .header h2 {
      font-size: 20px;
      color: #1f2937;
    }

    .back {
      font-size: 14px;
      text-decoration: none;
      color: #6b7280;
      display: flex;
      align-items: center;
      gap: 5px;
      transition: 0.2s;
    }
    
    .back:hover {
      color: #0d6efd;
    }

    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
    }

    /* Memisahkan input full-width (seperti alamat/omzet) jika diperlukan */
    .full-width {
      grid-column: 1 / -1;
    }

    label {
      font-size: 13px;
      font-weight: 500;
      color: #4b5563;
      margin-bottom: 6px;
      display: block;
    }

    input, select {
      width: 100%;
      padding: 10px 12px;
      border-radius: 8px;
      border: 1px solid #d1d5db;
      font-size: 14px;
      transition: 0.3s;
      background-color: #f9fafb;
    }

    input:focus, select:focus {
      outline: none;
      border-color: #0d6efd;
      background-color: #ffffff;
      box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
    }

    .form-actions {
      display: flex;
      gap: 15px;
      margin-top: 25px;
      padding-top: 15px;
      border-top: 1px solid #f3f4f6;
    }

    .btn {
      padding: 12px;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      width: 100%;
      font-size: 14px;
      font-weight: 600;
      text-align: center;
      text-decoration: none;
      transition: 0.3s;
    }

    .btn-primary {
      background: #0d6efd;
    }
    
    .btn-primary:hover {
      background: #0b5ed7;
    }

    .btn-secondary {
      background: #6c757d;
    }
    
    .btn-secondary:hover {
      background: #5a6268;
    }

    .alert-error {
      background: #fee2e2;
      color: #b91c1c;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 20px;
      width: 100%;
      max-width: 800px;
      font-size: 14px;
    }

    /* 🔥 MEDIA QUERY RESPONSIVE (SMARTPHONE) */
    @media (max-width: 600px) {
      .form-grid {
        grid-template-columns: 1fr; /* Form menjadi 1 baris ke bawah di HP */
      }
      .navbar {
        padding: 15px 20px;
      }
      .form-actions {
        flex-direction: column-reverse;
      }
    }
  </style>
</head>
<body>

  <!-- MAIN -->
  <main>
    <!-- NAVBAR -->
    <div class="navbar">
      <div class="navbar-left">
        <h3>Bidang Koperasi</h3>
      </div>
      <div class="navbar-right">
        Admin
      </div>
    </div>

    <!-- CONTAINER -->
    <div class="container">
        
      <div style="width: 100%; max-width: 800px;">
        @if($errors->any())
        <div class="alert alert-error">
          <ul style="padding-left: 20px;">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <!-- BUNGKUSAN CARD -->
        <div class="card">
          <div class="header">
            <h2><i class="fas fa-plus-circle"></i> Tambah Data KKMP</h2>
            <a href="/admin/koperasi/kkmp" class="back"><i class="fas fa-arrow-left"></i> Kembali</a>
          </div>

          <form method="POST" action="/admin/koperasi/kkmp/store">
            @csrf
            
            <div class="form-grid">
              <div class="form-group">
                <label for="ID_KECAMATAN">Kecamatan</label>
                <select name="ID_KECAMATAN" id="ID_KECAMATAN" required onchange="getKelurahan()">
                  <option value="">Pilih Kecamatan</option>
                  @foreach($kecamatan as $k)
                  <option value="{{ $k->ID_KECAMATAN }}">{{ $k->NM_KECAMATAN }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="ID_KELURAHAN">Kelurahan</label>
                <select name="ID_KELURAHAN" id="ID_KELURAHAN" required>
                  <option value="">Pilih Kelurahan</option>
                </select>
              </div>

              <div class="form-group full-width">
                <label for="alamat">Alamat Lengkap</label>
                <input type="text" name="alamat" id="alamat" placeholder="Masukkan alamat lengkap..." required>
              </div>

              <div class="form-group">
                <label for="jenis_kkmp">Jenis KKMP</label>
                <select name="jenis_kkmp" id="jenis_kkmp" required>
                  <option value="">Pilih Jenis KKMP</option>
                  <option value="Gerai/Outlet Sembako (Kios Pangan)">Gerai/Outlet Sembako (Kios Pangan)</option>
                  <option value="Apotek & Klinik Kelurahan">Apotek & Klinik Kelurahan</option>
                  <option value="Unit Jasa Keuangan Mikro">Unit Jasa Keuangan Mikro</option>
                  <option value="Fasilitas Cold Storage & Logistik">Fasilitas Cold Storage & Logistik</option>
                  <option value="Unit Pemasaran UMKM">Unit Pemasaran UMKM</option>
                  <option value="Unit Jasa Pemenuhan Gizi (Pemasok SPPG)">Unit Jasa Pemenuhan Gizi (Pemasok SPPG)</option>
                </select>
              </div>

              <div class="form-group">
                <label for="tahun">Tahun</label>
                <input type="number" name="tahun" id="tahun" placeholder="Contoh: 2024" required min="1900" max="2999">
              </div>

              <div class="form-group">
                <label for="jumlah_anggota">Jumlah Anggota</label>
                <input type="number" name="jumlah_anggota" id="jumlah_anggota" placeholder="Masukkan jumlah anggota" required min="0">
              </div>

              <div class="form-group">
                <label for="total_omzet">Total Omzet (Rp)</label>
                <input type="number" name="total_omzet" id="total_omzet" placeholder="Contoh: 15000000" required min="0" step="0.01">
              </div>
            </div>

            <div class="form-actions">
              <!-- <a href="/admin/koperasi/kkmp" class="btn btn-secondary">Batal</a> -->
              <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </main>

  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('show');
    }

    function confirmLogout() {
      if (confirm('Apakah Anda yakin ingin logout?')) {
        window.location.href = '/logout';
      }
    }

    function getKelurahan() {
      const kecamatanId = document.getElementById('ID_KECAMATAN').value;
      const kelurahanSelect = document.getElementById('ID_KELURAHAN');

      if (kecamatanId) {
        fetch(`/admin/koperasi/kkmp/get-kelurahan/${kecamatanId}`)
          .then(response => response.json())
          .then(data => {
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
            data.forEach(kelurahan => {
              kelurahanSelect.innerHTML += `<option value="${kelurahan.ID_KELURAHAN}">${kelurahan.NM_KELURAHAN}</option>`;
            });
          });
      } else {
        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
      }
    }
  </script>

</body>
</html>