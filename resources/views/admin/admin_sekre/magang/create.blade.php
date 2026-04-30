<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Magang</title>
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
            min-height: 90vh;
            padding: 20px;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            padding: 25px;
            width: 100%;
            max-width: 900px;
            border-radius: 14px;
            border: 1px solid rgba(255, 255, 255, 0.4);
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
            color: #374151;
        }

        .back {
            font-size: 13px;
            text-decoration: none;
            color: #6b7280;
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

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border-radius: 7px;
            border: 1px solid #d1d5db;
            font-size: 13px;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #0d6efd;
            box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .error {
            font-size: 11px;
            color: #dc3545;
            margin-top: 2px;
        }

        .btn {
            margin-top: 12px;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #0d6efd;
            color: white;
            font-weight: 500;
            cursor: pointer;
            transition: .3s;
        }

        .btn:hover {
            background: #0b5ed7;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(13, 110, 253, 0.2);
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h3>Admin Surat</h3>
        <div>Tambah Data Magang</div>
    </div>

    <div class="container">
        <div class="card">

            <div class="header">
                <h2>Tambah Data Magang</h2>
                <a href="{{ route('magang.index') }}" class="back">← Kembali</a>
            </div>

            <form action="{{ route('magang.store') }}" method="POST">
                @csrf
                <div class="form-grid">

                    <div>
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required>
                        @error('email') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label>Nama</label>
                        <input name="nama" value="{{ old('nama') }}" required>
                        @error('nama') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label>Asal Univ</label>
                        <input name="asal_univ" value="{{ old('asal_univ') }}" required>
                        @error('asal_univ') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label>Awal Pelaksanaan</label>
                        <input type="date" name="awal_pelaksanaan" value="{{ old('awal_pelaksanaan') }}" required>
                        @error('awal_pelaksanaan') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label>Akhir Pelaksanaan</label>
                        <input type="date" name="akhir_pelaksanaan" value="{{ old('akhir_pelaksanaan') }}" required>
                        @error('akhir_pelaksanaan') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label>Posisi</label>
                        <input name="posisi" value="{{ old('posisi') }}" required>
                        @error('posisi') <div class="error">{{ $message }}</div> @enderror
                    </div>

                </div>
                <button class="btn">Simpan Data</button>
            </form>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const awalInput = document.querySelector('input[name="awal_pelaksanaan"]');
            const akhirInput = document.querySelector('input[name="akhir_pelaksanaan"]');
            const durasiInput = document.querySelector('input[name="durasi"]');

            function calculateDuration() {
                const awal = new Date(awalInput.value);
                const akhir = new Date(akhirInput.value);

                if (awalInput.value && akhirInput.value && akhir > awal) {
                    const diffTime = Math.abs(akhir - awal);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    const diffMonths = Math.round(diffDays / 30); // Asumsi 30 hari per bulan

                    durasiInput.value = diffMonths + ' bulan';
                } else {
                    durasiInput.value = '';
                }
            }

            awalInput.addEventListener('change', calculateDuration);
            akhirInput.addEventListener('change', calculateDuration);
        });
    </script>

</body>
</html>
