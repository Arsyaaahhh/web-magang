<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah SWK</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
    body { background: linear-gradient(135deg, #eef4ff, #f8fafc); min-height: 100vh; }
    .navbar { background: white; padding: 15px 30px; display: flex; justify-content: space-between; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04); }
    .navbar h3 { color: #0d6efd; }
    .container { display: flex; justify-content: center; align-items: center; min-height: calc(100vh - 60px); padding: 20px; }
    .card { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(10px); padding: 25px; width: 100%; max-width: 800px; border-radius: 14px; border: 1px solid rgba(255, 255, 255, 0.4); box-shadow: 0 8px 20px rgba(13, 110, 253, 0.08); }
    .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
    .header h2 { font-size: 18px; color: #374151; }
    .back { font-size: 13px; text-decoration: none; color: #6b7280; }
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    label { font-size: 12px; color: #6b7280; margin-bottom: 3px; display: block; }
    input, select { width: 100%; padding: 8px; border-radius: 7px; border: 1px solid #d1d5db; font-size: 13px; }
    input:focus, select:focus { outline: none; border-color: #0d6efd; box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.1); }
    .btn { margin-top: 15px; width: 100%; padding: 10px; border: none; border-radius: 8px; background: #0d6efd; color: white; font-weight: 500; cursor: pointer; transition: 0.3s; }
    .btn:hover { background: #0b5ed7; transform: translateY(-1px); box-shadow: 0 4px 10px rgba(13, 110, 253, 0.2); }

    @media (max-width: 600px) {
        .form-grid { grid-template-columns: 1fr; }
        .navbar { padding: 15px 20px; }
        .card { padding: 20px; }
        .header h2 { font-size: 16px; }
    }
  </style>
</head>
<body>
  <div class="navbar">
    <h3>Admin SWK</h3>
    <div style="font-size: 14px; color:#666;">Tambah Data</div>
  </div>
  <div class="container">
    <div class="card">
      <div class="header">
        <h2>Tambah Data SWK</h2>
        <a href="/admin/admin_pum/adminswk" class="back">← Kembali</a>
      </div>
      <form action="/admin/admin_pum/swkstore" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid">
          <div><label>Nama SWK</label><input type="text" name="nama_swk" placeholder="Masukkan Nama SWK" required></div>
          <div><label>Alamat</label><input type="text" name="alamat" placeholder="Masukkan Alamat SWK" required></div>
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
            <select id="kelurahan" name="kelurahan_id" required><option value="">Pilih Kelurahan</option></select>
          </div>
          <div><label>Jumlah Pedagang</label><input type="number" name="jumlah_pedagang" placeholder="Masukkan Jumlah Pedagang" required></div>
          <div><label>Jumlah Stan</label><input type="number" name="jumlah_stan" placeholder="Masukkan Jumlah Stan" required></div>
          <div style="grid-column: 1 / -1;"><label>Stan Belum Terisi</label><input type="number" name="stan_belum_terisi" placeholder="Masukkan Jumlah Stan Belum Terisi" required></div>
        </div>
        <button class="btn">Simpan Data</button>
      </form>
    </div>
  </div>

  <script>
    document.getElementById('kecamatan').addEventListener('change', function() {
        fetch('/get-kelurahan/' + this.value)
            .then(response => response.json())
            .then(data => {
                let kelurahan = document.getElementById('kelurahan');
                kelurahan.innerHTML = '<option value="">Pilih Kelurahan</option>';
                data.forEach(item => kelurahan.innerHTML += `<option value="${item.ID_KELURAHAN}">${item.NM_KELURAHAN}</option>`);
            });
    });
  </script>
</body>
</html>