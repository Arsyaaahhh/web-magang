<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Sentra Usaha</title>
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
    .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
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
        overflow:hidden;
        position:relative;
        background:#f8fafc;
        display:flex;
        justify-content:center;
        align-items:center;
        flex-direction:column;
    }

    .preview-box img{
        width:100%;
        height:100%;
        object-fit:cover;
    }

    .preview-text{
        position:absolute;
        color:#94a3b8;
        font-size:14px;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <h3>Admin Pemberdayaan Usaha Mikro</h3>
    <div style="font-size: 14px; color: #666;">Edit Data</div>
  </div>

  <div class="container">
    <div class="card">
      <div class="header">
        <h2>Edit Sentra Usaha</h2>
        <a href="/admin/admin_pum/adminsentrausaha" class="back">← Kembali</a>
      </div>
      <form action="/admin/admin_pum/sentrausahaupdate/{{ $data->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-grid">
          <div><label>Nama Sentra Usaha</label><input name="nama_sentrausaha" type="text" value="{{ $data->nama_sentrausaha }}" required></div>
          <div><label>Alamat</label><input name="alamat" type="text" value="{{ $data->alamat }}" required></div>
          <div>
            <label>Kecamatan</label>
            <select id="kecamatan">
                <option value="">Pilih Kecamatan</option>
                @foreach($kecamatan as $k)
                <option value="{{ $k->ID_KECAMATAN }}" {{ $data->kelurahan->kecamatan->ID_KECAMATAN == $k->ID_KECAMATAN ? 'selected' : '' }}>
                    {{ $k->NM_KECAMATAN }}
                </option>
                @endforeach
            </select>
          </div>
          <div>
            <label>Kelurahan</label>
            <select id="kelurahan" name="kelurahan_id"><option value="">Loading...</option></select>
          </div>
          <div><label>Luas (m2)</label><input name="luas" type="number" value="{{ $data->luas }}" min="0"></div>
          <div><label>Kapasitas (Pengunjung)</label><input name="kapasitas" type="number" value="{{ $data->kapasitas }}" min="0"></div>

          <!-- foto -->
          <div class="full-width">
              <label>Foto Sentra Usaha</label>

              <input 
                  type="file" 
                  name="foto"
                  accept="image/*"
                  onchange="previewImage(event)"
              >

              <div class="preview-box">

                  <img 
                      id="previewImage"
                      src="{{ $data->foto ? asset('storage/' . $data->foto) : 'https://via.placeholder.com/800x400?text=Belum+Ada+Foto' }}"
                      alt="Preview Foto"
                  >

                  @if(!$data->foto)
                      <span class="preview-text">
                          Belum Ada Foto
                      </span>
                  @endif
                
              </div>
          </div>

          <!-- map -->
            <div>
                <label>Latitude</label>
                <input 
                    name="latitude"
                    id="latitude"
                    type="text"
                    value="{{ $data->latitude }}"
                    required
                >
            </div>

            <div>
                <label>Longitude</label>
                <input 
                    name="longitude"
                    id="longitude"
                    type="text"
                    value="{{ $data->longitude }}"
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
                        margin-top:5px;
                    "
                >
                    📍 Ambil Lokasi Saat Ini
                </button>

            </div> -->

            <div class="full-width">

                <div 
                    id="map"
                    style="
                        width:100%;
                        height:300px;
                        border-radius:12px;
                        margin-top:10px;
                        overflow:hidden;
                    "
                ></div>

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
                        kelurahan.innerHTML += `<option value="${item.ID_KELURAHAN}" ${isSelected}>${item.NM_KELURAHAN}</option>`;
                    });
                });
        }
        if(kecamatan.value){ loadKelurahan(kecamatan.value, selectedKelurahan); }
        kecamatan.addEventListener('change', function(){ loadKelurahan(this.value); });
    });

    // foto
    function previewImage(event)
    {
        const input = event.target;
        const preview = document.getElementById('previewImage');

        if(input.files && input.files[0])
        {
            const reader = new FileReader();

            reader.onload = function(e)
            {
                preview.src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // ================= MAP =================
    let defaultLat = {{ $data->latitude ?? -7.257472 }};
    let defaultLng = {{ $data->longitude ?? 112.752090 }};

    let map = L.map('map').setView([defaultLat, defaultLng], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    // marker awal
    let marker = L.marker([defaultLat, defaultLng])
        .addTo(map)
        .bindPopup('Lokasi Sentra Usaha')
        .openPopup();


    // klik map
    map.on('click', function(e){

        let lat = e.latlng.lat;
        let lng = e.latlng.lng;

        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;

        marker.setLatLng([lat, lng]);

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

    // update saat mengetik latitude
    document.getElementById('latitude')
        .addEventListener('keyup', updateMapFromInput);

    // update saat mengetik longitude
    document.getElementById('longitude')
        .addEventListener('keyup', updateMapFromInput);

    // update saat paste latitude
    document.getElementById('latitude')
        .addEventListener('paste', function(){
            setTimeout(updateMapFromInput, 100);
        });

    // update saat paste longitude
    document.getElementById('longitude')
        .addEventListener('paste', function(){
            setTimeout(updateMapFromInput, 100);
        });

    // ambil gps device
    // function getLocation()
    // {
    //     if(navigator.geolocation)
    //     {
    //         navigator.geolocation.getCurrentPosition(function(position){

    //             let lat = position.coords.latitude;
    //             let lng = position.coords.longitude;

    //             document.getElementById('latitude').value = lat;
    //             document.getElementById('longitude').value = lng;

    //             map.setView([lat, lng], 16);

    //             marker.setLatLng([lat, lng]);

    //         });
    //     }
    //     else
    //     {
    //         alert('Browser tidak mendukung GPS');
    //     }
    // }
  </script>
</body>
</html>