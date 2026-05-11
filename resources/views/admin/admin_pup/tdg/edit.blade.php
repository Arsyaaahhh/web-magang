<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form Rekap TDG</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{background:#f4f7fb; min-height: 100vh;}

.navbar{
    background:white; padding:15px 30px; display:flex; justify-content:space-between; align-items: center;
    box-shadow:0 2px 10px rgba(0,0,0,0.05);
}

.wrapper{
    padding:40px 20px; display:flex; justify-content:center; align-items: center;
}

.card{
    width: 100%; max-width: 500px; background:white; padding:30px; 
    border-radius:16px; box-shadow:0 10px 25px rgba(0,0,0,0.05);
}

.card h2{margin-bottom:25px; font-size: 1.5rem; color: #1e293b;}

.form-group{margin-bottom:20px;}
.form-group label{display:block; margin-bottom:8px; font-weight:500; font-size: 14px; color: #64748b;}
.form-group input, .form-group select{
    width:100%; padding:12px; border-radius:10px; border:1px solid #d1d5db; 
    font-size:14px; outline: none; transition: 0.2s; background: white;
}
.form-group input:focus, .form-group select:focus{border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37,99,235,0.1);}

.error{font-size:12px; color:#ef4444; margin-top:5px;}

.btn-group{
    display:flex; gap:12px; margin-top:30px;
}
.btn{
    flex: 1; padding:12px; border:none; border-radius:10px; 
    cursor:pointer; font-weight:600; font-size: 15px; text-align: center; text-decoration: none; display: inline-block;
}
.btn-primary{background:#2563eb; color:white;}
.btn-secondary{background:#f1f5f9; color:#64748b;}

@media (max-width: 480px) {
    .card { padding: 20px; }
    .wrapper { padding: 20px 15px; }
    .btn-group { flex-direction: column; } 
}
</style>
</head>
<body>

<div class="navbar">
    <h3>Admin TDG</h3>
    <span style="font-size: 14px; color: #64748b;">Dinkopumdag Surabaya</span>
</div>

<div class="wrapper">
    <div class="card">
        <h2>{{ isset($data) ? 'Edit Data TDG' : 'Tambah Data TDG' }}</h2>
        
        <form action="{{ isset($data) ? route('tdg.update', $data->id) : route('tdg.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label>Tahun Pendataan</label>
                <input type="number" name="tahun" value="{{ $data->tahun ?? old('tahun') }}" placeholder="Contoh: 2026" required>
                @error('tahun') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Kecamatan</label>
                <select name="kecamatan" required>
                    <option value="">-- Pilih Kecamatan --</option>
                    @foreach($list_kecamatan as $k)
                        <option value="{{ $k->NM_KECAMATAN }}" 
                            {{ (isset($data) && $data->kecamatan == $k->NM_KECAMATAN) || old('kecamatan') == $k->NM_KECAMATAN ? 'selected' : '' }}>
                            {{ $k->NM_KECAMATAN }}
                        </option>
                    @endforeach
                </select>
                @error('kecamatan') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Jumlah TDG yang Terbit</label>
                <input type="number" name="jumlah" value="{{ $data->jumlah ?? old('jumlah') }}" placeholder="Total dokumen" required>
                @error('jumlah') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="btn-group">
                <a href="{{ route('tdg.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ isset($data) ? 'Update' : 'Simpan' }}
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>