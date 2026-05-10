<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasar;
use App\Models\Tokokelontong;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

class PerdaganganController extends Controller
{
    // ================= FRONTEND PUM =================
    public function index(Request $request)
    {
        // ================= QUERY PASAR =================
        $pasarQuery = Pasar::with('kelurahan.kecamatan');

        // FILTER KECAMATAN
        if ($request->kecamatan_id) {
            $pasarQuery->whereHas('kelurahan', function ($q) use ($request) {
                $q->where('ID_KECAMATAN', $request->kecamatan_id);
            });
        }

        // FILTER KELURAHAN
        if ($request->kelurahan_id) {
            $pasarQuery->where('kelurahan_id', $request->kelurahan_id);
        }

        // Wajib di-clone agar query summary tidak merusak hasil get() data utama
        $summaryPasarQuery = clone $pasarQuery;

        // DATA Pasar
        $pasar = $pasarQuery->get();

        // ================= SUMMARY PASAR =================
        $summaryPasar = $summaryPasarQuery->selectRaw('
            COUNT(*) as total_pasar,
            SUM(jumlah_pedagang) as total_pedagang,
            SUM(jumlah_stan) as total_stan,
            SUM(stan_belum_terisi) as total_stan_kosong
        ')->first();

        // ================= QUERY TOKO KELONTONG =================
        $tokokelontongQuery = Tokokelontong::with('kelurahan.kecamatan');

        // FILTER KECAMATAN
        if ($request->kecamatan_id) {
            $tokokelontongQuery->whereHas('kelurahan', function ($q) use ($request) {
                $q->where('ID_KECAMATAN', $request->kecamatan_id);
            });
        }

        // FILTER KELURAHAN
        if ($request->kelurahan_id) {
            $tokokelontongQuery->where('kelurahan_id', $request->kelurahan_id);
        }

        // Wajib di-clone agar query summary tidak merusak hasil get() data utama
        $summaryTokokelontongQuery = clone $tokokelontongQuery;

        // DATA TOKO KELONTONG
        $tokokelontong = $tokokelontongQuery->get();

        // ================= SUMMARY TOKO KELONTONG =================
        $summaryTokokelontong = $summaryTokokelontongQuery->selectRaw('
            SUM(total_toko) as total_tokokelontong,
            SUM(peken) as peken
        ')->first();

        // ================= MASTER DATA =================
        $kecamatan = Kecamatan::all();
        $kelurahan = collect(); 

        // ================= AJAX =================
        if ($request->ajax()) {
            return response()->json([
                'pasar' => $pasar,
                'tokokelontong' => $tokokelontong,
                'summary_pasar' => $summaryPasar,
                'summary_tokokelontong' => $summaryTokokelontong,
            ]);
        }

        // ================= VIEW =================
        return view('bidang.perdagangan.perdagangan', compact(
            'pasar',
            'tokokelontong',
            'summaryPasar',
            'summaryTokokelontong',
            'kecamatan',
            'kelurahan'
        ));
    }

    // // toko kelontong
    // public function tokokelontong(Request $request)
    // {
    //     // ================= QUERY TOKO KELONTONG =================
    //     $tokokelontongQuery = Tokokelontong::with('kelurahan.kecamatan');

    //     // FILTER KECAMATAN
    //     if ($request->kecamatan_id) {
    //         $tokokelontongQuery->whereHas('kelurahan', function ($q) use ($request) {
    //             $q->where('ID_KECAMATAN', $request->kecamatan_id);
    //         });
    //     }

    //     // FILTER KELURAHAN
    //     if ($request->kelurahan_id) {
    //         $tokokelontongQuery->where('kelurahan_id', $request->kelurahan_id);
    //     }

    //     // Wajib di-clone agar query summary tidak merusak hasil get() data utama
    //     $summaryTokokelontongQuery = clone $tokokelontongQuery;

    //     // DATA TOKO KELONTONG
    //     $tokokelontong = $tokokelontongQuery->get();

    //     // ================= SUMMARY TOKO KELONTONG =================
    //     $summaryTokokelontong = $summaryTokokelontongQuery->selectRaw('
    //         COUNT(*) as total_tokokelontong,
    //         SUM(peken) as peken,
    //     ')->first();

    //     // ================= MASTER DATA =================
    //     $kecamatan = Kecamatan::all();
    //     $kelurahan = collect(); 

    //     // ================= AJAX =================
    //     if ($request->ajax()) {
    //         return response()->json([
    //             'pasar' => $pasar,
    //             'tokokelontong' => $tokokelontong,
    //             'summary_pasar' => $summaryPasar,
    //             'summary_tokokelontong' => $summaryTokokelontong,
    //         ]);
    //     }

    //     // ================= VIEW =================
    //     return view('bidang.pum.tokokelontong', compact(
    //         'pasar',
    //         'tokokelontong',
    //         'summaryPasar',
    //         'summaryTokokelontong',
    //         'kecamatan',
    //         'kelurahan'
    //     ));
    // }
}