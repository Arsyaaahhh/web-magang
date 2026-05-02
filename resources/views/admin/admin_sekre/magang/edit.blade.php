<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<!-- 🔥 Tag wajib untuk responsive -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Data Magang</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{background:linear-gradient(135deg,#eef4ff,#f8fafc); min-height: 100vh;}

.navbar{background:white;padding:15px 30px;display:flex;justify-content:space-between;box-shadow:0 2px 10px rgba(0,0,0,0.04);}
.navbar h3{color:#0d6efd; font-size: 18px;}

.container{display:flex;justify-content:center;align-items:center;min-height:calc(100vh - 60px);padding:20px;}
.card{background:rgba(255,255,255,0.95);backdrop-filter:blur(8px);padding:25px;width:100%;max-width:900px;border-radius:14px;border:1px solid rgba(255,255,255,0.4);box-shadow:0 8px 20px rgba(13,110,253,0.08);}

.header{display:flex;justify-content:space-between;align-items:center;margin-bottom:15px;}
.header h2{font-size:18px;color:#374151;}
.back{font-size:13px;text-decoration:none;color:#6b7280;}

.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:15px;}
label{font-size:12px;color:#6b7280;margin-bottom:5px;display:block;}
input, textarea, select{width:100%;padding:10px;border-radius:7px;border:1px solid #d1d5db;font-size:13px;}
input:focus, textarea:focus, select:focus{outline:none;border-color:#0d6efd;box-shadow:0 0 0 2px rgba(13,110,253,0.1);}
textarea{resize:vertical;min-height:100px;}

.error{font-size:11px;color:#dc3545;margin-top:4px;}
.btn{margin-top:15px; width:100%; padding:12px;border:none;border-radius:8px;background:#0d6efd;color:white;font-weight:500;cursor:pointer;transition:.3s;}
.btn:hover{background:#0b5ed7;transform:translateY(-1px);box-shadow:0 4px 10px rgba(13,110,253,0.2);}

/* 🔥 MEDIA QUERY RESPONSIVE (SMARTPHONE) */
@media screen and (max-width: 768px) {
    .form-grid { grid-template-columns: 1fr; } /* Form menjadi 1 baris ke bawah */
    .navbar { padding: 15px 20px; }
    .card { padding: 20px; }
}
</style>
</head>
<body>

<div class="navbar">
    <h3>Admin Surat</h3>
    <div style="font-size: 14px; color:#666;">Edit Data Magang</div>
</div>

<div class="container">
    <div class="card">
        <div class="header">
            <h2>Edit Data Magang</h2>
            <a href="{{ route('magang.index') }}" class="back">← Kembali</a>
        </div>

        <form action="{{ route('magang.update', $data->id) }}" method="POST">
        @csrf
        <div class="form-grid">
            <div><label>Email</label><input type="email" name="email" value="{{ old('email', $data->email) }}" required>@error('email')<div class="error">{{ $message }}</div>@enderror</div>
            <div><label>Nama</label><input name="nama" value="{{ old('nama', $data->nama) }}" required>@error('nama')<div class="error">{{ $message }}</div>@enderror</div>
            <div><label>NIM</label><input name="nim" value="{{ old('nim', $data->nim) }}" required>@error('nim')<div class="error">{{ $message }}</div>@enderror</div>
            <div><label>Asal Univ</label><input name="asal_univ" value="{{ old('asal_univ', $data->asal_univ) }}" required>@error('asal_univ')<div class="error">{{ $message }}</div>@enderror</div>
            <div style="grid-column:1 / -1;"><label>Alamat</label><textarea name="alamat" required>{{ old('alamat', $data->alamat) }}</textarea>@error('alamat')<div class="error">{{ $message }}</div>@enderror</div>
            <div><label>Kelurahan Domisili</label><input name="kelurahan" value="{{ old('kelurahan', $data->kelurahan) }}" required>@error('kelurahan')<div class="error">{{ $message }}</div>@enderror</div>
            <div><label>Kecamatan</label><input name="kecamatan" value="{{ old('kecamatan', $data->kecamatan) }}" required>@error('kecamatan')<div class="error">{{ $message }}</div>@enderror</div>
            <div><label>No HP</label><input name="no_hp" value="{{ old('no_hp', $data->no_hp) }}" required>@error('no_hp')<div class="error">{{ $message }}</div>@enderror</div>
            <div><label>Awal Pelaksanaan</label><input type="date" name="awal_pelaksanaan" value="{{ old('awal_pelaksanaan', $data->awal_pelaksanaan) }}" required>@error('awal_pelaksanaan')<div class="error">{{ $message }}</div>@enderror</div>
            <div><label>Akhir Pelaksanaan</label><input type="date" name="akhir_pelaksanaan" value="{{ old('akhir_pelaksanaan', $data->akhir_pelaksanaan) }}" required>@error('akhir_pelaksanaan')<div class="error">{{ $message }}</div>@enderror</div>
            <div><label>Durasi</label><input name="durasi" value="{{ old('durasi', $data->durasi) }}" readonly style="background:#f8fafc; cursor:not-allowed;">@error('durasi')<div class="error">{{ $message }}</div>@enderror</div>
            <div><label>Kepemilikan R2</label><select name="kepemilikan_r2" required><option value="">Pilih</option><option value="Ya" {{ old('kepemilikan_r2', $data->kepemilikan_r2)=='Ya'?'selected':'' }}>Ya</option><option value="Tidak" {{ old('kepemilikan_r2', $data->kepemilikan_r2)=='Tidak'?'selected':'' }}>Tidak</option></select>@error('kepemilikan_r2')<div class="error">{{ $message }}</div>@enderror</div>
            <div><label>Bidang</label><input name="bidang" value="{{ old('bidang', $data->bidang) }}" required>@error('bidang')<div class="error">{{ $message }}</div>@enderror</div>
            <div><label>Posisi</label><input name="posisi" value="{{ old('posisi', $data->posisi) }}" required>@error('posisi')<div class="error">{{ $message }}</div>@enderror</div>
        </div>
        <button class="btn">Update Data</button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const awalInput = document.querySelector('input[name="awal_pelaksanaan"]');
    const akhirInput = document.querySelector('input[name="akhir_pelaksanaan"]');
    const durasiInput = document.querySelector('input[name="durasi"]');

    function calculateDuration() {
        if(!durasiInput) return; // Mencegah error jika field durasi tidak ada
        const awal = new Date(awalInput.value);
        const akhir = new Date(akhirInput.value);

        if (awalInput.value && akhirInput.value && akhir > awal) {
            const diffTime = Math.abs(akhir - awal);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            const diffMonths = Math.round(diffDays / 30);
            durasiInput.value = diffMonths + ' bulan';
        } else {
            durasiInput.value = '';
        }
    }

    if(awalInput && akhirInput) {
        awalInput.addEventListener('change', calculateDuration);
        akhirInput.addEventListener('change', calculateDuration);
        calculateDuration(); // Hitung saat pertama dimuat
    }
});
</script>

</body>
</html>