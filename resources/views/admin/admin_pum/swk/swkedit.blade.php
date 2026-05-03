<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit SWK</title>

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
      min-height: 90vh;
      margin-top: 20px;
      padding: 20px;
      margin-bottom: 30px;
    }

    /* CARD (GLASS EFFECT) */
    .card {
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(10px);
      padding: 25px;
      width: 100%;
      height: auto;
      display: flex;
      flex-direction: column;
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
      grid-template-columns: repeat(2, 1fr);
      gap: 16px;
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

    /* FILE TEXT */
    .file-note {
      font-size: 11px;
      color: #9ca3af;
      margin-top: 2px;
    }

    /* BUTTON */
    .btn {
      margin-top: 15px;
      padding: 10px;
      width: 100%;
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
  
    .section {
      margin-top: 18px;
    }

    .section-title {
      font-size: 13px;
      font-weight: 600;
      color: #374151;
      margin-bottom: 8px;
    }

    .kategori-box {
      height: 120px;
      border-radius: 8px;
      border: 1px solid #d1d5db;
      padding: 5px;
      font-size: 13px;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        .container {
            align-items: flex-start;
            margin-top: 0;
            padding-top: 30px;
        }
    }
  </style>
</head>

<body>

  <div class="navbar">
    <h3>Admin Pemberdayaan Usaha Mikro</h3>
    <div>Edit Data</div>
  </div>

  <div class="container">
    <div class="card">

      <div class="header">
        <h2>Edit SWK</h2>
        <a href="/admin/admin_pum/adminswk" class="back">← Kembali</a>
      </div>

      <form action="/admin/admin_pum/swkupdate/{{ $data->id }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-grid">

          <div>
            <label>Nama SWK</label>
            <input name="nama_swk" type="text" value="{{ $data->nama_swk }}" required>
          </div>

          <div>
            <label>Alamat</label>
            <input name="alamat" type="text" value="{{ $data->alamat }}" required>
          </div>

            <div>
            <label>Kecamatan</label>
            <select id="kecamatan">
                <option value="">Pilih Kecamatan</option>
                @foreach($kecamatan as $k)
                <option value="{{ $k->ID_KECAMATAN }}"
                    {{ $data->kelurahan->kecamatan->ID_KECAMATAN == $k->ID_KECAMATAN ? 'selected' : '' }}>
                    {{ $k->NM_KECAMATAN }}
                </option>
                @endforeach
            </select>
            </div>

            <div>
            <label>Kelurahan</label>
            <select id="kelurahan" name="kelurahan_id">
                <option value="">Loading...</option>
            </select>
            </div>

          <div>
            <label>Jumlah Pedagang</label>
            <input name="jumlah_pedagang" type="number" value="{{ $data->jumlah_pedagang }}" min="0">
          </div>

          <div>
            <label>Jumlah Stan</label>
            <input name="jumlah_stan" type="number" value="{{ $data->jumlah_stan }}" min="0">
          </div>

          <div>
            <label>Stan Belum Terisi</label>
            <input name="stan_belum_terisi" type="number" value="{{ $data->stan_belum_terisi }}" min="0">
          </div>

        </div>

        <button class="btn">Update Data</button>

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
                        kelurahan.innerHTML += `
                            <option value="${item.ID_KELURAHAN}" ${isSelected}>
                                ${item.NM_KELURAHAN}
                            </option>
                        `;
                    });
                });
        }

        // 🔥 AUTO LOAD saat edit dibuka
        if(kecamatan.value){
            loadKelurahan(kecamatan.value, selectedKelurahan);
        }

        // 🔥 GANTI kecamatan → reload kelurahan
        kecamatan.addEventListener('change', function(){
            loadKelurahan(this.value);
        });

    });
  </script>

</body>
</html>