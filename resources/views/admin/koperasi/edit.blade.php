<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Koperasi</title>

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

    .card {
      background: rgba(255, 255, 255, 0.9);
      padding: 25px;
      width: 100%;
      max-width: 800px;
      border-radius: 14px;
      box-shadow: 0 8px 20px rgba(13, 110, 253, 0.08);
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
    }

    .header h2 {
      font-size: 18px;
    }

    /* Tampilan tombol kembali dirapikan */
    .back {
      font-size: 13px;
      text-decoration: none;
      color: #6b7280;
    }
    .back:hover {
      color: #374151;
    }

    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
    }

    label {
      font-size: 12px;
      color: #6b7280;
      margin-bottom: 3px;
      display: block;
    }

    input, select {
      width: 100%;
      padding: 8px;
      border-radius: 7px;
      border: 1px solid #d1d5db;
      font-size: 13px;
    }

    input:focus, select:focus {
      outline: none;
      border-color: #0d6efd;
    }

    .btn {
      margin-top: 15px;
      padding: 10px;
      background: #0d6efd;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      width: 100%;
      font-weight: 500;
      transition: 0.3s;
    }
    .btn:hover {
      background: #0b5ed7;
    }

    /* 🔥 MEDIA QUERY RESPONSIVE (SMARTPHONE) */
    @media (max-width: 600px) {
      .form-grid {
        grid-template-columns: 1fr; /* Form menjadi 1 baris ke bawah di HP */
      }
      .navbar {
        padding: 15px 20px;
      }
    }
  </style>
</head>

<body>

<div class="navbar">
  <h3>Admin Koperasi</h3>
  <div style="font-size: 14px; color: #666;">Edit Data</div>
</div>

<div class="container">
  <div class="card">

    <div class="header">
      <h2>Edit Data Koperasi</h2>
      <a href="/admin/koperasi/" class="back">← Kembali</a>
    </div>

<form action="/admin/koperasi/update/{{ $data->id }}" method="POST">
@csrf

<div class="form-grid">

  <div>
    <label>Kecamatan</label>
    <select name="ID_KECAMATAN" id="kecamatan" required>
      <option value="">-- Pilih Kecamatan --</option>
      @foreach($kecamatan as $k)
        <option value="{{ $k->ID_KECAMATAN }}" {{ $data->ID_KECAMATAN == $k->ID_KECAMATAN ? 'selected' : '' }}>
          {{ $k->NM_KECAMATAN }}
        </option>
      @endforeach
    </select>
  </div>

  <div>
    <label>Kelurahan</label>
    <select name="ID_KELURAHAN" id="kelurahan" required>
      <option value="">-- Pilih Kelurahan --</option>
      @foreach($kelurahan as $kel)
        <option value="{{ $kel->ID_KELURAHAN }}" {{ $data->ID_KELURAHAN == $kel->ID_KELURAHAN ? 'selected' : '' }}>
          {{ $kel->NM_KELURAHAN }}
        </option>
      @endforeach
    </select>
  </div>

  <div>
    <label>Jumlah Koperasi</label>
    <input type="number" name="jumlah" value="{{ old('jumlah', $data->jumlah) }}" required min="0">
  </div>

  <div>
    <label>Tahun</label>
    <input type="year" name="tahun" value="{{ old('tahun', $data->tahun) }}" required min="1900">
  </div>

  <div>
    <label>Status</label>
    <select name="status" required>
      <option value="aktif" {{ $data->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
      <option value="tidak aktif" {{ $data->status == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
    </select>
  </div>

  <div>
    <label>Status Mitra</label>
    <select name="status_mitra" required>
      <option value="bermitra" {{ $data->status_mitra == 'bermitra' ? 'selected' : '' }}>Bermitra</option>
      <option value="belum" {{ $data->status_mitra == 'belum' ? 'selected' : '' }}>Belum</option>
    </select>
  </div>

  <div>
    <label>Jenis Mitra</label>
    <select name="jenis_mitra" required>
      <option value="perbankan" {{ $data->jenis_mitra == 'perbankan' ? 'selected' : '' }}>Perbankan</option>
      <option value="non" {{ $data->jenis_mitra == 'non' ? 'selected' : '' }}>Non Perbankan</option>
    </select>
  </div>

  <div>
    <label>Padat Karya</label>
    <select name="padat_karya" required>
      <option value="YA" {{ $data->padat_karya == 'YA' ? 'selected' : '' }}>YA</option>
      <option value="TIDAK" {{ $data->padat_karya == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
    </select>
  </div>

  <div>
    <label>Status LPJ</label>
    <select name="status_lpj" required>
      <option value="LENGKAP" {{ $data->status_lpj == 'LENGKAP' ? 'selected' : '' }}>LENGKAP</option>
      <option value="TIDAK LENGKAP" {{ $data->status_lpj == 'TIDAK LENGKAP' ? 'selected' : '' }}>TIDAK LENGKAP</option>
    </select>
  </div>

  <div>
    <label>Pelaksanaan RAT</label>
    <input type="number" name="pelaksanaan_rat" value="{{ old('pelaksanaan_rat', $data->pelaksanaan_rat) }}" required min="0">
  </div>

</div>

<button class="btn">Update</button>
</form>

  </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let kecamatan = document.getElementById('kecamatan');
        let kelurahan = document.getElementById('kelurahan');
        let selectedKelurahan = "{{ $data->kelurahan_id }}";

        function loadKelurahan(kecamatan_id, selected = null){
            fetch('/get-kelurahan/' + kecamatan_id)
                .then(res => res.json())
                .then(data => {
                    kelurahan.innerHTML = '<option value="">Pilih Kelurahan</option>';
                    data.forEach(item => {
                        let isSelected = item.ID_KELURAHAN == selected ? 'selected' : '';
                        kelurahan.innerHTML += `<option value="${item.ID_KELURAHAN}" ${isSelected}>${item.NM_KELURAHAN}</option>`;
                    });
                });
        }
        if(kecamatan.value){ loadKelurahan(kecamatan.value, selectedKelurahan); }
        kecamatan.addEventListener('change', function(){ loadKelurahan(this.value); });
    });
</script>
</body>
</html>