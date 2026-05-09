<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetrologiAlat;
use App\Models\MetrologiReparasi;

class FrontendMetrologiController extends Controller
{
    public function getData(Request $request)
    {
        $jenis = $request->jenis;
        $tahun = $request->tahun;

        // 1. Jika request tidak membawa parameter 'jenis', kembalikan total untuk Card Menu
        // if (!$jenis) {
        //     return response()->json([
        //         'jumlah' => [
        //             'alat' => MetrologiAlat::sum('jumlah') ?? 0, 
        //             'reparasi' => MetrologiReparasi::sum('jumlah') ?? 0
        //         ]
        //     ]);
        // }

        // 2. Jika request meminta data tabel 'Alat Ukur'
        if ($jenis === 'alat') {
            $query = MetrologiAlat::query();
            
            if ($tahun) {
                $query->where('tahun', $tahun);
            }
            
            $data = $query->orderBy('tahun', 'desc')->get();
            $tahun_list = MetrologiAlat::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');
            
            return response()->json([
                'data' => $data,
                'tahun_list' => $tahun_list
            ]);
        }

        // 3. Jika request meminta data tabel 'Tanda Daftar Reparasi'
        if ($jenis === 'reparasi') {
            $query = MetrologiReparasi::query();
            
            if ($tahun) {
                $query->where('tahun', $tahun);
            }
            
            $data = $query->orderBy('tahun', 'desc')->get();
            $tahun_list = MetrologiReparasi::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');
            
            return response()->json([
                'data' => $data,
                'tahun_list' => $tahun_list
            ]);
        }
    }
}