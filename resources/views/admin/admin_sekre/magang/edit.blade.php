<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Data Magang</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
/* CSS Sama dengan Create */
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{background:linear-gradient(135deg,#eef4ff,#f8fafc); min-height: 100vh;}
.navbar{background:white;padding:15px 30px;display:flex;justify-content:space-between;box-shadow:0 2px 10px rgba(0,0,0,0.04);}
.navbar h3{color:#0d6efd; font-size: 18px;}
.container{display:flex;justify-content:center;align-items:center;min-height:calc(100vh - 60px);padding:20px;}
.card{background:rgba(255,255,255,0.95);backdrop-filter:blur(8px);padding:25px;width:100%;max-width:600px;border-radius:14px;border:1px solid rgba(255,255,255,0.4);box-shadow:0 8px 20px rgba(13,110,253,0.08);}
.header{display:flex;justify-content:space-between;align-items:center;margin-bottom:15px;}
.header h2{font-size:18px;color:#374151;}
.back{font-size:13px;text-decoration:none;color:#6b7280;}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:15px;}
.full-width { grid-column: 1 / -1; }
label{font-size:12px;color:#6b7280;margin-bottom:5px;display:block;}
input, select{width:100%;padding:10px;border-radius:7px;border:1px solid #d1d5db;font-size:13px;}
input:focus, select:focus{outline:none;border-color:#0d6efd;box-shadow:0 0 0 2px rgba(13,110,253,0.1);}
.error{font-size:11px;color:#dc3545;margin-top:4px;}
.btn{margin-top:15px; width:100%; padding:12px;border:none;border-radius:8px;background:#0d6efd;color:white;font-weight:500;cursor:pointer;transition:.3s;}
.btn:hover{background:#0b5ed7;transform:translateY(-1px);box-shadow:0 4px 10px rgba(13,110,253,0.2);}

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
    <div style="font-size: 14px; color:#666;">Edit Rekap Magang</div>
</div>

<div class="container">
    <div class="card">
        <div class="header">
            <h2>Edit Rekap Magang</h2>
            <a href="{{ route('magang.index') }}" class="back">← Kembali</a>
        </div>

        <form action="{{ route('magang.update', $data->id) }}" method="POST">
        @csrf
        <div class="form-grid">
            <div>
                <label>Tahun</label>
                <input type="number" name="tahun" value="{{ old('tahun', $data->tahun) }}" required>
                @error('tahun')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div>
                <label>Bulan</label>
                <select name="bulan" required>
                    <option value="Januari" {{ old('bulan', $data->bulan) == 'Januari' ? 'selected' : '' }}>Januari</option>
                    <option value="Februari" {{ old('bulan', $data->bulan) == 'Februari' ? 'selected' : '' }}>Februari</option>
                    <option value="Maret" {{ old('bulan', $data->bulan) == 'Maret' ? 'selected' : '' }}>Maret</option>
                    <option value="April" {{ old('bulan', $data->bulan) == 'April' ? 'selected' : '' }}>April</option>
                    <option value="Mei" {{ old('bulan', $data->bulan) == 'Mei' ? 'selected' : '' }}>Mei</option>
                    <option value="Juni" {{ old('bulan', $data->bulan) == 'Juni' ? 'selected' : '' }}>Juni</option>
                    <option value="Juli" {{ old('bulan', $data->bulan) == 'Juli' ? 'selected' : '' }}>Juli</option>
                    <option value="Agustus" {{ old('bulan', $data->bulan) == 'Agustus' ? 'selected' : '' }}>Agustus</option>
                    <option value="September" {{ old('bulan', $data->bulan) == 'September' ? 'selected' : '' }}>September</option>
                    <option value="Oktober" {{ old('bulan', $data->bulan) == 'Oktober' ? 'selected' : '' }}>Oktober</option>
                    <option value="November" {{ old('bulan', $data->bulan) == 'November' ? 'selected' : '' }}>November</option>
                    <option value="Desember" {{ old('bulan', $data->bulan) == 'Desember' ? 'selected' : '' }}>Desember</option>
                </select>
                @error('bulan')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="full-width">
                <label>Jumlah Peserta</label>
                <input type="number" name="jumlah" value="{{ old('jumlah', $data->jumlah) }}" required>
                @error('jumlah')<div class="error">{{ $message }}</div>@enderror
            </div>
        </div>
        <button class="btn">Update Data</button>
        </form>
    </div>
</div>

</body>
</html>