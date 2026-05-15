<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah SWK</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  
  <link 
      rel="stylesheet" 
      href="https://unpkg.com/leaflet/dist/leaflet.css"
  />

  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

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

  .full-width{
      grid-column:1 / -1;
  }

  .preview-box{
      margin-top:12px;
      width:100%;
      height:250px;
      border:2px dashed #cbd5e1;
      border-radius:12px;
      display:flex;
      justify-content:center;
      align-items:center;
      flex-direction:column;
      overflow:hidden;
      background:#f8fafc;
      position:relative;
  }

  .preview-box img{
      width:100%;
      height:100%;
      object-fit:cover;
      display:none;
  }

  .preview-box span{
      color:#94a3b8;
      font-size:14px;
      position:absolute;
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
          <div><label>Stan Belum Terisi</label><input type="number" name="stan_belum_terisi" placeholder="Masukkan Jumlah Stan Belum Terisi" required></div>
          <div><label>Peken</label><input type="number" name="peken" placeholder="Masukkan Jumlah Peken" required></div>
          <div><label>Luas (m2)</label><input type="number" name="luas" placeholder="Masukkan Luas SWK" required></div>
          <div><label>Kapasitas (Pengunjung)</label><input type="number" name="kapasitas" placeholder="Masukkan Kapasitas SWK" required></div>

          <!-- foto -->
          <div class="full-width">

              <label>Foto SWK</label>

              <input 
                  type="file" 
                  name="foto" 
                  id="fotoInput"
                  accept="image/*"
                  onchange="previewImage(event)"
              >

              <!-- PREVIEW -->
              <!-- <div class="preview-box" id="previewBox">

                  <img id="previewImage" src="" alt="Preview Foto">

                  <span>Preview Foto SWK</span>

              </div> -->

          </div>

          <!-- map -->
          <div>
              <label>Latitude</label>
              <input 
                  type="text" 
                  name="latitude" 
                  id="latitude"
                  placeholder="Masukkan Latitude"
                  required
              >
          </div>

          <div>
              <label>Longitude</label>
              <input 
                  type="text" 
                  name="longitude" 
                  id="longitude"
                  placeholder="Masukkan Longitude"
                  required
              >
          </div>

          <!-- <div class="full-width">
              <button 
                  type="button" 
                  onclick="getLocation()" 
                  style="
                      padding:10px 14px;
                      border:none;
                      border-radius:8px;
                      background:#198754;
                      color:white;
                      cursor:pointer;
                  "
              >
                  📍 Ambil Lokasi Saat Ini
              </button>
          </div> -->

          <div class="full-width">
              <div id="map" style="
                  width:100%;
                  height:300px;
                  border-radius:12px;
                  margin-top:10px;
                  overflow:hidden;
              "></div>
          </div>

        </div>
        <button class="btn">Simpan Data</button>
      </form>
    </div>
  </div>

  <script>
    // kelurahan dan kecamatan
    document.getElementById('kecamatan').addEventListener('change', function() {
        fetch('/get-kelurahan/' + this.value)
            .then(response => response.json())
            .then(data => {
                let kelurahan = document.getElementById('kelurahan');
                kelurahan.innerHTML = '<option value="">Pilih Kelurahan</option>';
                data.forEach(item => kelurahan.innerHTML += `<option value="${item.ID_KELURAHAN}">${item.NM_KELURAHAN}</option>`);
            });
    });

    // foto
    function previewImage(event)
    {
        const input = event.target;
        const preview = document.getElementById('previewImage');
        const previewBox = document.getElementById('previewBox');
        const text = previewBox.querySelector('span');

        if(input.files && input.files[0])
        {
            const reader = new FileReader();

            reader.onload = function(e)
            {
                preview.src = e.target.result;
                preview.style.display = 'block';
                text.style.display = 'none';
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // ================= MAP =================
    let defaultLat = -7.257472;
    let defaultLng = 112.752090;

    // buat map
    let map = L.map('map').setView([defaultLat, defaultLng], 13);

    // tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    // marker awal
    let marker = L.marker([defaultLat, defaultLng]).addTo(map);

    // KLIK MAP UNTUK PILIH LOKASI
    map.on('click', function(e){

        let lat = e.latlng.lat;
        let lng = e.latlng.lng;

        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;

        if(marker){
            map.removeLayer(marker);
        }

        marker = L.marker([lat, lng]).addTo(map);

    });

    // ================= UPDATE MAP DARI INPUT =================
    function updateMapFromInput()
    {
        let lat = parseFloat(document.getElementById('latitude').value);
        let lng = parseFloat(document.getElementById('longitude').value);

        // cek valid
        if(!isNaN(lat) && !isNaN(lng))
        {
            // pindahkan marker
            marker.setLatLng([lat, lng]);

            // pindahkan view map
            map.setView([lat, lng], 16);
        }
    }

    // saat mengetik latitude
    document.getElementById('latitude')
        .addEventListener('keyup', updateMapFromInput);

    // saat mengetik longitude
    document.getElementById('longitude')
        .addEventListener('keyup', updateMapFromInput);

    // saat paste
    document.getElementById('latitude')
        .addEventListener('paste', function(){
            setTimeout(updateMapFromInput, 100);
        });

    document.getElementById('longitude')
        .addEventListener('paste', function(){
            setTimeout(updateMapFromInput, 100);
        });
  </script>
</body>
</html>