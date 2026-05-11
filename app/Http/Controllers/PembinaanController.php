<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tdg;
use App\Models\Pengawasan;
use App\Models\Alkohol;
use App\Models\Kecamatan; // 🔥 TAMBAHAN: Panggil model Kecamatan

class PembinaanController extends Controller
{
    // VIEW (halaman HTML frontend)
    public function view()
    {
        return view('bidang.pembinaan');
    }

    // DATA (JSON untuk AJAX Frontend)
    public function index(Request $request)
    {
        $jenis = $request->jenis;
        $subJenis = $request->sub_jenis;
        $tahun = $request->tahun;
        $kecamatan = $request->kecamatan; // 🔥 Tangkap filter kecamatan dari JS

        $data = collect();
        $tahun_list = []; 
        
        // 🔥 Ambil daftar semua kecamatan untuk dropdown filter frontend
        $kecamatan_list = Kecamatan::orderBy('NM_KECAMATAN', 'asc')->pluck('NM_KECAMATAN');

        // 1. AMBIL DATA TDG
        if ($jenis === 'tdg') {
            $query = Tdg::query();
            
            $tahun_list = Tdg::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');
            
            if ($tahun) {
                $query->where('tahun', $tahun);
            }
            // 🔥 Filter Kecamatan untuk TDG
            if ($kecamatan) {
                $query->where('kecamatan', $kecamatan);
            }
            $data = $query->orderBy('tahun', 'desc')->get();
        } 
        
        // 2. AMBIL DATA PENGAWASAN
        elseif ($jenis === 'pengawasan') {
            $query = Pengawasan::query();
            $queryTahun = Pengawasan::query(); 
            
            if ($subJenis) {
                $query->where('jenis_pengawasan', $subJenis);
                $queryTahun->where('jenis_pengawasan', $subJenis);
            }
            
            $tahun_list = $queryTahun->select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

            if ($tahun) {
                $query->where('tahun', $tahun);
            }
            // 🔥 Filter Kecamatan untuk Pengawasan
            if ($kecamatan) {
                $query->where('kecamatan', $kecamatan);
            }
            $data = $query->orderBy('tahun', 'desc')->get();
        } 
        
        // 3. AMBIL DATA ALKOHOL (MINOL) -> Tidak pakai kecamatan
        elseif ($jenis === 'minol') {
            $query = Alkohol::query();
            $queryTahun = Alkohol::query(); 
            
            if ($subJenis) {
                $query->where('golongan', $subJenis);
                $queryTahun->where('golongan', $subJenis);
            }
            
            $tahun_list = $queryTahun->select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

            if ($tahun) {
                $query->where('tahun', $tahun);
            }
            $data = $query->orderBy('tahun', 'desc')->get();
        }

        // KEMBALIKAN RESPON JSON 
        return response()->json([
            'data' => $data,
            'tahun_list' => $tahun_list, 
            'kecamatan_list' => $kecamatan_list, // 🔥 Kirim daftar kecamatan ke frontend
            'jumlah' => [
                'tdg' => Tdg::count(),
                'pengawasan' => Pengawasan::count(),
                'minol' => Alkohol::count(),
            ]
        ]);
    }
}