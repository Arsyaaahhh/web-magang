<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Surat;
use App\Models\Koperasi;

class DashboardController extends Controller
{

public function index()
{
    if(!session('login')){
        return redirect('/');
    }

    $sekretariat = Surat::where('bidang','sekretariat')->count();
    $mikro       = Surat::where('bidang','mikro')->count();
    $distribusi  = Surat::where('bidang','perdagangan')->count();
    $koperasi    = Surat::where('bidang','koperasi')->count();
    $pembinaan   = Surat::where('bidang','pembinaan')->count();
    $metrologi   = Surat::where('bidang','metrologi')->count();
    $totalJumlah = Koperasi::sum('jumlah');

    $chartData = [
        $sekretariat,
        $mikro,
        $distribusi,
        $koperasi,
        $pembinaan,
        $metrologi
    ];

    // 🔥 TREND PER TAHUN (DINAMIS)
    $trend = Surat::select('tahun', DB::raw('count(*) as total'))
        ->groupBy('tahun')
        ->orderBy('tahun')
        ->get();

    $trendLabels = $trend->pluck('tahun');
    $trendData   = $trend->pluck('total');

    return view('dashboard', compact(
        'sekretariat',
        'mikro',
        'distribusi',
        'koperasi',
        'pembinaan',
        'metrologi',
        'chartData',
        'trendLabels',
        'trendData',
        'totalJumlah'
    ));
}
}