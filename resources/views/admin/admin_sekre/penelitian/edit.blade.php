<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Penelitian</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: linear-gradient(135deg, #eef4ff, #f8fafc); min-height: 100vh; }
        
        .navbar { background: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04); }
        .navbar h3 { color: #0d6efd; font-size: 18px; }
        
        .container { display: flex; justify-content: center; align-items: center; min-height: calc(100vh - 60px); padding: 20px; }
        .card { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(8px); padding: 25px; width: 100%; max-width: 900px; border-radius: 14px; border: 1px solid rgba(255, 255, 255, 0.4); box-shadow: 0 8px 20px rgba(13, 110, 253, 0.08); }
        
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
        .header h2 { font-size: 18px; color: #374151; }
        .back { font-size: 13px; text-decoration: none; color: #6b7280; }
        
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .full-width { grid-column: 1 / -1; }
        
        label { font-size: 12px; color: #6b7280; margin-bottom: 5px; display: block; }
        input, textarea, select { width: 100%; padding: 10px; border-radius: 7px; border: 1px solid #d1d5db; font-size: 13px; }
        input:focus, textarea:focus, select:focus { outline: none; border-color: #0d6efd; box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.1); }
        textarea { resize: vertical; min-height: 100px; }
        
        .error { font-size: 11px; color: #dc3545; margin-top: 4px; }
        .btn { margin-top: 15px; width: 100%; padding: 12px; border: none; border-radius: 8px; background: #0d6efd; color: white; font-weight: 500; cursor: pointer; transition: .3s; }
        .btn:hover { background: #0b5ed7; transform: translateY(-1px); box-shadow: 0 4px 10px rgba(13, 110, 253, 0.2); }

        @media screen and (max-width: 768px) {
            .form-grid { grid-template-columns: 1fr; }
            .navbar { padding: 15px 20px; }
            .card { padding: 20px; }
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h3>Admin Surat</h3>
        <div style="font-size: 14px; color:#666;">Edit Data Penelitian</div>
    </div>

    <div class="container">
        <div class="card">
            <div class="header">
                <h2>Edit Data Penelitian</h2>
                <a href="{{ route('penelitian.index') }}" class="back">← Kembali</a>
            </div>

            <form action="{{ route('penelitian.update', $data->id) }}" method="POST">
                @csrf
                <div class="form-grid">
                    <div>
                        <label>Nama Mahasiswa / Peneliti</label>
                        <input type="text" name="nama" value="{{ old('nama', $data->nama) }}" required placeholder="Masukkan nama lengkap">
                        @error('nama') <p class="error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label>Universitas / Kampus</label>
                        <input type="text" name="univ" value="{{ old('univ', $data->univ) }}" required placeholder="Contoh: UNESA / ITS">
                        @error('univ') <p class="error">{{ $message }}</p> @enderror
                    </div>
                    <div class="full-width">
                        <label>Judul Penelitian / Skripsi</label>
                        <input type="text" name="judul" value="{{ old('judul', $data->judul) }}" required placeholder="Masukkan judul lengkap penelitian">
                        @error('judul') <p class="error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label>Tahun Penelitian</label>
                        <input type="number" name="tahun" value="{{ old('tahun', $data->tahun) }}" required placeholder="Contoh: 2026">
                        @error('tahun') <p class="error">{{ $message }}</p> @enderror
                    </div>
                </div>
                <button type="submit" class="btn">Perbarui Data</button>
            </form>
        </div>
    </div>

</body>
</html>
