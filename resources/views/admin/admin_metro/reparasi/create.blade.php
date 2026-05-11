<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Reparasi</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
    body { background: linear-gradient(135deg, #eef4ff, #f8fafc); min-height: 100vh; }
    .navbar { background: white; padding: 15px 30px; display: flex; justify-content: space-between; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04); }
    .navbar h3 { color: #0d6efd; }
    .container { display: flex; justify-content: center; align-items: center; min-height: calc(100vh - 60px); padding: 20px; }
    .card { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(10px); padding: 25px; width: 100%; max-width: 600px; border-radius: 14px; border: 1px solid rgba(255, 255, 255, 0.4); box-shadow: 0 8px 20px rgba(13, 110, 253, 0.08); }
    .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .header h2 { font-size: 18px; color: #374151; }
    .back { font-size: 13px; text-decoration: none; color: #6b7280; font-weight: 500; padding: 6px 12px; border: 1px solid #d1d5db; border-radius: 6px; background: white; transition: 0.2s; }
    .back:hover { background: #f3f4f6; color: #374151; }
    .form-grid { display: grid; grid-template-columns: 1fr; gap: 15px; }
    label { font-size: 12px; color: #6b7280; margin-bottom: 4px; display: block; font-weight: 500; }
    
    /* 🔥 CSS diupdate agar select juga cantik styling-nya */
    input, select { width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #d1d5db; font-size: 13px; outline: none; transition: 0.2s; background: white; }
    input:focus, select:focus { border-color: #0d6efd; box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1); }
    
    .error { font-size: 12px; color: #dc3545; margin-top: 5px; }
    .btn { margin-top: 20px; width: 100%; padding: 12px; border: none; border-radius: 8px; background: #0d6efd; color: white; font-weight: 500; cursor: pointer; transition: 0.3s; }
    .btn:hover { background: #0b5ed7; transform: translateY(-1px); box-shadow: 0 4px 10px rgba(13, 110, 253, 0.2); }
  </style>
</head>
<body>
  <div class="navbar">
    <h3>Admin Metrologi Legal</h3>
    <div style="font-size: 14px; color:#666;">Tambah Data</div>
  </div>
  <div class="container">
    <div class="card">
      <div class="header">
        <h2>Tambah Data Rekomendasi TDR</h2>
        <a href="/admin/admin_metro/reparasi" class="back">← Kembali</a>
      </div>
      <form action="/admin/admin_metro/reparasi/store" method="POST">
        @csrf
        <div class="form-grid">
          <div>
            <label>Tahun</label>
            <input type="number" name="tahun" value="{{ old('tahun') }}" placeholder="Contoh: 2026" required min="2000">
            @error('tahun') <div class="error">{{ $message }}</div> @enderror
          </div>

          <div>
            <label>Kecamatan</label>
            <select name="kecamatan" required>
                <option value="">-- Pilih Kecamatan --</option>
                @if(isset($list_kecamatan))
                    @foreach($list_kecamatan as $k)
                        <option value="{{ $k->NM_KECAMATAN }}" {{ old('kecamatan') == $k->NM_KECAMATAN ? 'selected' : '' }}>
                            {{ $k->NM_KECAMATAN }}
                        </option>
                    @endforeach
                @endif
            </select>
            @error('kecamatan') <div class="error">{{ $message }}</div> @enderror
          </div>

          <div>
            <label>Jumlah Bengkel / TDR (Unit)</label>
            <input type="number" name="jumlah" value="{{ old('jumlah') }}" placeholder="Masukkan Jumlah" required min="0">
            @error('jumlah') <div class="error">{{ $message }}</div> @enderror
          </div>
        </div>
        <button class="btn">Simpan Data</button>
      </form>
    </div>
  </div>
</body>
</html>