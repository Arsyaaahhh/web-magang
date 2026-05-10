<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// PASTIKAN ANDA MENG-IMPORT SEMUA MODEL YANG DIBUTUHKAN DI SINI
use App\Models\Surat;             // Untuk Sekretariat
use App\Models\Umkm;              // Untuk UMKM
use App\Models\Swk;               // Untuk SWK
use App\Models\Pasar;             // Untuk Pasar
use App\Models\Tokokelontong;     // Untuk Toko Kelontong
use App\Models\Koperasi;          // Untuk Koperasi
use App\Models\Tdg;               // Untuk TDG (Pembinaan)
use App\Models\Pengawasan;        // Untuk Pengawasan (Pembinaan)
use App\Models\Alkohol;           // Untuk Alkohol (Pembinaan)
use App\Models\MetrologiAlat;     // Untuk Alat Ukur
use App\Models\MetrologiReparasi; // Untuk Reparasi

class DashboardController extends Controller
{
    public function index()
    {
        // 1. HITUNG JUMLAH BARIS DATA (Menggunakan perintah count() bawaan Laravel)
        
        // Sekretariat (Misal dari tabel Surat)
        $sekretariat = Surat::count();

        // PUM (Total dari UMKM + SWK)
        $mikro = Umkm::count() + Swk::count();

        // Distribusi Perdagangan (Total dari Pasar + Toko Kelontong)
        $distribusi = Pasar::count() + Tokokelontong::count();

        // Koperasi
        $koperasi = Koperasi::count();

        // Pembinaan (Total dari TDG + Pengawasan + Alkohol)
        $pembinaan = Tdg::count() + Pengawasan::count() + Alkohol::count();

        // Metrologi (Tergantung logika Anda, apakah menghitung baris tabel (count) 
        // atau menjumlahkan kolom 'jumlah' (sum). Di sini saya asumsikan menghitung baris)
        $metrologi = MetrologiAlat::count() + MetrologiReparasi::count();


        // 2. MASUKKAN KE DALAM ARRAY UNTUK CHART
        // Urutannya harus sama dengan label di Javascript: 
        // ['Sekretariat', 'UMKM', 'Distribusi', 'Koperasi', 'Pembinaan', 'Metrologi']
        $chartData = [
            $sekretariat, 
            $mikro, 
            $distribusi, 
            $koperasi, 
            $pembinaan, 
            $metrologi
        ];


        // 3. LEMPAR DATA KE TAMPILAN BLADE
        return view('dashboard', compact(
            'sekretariat', 
            'mikro', 
            'distribusi', 
            'koperasi', 
            'pembinaan', 
            'metrologi',
            'chartData'
        ));
    }
}