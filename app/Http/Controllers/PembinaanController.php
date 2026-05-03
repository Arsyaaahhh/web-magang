<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tdg;
use App\Models\Pengawasan;
use App\Models\Alkohol;

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

        $data = collect();
        $tahun_list = []; // Array untuk menampung daftar tahun unik

        // 1. AMBIL DATA TDG
        if ($jenis === 'tdg') {
            $query = Tdg::query();
            
            // Ambil semua tahun unik yang ada di tabel TDG
            $tahun_list = Tdg::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');
            
            if ($tahun) {
                $query->where('tahun', 'like', '%' . $tahun . '%');
            }
            $data = $query->orderBy('tahun', 'desc')->get();
        } 
        
        // 2. AMBIL DATA PENGAWASAN
        elseif ($jenis === 'pengawasan') {
            $query = Pengawasan::query();
            $queryTahun = Pengawasan::query(); // Query terpisah untuk mencari tahun
            
            if ($subJenis) {
                $query->where('jenis_pengawasan', $subJenis);
                $queryTahun->where('jenis_pengawasan', $subJenis);
            }
            
            // Ambil semua tahun unik dari tabel Pengawasan (sesuai subJenis kalau ada)
            $tahun_list = $queryTahun->select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

            if ($tahun) {
                $query->where('tahun', 'like', '%' . $tahun . '%');
            }
            $data = $query->orderBy('tahun', 'desc')->get();
        } 
        
        // 3. AMBIL DATA ALKOHOL (MINOL)
        elseif ($jenis === 'minol') {
            $query = Alkohol::query();
            $queryTahun = Alkohol::query(); // Query terpisah untuk mencari tahun
            
            if ($subJenis) {
                $query->where('golongan', $subJenis);
                $queryTahun->where('golongan', $subJenis);
            }
            
            // Ambil semua tahun unik dari tabel Alkohol (sesuai subJenis kalau ada)
            $tahun_list = $queryTahun->select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

            if ($tahun) {
                $query->where('tahun', 'like', '%' . $tahun . '%');
            }
            $data = $query->orderBy('tahun', 'desc')->get();
        }

        // KEMBALIKAN RESPON JSON DENGAN TAMBAHAN DAFTAR TAHUN
        return response()->json([
            'data' => $data,
            'tahun_list' => $tahun_list, // Mengirimkan array tahun ke frontend
            'jumlah' => [
                'tdg' => Tdg::count(),
                'pengawasan' => Pengawasan::count(),
                'minol' => Alkohol::count(),
            ]
        ]);
    }
}