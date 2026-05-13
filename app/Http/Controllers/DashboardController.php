<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Surat;             
use App\Models\Umkm;              
use App\Models\Swk;               
use App\Models\Pasar;             
use App\Models\Tokokelontong;     
use App\Models\Koperasi;          
use App\Models\Tdg;               
use App\Models\Pengawasan;        
use App\Models\Alkohol;           
use App\Models\MetrologiAlat;     
use App\Models\MetrologiReparasi; 

class DashboardController extends Controller
{
    public function index()
    {
        // 1. HITUNG JUMLAH BARIS DATA
        $sekretariat = Surat::count();
        $mikro = Umkm::count() + Swk::count();
        $distribusi = Pasar::count() + Tokokelontong::count();
        $koperasi = Koperasi::count();
        $totalJumlah = $koperasi;
        $pembinaan = Tdg::count() + Pengawasan::count() + Alkohol::count();
        $metrologi = MetrologiAlat::count() + MetrologiReparasi::count();

        // 2. MASUKKAN KE DALAM ARRAY UNTUK CHART BAR (Kategori Utama)
        $chartData = [
            $sekretariat, 
            $mikro, 
            $distribusi, 
            $koperasi, 
            $pembinaan, 
            $metrologi
        ];

        // 3. CHART TREND KINERJA (LPPD)
        $trendLppd = DB::table('lppd')
            ->select('tahun', 'jumlah')
            ->orderBy('tahun', 'asc')
            ->get();

            // 4. 🔥 AMBIL DATA KOPERASI AKTIF PER TAHUN
        $koperasiAktif = Koperasi::select('tahun as tahun', DB::raw('count(*) as total'))
            ->where('status', 'Aktif') // Asumsi nama kolomnya 'status'. Jika berbeda (misal 'status_koperasi'), ubah kata 'status' ini.
            ->whereNotNull('tahun')
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->get();
            
        // 5. AMBIL DATA ALAT UTTP PER TAHUN
        $trendUttp = MetrologiAlat::select('tahun', DB::raw('SUM(jumlah) as total'))
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->get();

        // 6. LEMPAR DATA KE TAMPILAN BLADE
        return view('dashboard', compact(
            'sekretariat', 
            'mikro', 
            'distribusi', 
            'koperasi', 
            'totalJumlah',
            'pembinaan', 
            'metrologi',
            'chartData',
            'trendLppd',
            'koperasiAktif', // 🔥 Melempar data koperasi aktif ke frontend
            'trendUttp' 
        ));
    }
}