<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <!-- 🔥 INI WAJIB UNTUK RESPONSIVE HP 🔥 -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Tambah Umkm</title>

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

    /* NAVBAR */
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

    /* CONTAINER */
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: calc(100vh - 60px);
      padding: 20px;
    }

    /* CARD */
    .card {
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(10px);
      padding: 25px;
      width: 100%;
      max-width: 800px;
      border-radius: 14px;
      border: 1px solid rgba(255, 255, 255, 0.4);
      box-shadow: 0 8px 20px rgba(13, 110, 253, 0.08);
    }

    /* HEADER */
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
    }

    .header h2 {
      font-size: 18px;
      color: #374151;
    }

    .back {
      font-size: 13px;
      text-decoration: none;
      color: #6b7280;
    }

    /* GRID */
    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
    }

    /* LABEL */
    label {
      font-size: 12px;
      color: #6b7280;
      margin-bottom: 3px;
      display: block;
    }

    /* INPUT */
    input,
    select {
      width: 100%;
      padding: 8px;
      border-radius: 7px;
      border: 1px solid #d1d5db;
      font-size: 13px;
    }

    input:focus,
    select:focus {
      outline: none;
      border-color: #0d6efd;
      box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.1);
    }

    /* FILE NOTE */
    .file-note {
      font-size: 11px;
      color: #9ca3af;
      margin-top: 2px;
    }

    /* BUTTON */
    .btn {
      margin-top: 15px;
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 8px;
      background: #0d6efd;
      color: white;
      font-weight: 500;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn:hover {
      background: #0b5ed7;
      transform: translateY(-1px);
      box-shadow: 0 4px 10px rgba(13, 110, 253, 0.2);
    }

    /* ======================================================= */
    /* RESPONSIVE KHUSUS SMARTPHONE & TABLET (< 600px)         */
    /* ======================================================= */
    @media (max-width: 600px) {
        .form-grid {
            grid-template-columns: 1fr; /* Form menjadi satu kolom memanjang ke bawah */
        }
        .navbar {
            padding: 15px 20px;
        }
        .card {
            padding: 20px;
        }
        .header h2 {
            font-size: 16px;
        }
    }
  </style>
</head>

<body>

  <div class="navbar">
    <h3>Admin Umkm</h3>
    <div style="font-size: 14px; color:#666;">Tambah Data</div>
  </div>

  <div class="container">
    <div class="card">

      <div class="header">
        <h2>Tambah Data Umkm</h2>
        <a href="/admin/admin_pum/adminumkm" class="back">← Kembali</a>
      </div>

      <form action="/admin/admin_pum/umkmstore" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-grid">

            <div>
            <label>Kecamatan</label>
            <select id="kecamatan" name="kecamatan_id" required>
                <option value="">Pilih Kecamatan</option>
                @foreach($kecamatan as $k)
                <option value="{{ $k->ID_KECAMATAN }}">{{ $k->NM_KECAMATAN }}</option>
                @endforeach
            </select>
            </div>

            <div>
            <label>Kelurahan</label>
            <select id="kelurahan" name="kelurahan_id" required>
                <option value="">Pilih Kelurahan</option>
            </select>
            </div>

            <div>
                <label>Kategori</label>

                <select name="kategori" id="kategoriUmkm" required>
                    <option value="">Pilih Kategori</option>

                    <option value="Aroma Terapi & Spa" {{ old('kategori')=='Aroma Terapi & Spa' ? 'selected' : '' }}>
                        Aroma Terapi & Spa
                    </option>

                    <option value="Bapokting" {{ old('kategori')=='Bapokting' ? 'selected' : '' }}>
                        Bapokting
                    </option>

                    <option value="Batik" {{ old('kategori')=='Batik' ? 'selected' : '' }}>
                        Batik
                    </option>

                    <option value="Craft" {{ old('kategori')=='Craft' ? 'selected' : '' }}>
                        Craft
                    </option>

                    <option value="Daging Segar Dingin" {{ old('kategori')=='Daging Segar Dingin' ? 'selected' : '' }}>
                        Daging Segar Dingin
                    </option>

                    <option value="Fashion" {{ old('kategori')=='Fashion' ? 'selected' : '' }}>
                        Fashion
                    </option>

                    <option value="Food and Culinary" {{ old('kategori')=='Food and Culinary' ? 'selected' : '' }}>
                        Food and Culinary
                    </option>

                    <option value="Hasil Pertanian" {{ old('kategori')=='Hasil Pertanian' ? 'selected' : '' }}>
                        Hasil Pertanian
                    </option>

                    <option value="Jasa" {{ old('kategori')=='Jasa' ? 'selected' : '' }}>
                        Jasa
                    </option>

                    <option value="Laundry Bag" {{ old('kategori')=='Laundry Bag' ? 'selected' : '' }}>
                        Laundry Bag
                    </option>

                    <option value="Makanan" {{ old('kategori')=='Makanan' ? 'selected' : '' }}>
                        Makanan
                    </option>

                    <option value="Minuman" {{ old('kategori')=='Minuman' ? 'selected' : '' }}>
                        Minuman
                    </option>

                    <option value="Penunjang" {{ old('kategori')=='Penunjang' ? 'selected' : '' }}>
                        Penunjang
                    </option>

                    <option value="Sabun & Shampoo" {{ old('kategori')=='Sabun & Shampoo' ? 'selected' : '' }}>
                        Sabun & Shampoo
                    </option>

                    <option value="Sepatu" {{ old('kategori')=='Sepatu' ? 'selected' : '' }}>
                        Sepatu
                    </option>

                    <option value="Slipper" {{ old('kategori')=='Slipper' ? 'selected' : '' }}>
                        Slipper
                    </option>
                </select>
            </div>

          <div>
            <label>Total UMKM</label>
            <input type="number" name="total_umkm" placeholder="Masukkan Jumlah UMKM" required>
          </div>

          <div>
            <label>UMKM Binaan</label>
            <input type="number" name="umkm_binaan" placeholder="Masukkan Jumlah UMKM Binaan" required>
          </div>

          <div>
            <label>NIB</label>
            <input type="number" name="nib" placeholder="Masukkan Jumlah Umkm Ber-NIB" required>
          </div>

          <div>
            <label>PIRT</label>
            <input type="number" name="pirt" placeholder="Masukkan Jumlah Umkm Ber-PIRT" required>
          </div>

          <div>
            <label>Sertifikasi Halal</label>
            <input type="number" name="sertifikasi_halal" placeholder="Masukkan Jumlah Sertifikasi Halal" required>
          </div>

          <div>
            <label>Sertifikasi Merek</label>
            <input type="number" name="sertifikasi_merek" placeholder="Masukkan Jumlah Sertifikasi Merek" required>
          </div>

          <div>
            <label>Peken</label>
            <input type="number" name="peken" placeholder="Masukkan Jumlah Umkm Terdaftar Peken" required>
          </div>

          <div style="grid-column: 1 / -1;">
            <label>Padat Karya </label>
            <input type="number" name="padat_karya" placeholder="Masukkan Jumlah Umkm Terdaftar Padat Karya" required>
          </div>

        </div>

        <button class="btn">Simpan Data</button>

      </form>

    </div>
  </div>

  <script>
    document.getElementById('kecamatan').addEventListener('change', function() {
        let kecamatan_id = this.value;

        fetch('/get-kelurahan/' + kecamatan_id)
            .then(response => response.json())
            .then(data => {
                let kelurahan = document.getElementById('kelurahan');
                kelurahan.innerHTML = '<option value="">Pilih Kelurahan</option>';

                data.forEach(item => {
                    kelurahan.innerHTML += 
                        `<option value="${item.ID_KELURAHAN}">${item.NM_KELURAHAN}</option>`;
                });
            });
    });
  </script>
</body>
</html>