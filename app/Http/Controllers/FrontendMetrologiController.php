<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetrologiAlat;
use App\Models\MetrologiReparasi;
use App\Models\Kecamatan; // 🔥 TAMBAHAN: Panggil model Kecamatan

class FrontendMetrologiController extends Controller
{
    public function getData(Request $request)
    {
        $jenis = $request->jenis;
        $tahun = $request->tahun;
        $kecamatan = $request->kecamatan; // 🔥 Tangkap filter kecamatan

        // 1. KODE UNTUK MENAMPILKAN TOTAL DI CARD
        if (!$jenis) {
            return response()->json([
                'jumlah' => [
                    'alat' => MetrologiAlat::sum('jumlah') ?? 0, 
                    'reparasi' => MetrologiReparasi::sum('jumlah') ?? 0
                ]
            ]);
        }

        // 🔥 Ambil daftar semua kecamatan untuk dropdown filter frontend
        $kecamatan_list = Kecamatan::orderBy('NM_KECAMATAN', 'asc')->pluck('NM_KECAMATAN');

        // 2. Jika request meminta data tabel 'Alat Ukur' (Tidak pakai kecamatan)
        if ($jenis === 'alat') {
            $query = MetrologiAlat::query();
            
            if ($tahun) {
                $query->where('tahun', $tahun);
            }
            
            $data = $query->orderBy('tahun', 'desc')->get();
            $tahun_list = MetrologiAlat::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');
            
            return response()->json([
                'data' => $data,
                'tahun_list' => $tahun_list,
                'kecamatan_list' => [] // Kosong karena alat tidak pakai kecamatan
            ]);
        }

        // 3. Jika request meminta data tabel 'Tanda Daftar Reparasi' (Pakai kecamatan)
        if ($jenis === 'reparasi') {
            $query = MetrologiReparasi::query();
            
            if ($tahun) {
                $query->where('tahun', $tahun);
            }

            // 🔥 Filter Kecamatan
            if ($kecamatan) {
                $query->where('kecamatan', $kecamatan);
            }
            
            $data = $query->orderBy('tahun', 'desc')->get();
            $tahun_list = MetrologiReparasi::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');
            
            return response()->json([
                'data' => $data,
                'tahun_list' => $tahun_list,
                'kecamatan_list' => $kecamatan_list // Kirim list kecamatan
            ]);
        }
    }
}