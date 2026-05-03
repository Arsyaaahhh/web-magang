<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umkm;
use App\Models\Swk;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

class PumController extends Controller
{
    // ================= FRONTEND PUM =================
    public function index(Request $request)
    {
        // ================= QUERY UMKM =================
        $umkmQuery = Umkm::with('kelurahan.kecamatan');

        // FILTER KECAMATAN
        if ($request->kecamatan_id) {
            $umkmQuery->whereHas('kelurahan', function ($q) use ($request) {
                $q->where('ID_KECAMATAN', $request->kecamatan_id);
            });
        }

        // FILTER KELURAHAN
        if ($request->kelurahan_id) {
            $umkmQuery->where('kelurahan_id', $request->kelurahan_id);
        }

        // Wajib di-clone agar query summary tidak merusak hasil get() data utama
        $summaryUmkmQuery = clone $umkmQuery;

        // DATA UMKM
        $umkm = $umkmQuery->get();

        // ================= SUMMARY UMKM =================
        $summaryUmkm = $summaryUmkmQuery->selectRaw('
            SUM(total_umkm) as total_umkm,
            SUM(umkm_binaan) as umkm_binaan,
            SUM(sertifikasi_halal) as sertifikasi_halal,
            SUM(sertifikasi_merek) as sertifikasi_merek,
            SUM(nib) as nib,
            SUM(peken) as peken,
            SUM(padat_karya) as padat_karya
        ')->first();

        // ================= QUERY SWK =================
        $swkQuery = Swk::with('kelurahan.kecamatan');

        // FILTER KECAMATAN
        if ($request->kecamatan_id) {
            $swkQuery->whereHas('kelurahan', function ($q) use ($request) {
                $q->where('ID_KECAMATAN', $request->kecamatan_id);
            });
        }

        // FILTER KELURAHAN
        if ($request->kelurahan_id) {
            $swkQuery->where('kelurahan_id', $request->kelurahan_id);
        }

        // Wajib di-clone agar query summary tidak merusak hasil get() data utama
        $summarySwkQuery = clone $swkQuery;

        // DATA SWK
        $swk = $swkQuery->get();

        // ================= SUMMARY SWK =================
        $summarySwk = $summarySwkQuery->selectRaw('
            COUNT(*) as total_swk,
            SUM(jumlah_pedagang) as total_pedagang,
            SUM(jumlah_stan) as total_stan,
            SUM(stan_belum_terisi) as total_stan_kosong
        ')->first();

        // ================= MASTER DATA =================
        $kecamatan = Kecamatan::all();
        $kelurahan = collect(); 

        // ================= AJAX =================
        if ($request->ajax()) {
            return response()->json([
                'umkm' => $umkm,
                'swk' => $swk,
                'summary_umkm' => $summaryUmkm,
                'summary_swk' => $summarySwk,
            ]);
        }

        // ================= VIEW =================
        // Menuju file resources/views/bidang/mikro.blade.php
        return view('bidang.mikro', compact(
            'umkm',
            'swk',
            'summaryUmkm',
            'summarySwk',
            'kecamatan',
            'kelurahan'
        ));
    }
}