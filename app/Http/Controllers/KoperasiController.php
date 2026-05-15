<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Koperasi;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\KKMP;

class KoperasiController extends Controller
{
    // ================= ADMIN =================
    public function index(Request $request)
    {
        $query = Koperasi::with(['kecamatan', 'kelurahan']);

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('jumlah', 'like', '%' . $request->search . '%')
                  ->orWhere('aktif', 'like', '%' . $request->search . '%')
                  ->orWhere('tidak_aktif', 'like', '%' . $request->search . '%')
                  ->orWhere('bermitra', 'like', '%' . $request->search . '%')
                  ->orWhere('mitra_perbankan', 'like', '%' . $request->search . '%')
                  ->orWhere('padat_karya', 'like', '%' . $request->search . '%')
                  ->orWhere('lpj_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('pelaksanaan_rat', 'like', '%' . $request->search . '%')
                  ->orWhereHas('kelurahan', function ($q2) use ($request) {
                      $q2->where('NM_KELURAHAN', 'like', '%' . $request->search . '%');
                  })
                  ->orWhereHas('kecamatan', function ($q2) use ($request) {
                      $q2->where('NM_KECAMATAN', 'like', '%' . $request->search . '%');
                  });
            });
        }

        if ($request->kecamatan_id) {
            $query->where('ID_KECAMATAN', $request->kecamatan_id);
        }

        if ($request->kelurahan_id) {
            $query->where('ID_KELURAHAN', $request->kelurahan_id);
        }

        if ($request->tahun) {
            $query->where('tahun', $request->tahun);
        }

        $dataKoperasi = $query->latest()
            ->paginate(20, ['*'], 'page_koperasi')
            ->withQueryString();

        $kecamatan = Kecamatan::all();
        $kelurahan = [];
        if ($request->kecamatan_id) {
            $kelurahan = Kelurahan::where('ID_KECAMATAN', $request->kecamatan_id)->get();
        }

        $tahunOptions = Koperasi::select('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('admin.koperasi.adminkoperasi', compact(
            'dataKoperasi',
            'kecamatan',
            'kelurahan',
            'tahunOptions'
        ));
    }

    public function create()
    {
        $kecamatan = Kecamatan::all();
        return view('admin.koperasi.create', compact('kecamatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'nullable|integer|min:0',
            'aktif' => 'nullable|integer|min:0',
            'tidak_aktif' => 'nullable|integer|min:0',
            'bermitra' => 'nullable|integer|min:0',
            'mitra_perbankan' => 'nullable|integer|min:0',
            'padat_karya' => 'nullable|integer|min:0',
            'lpj_lengkap' => 'nullable|integer|min:0',
            'pelaksanaan_rat' => 'nullable|integer|min:0',
            'tahun' => 'required|integer|min:1900|max:2999',
            'ID_KECAMATAN' => 'required|exists:kecamatan,ID_KECAMATAN',
            'ID_KELURAHAN' => 'required|exists:kelurahan,ID_KELURAHAN',
        ]);

        Koperasi::create($request->all());

        return redirect('/admin/koperasi/')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Koperasi::findOrFail($id);
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::where('ID_KECAMATAN', $data->ID_KECAMATAN)->get();

        return view('admin.koperasi.edit', compact('data', 'kecamatan', 'kelurahan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'nullable|integer|min:0',
            'aktif' => 'nullable|integer|min:0',
            'tidak_aktif' => 'nullable|integer|min:0',
            'bermitra' => 'nullable|integer|min:0',
            'mitra_perbankan' => 'nullable|integer|min:0',
            'padat_karya' => 'nullable|integer|min:0',
            'lpj_lengkap' => 'nullable|integer|min:0',
            'pelaksanaan_rat' => 'nullable|integer|min:0',
            'tahun' => 'required|integer|min:1900|max:2999',
            'ID_KECAMATAN' => 'required|exists:kecamatan,ID_KECAMATAN',
            'ID_KELURAHAN' => 'required|exists:kelurahan,ID_KELURAHAN',
        ]);

        $koperasi = Koperasi::findOrFail($id);
        $koperasi->update($request->all());

        return redirect('/admin/koperasi/')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Koperasi::findOrFail($id)->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }

    public function getKelurahan($ID_KECAMATAN)
    {
        $kelurahan = Kelurahan::where('ID_KECAMATAN', $ID_KECAMATAN)->get();
        return response()->json($kelurahan);
    }

    public function getTotalKoperasi()
    {
        $total = Koperasi::sum('jumlah');
        return response()->json(['total' => $total]);
    }

    // ================= USER PAGE (FIXED) =================
    public function userPage(Request $request)
    {
    // 1. Data untuk Dropdown
    $kecamatan = Kecamatan::all();
    $kelurahan = $request->kecamatan_id ? Kelurahan::where('ID_KECAMATAN', $request->kecamatan_id)->get() : [];
    $tahunOptions = Koperasi::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

    // 2. Query Dasar (Base Query) - Tempelkan Filter di sini
    $baseKoperasi = Koperasi::with(['kecamatan', 'kelurahan']);
    
    if ($request->kecamatan_id) { $baseKoperasi->where('ID_KECAMATAN', $request->kecamatan_id); }
    if ($request->kelurahan_id) { $baseKoperasi->where('ID_KELURAHAN', $request->kelurahan_id); }
    if ($request->tahun)        { $baseKoperasi->where('tahun', $request->tahun); }

    // 3. Hitung Statistik (Otomatis Terfilter)
    $totalJumlah         = (clone $baseKoperasi)->sum('jumlah');
    $jumlahAktif         = (clone $baseKoperasi)->sum('aktif');
    $jumlahTidakAktif    = (clone $baseKoperasi)->sum('tidak_aktif');
    $jumlahPadatKarya    = (clone $baseKoperasi)->sum('padat_karya');
    $totalPelaksanaanRat = (clone $baseKoperasi)->sum('pelaksanaan_rat');

    // 4. Data Tabel (Otomatis Terfilter & Menjaga URL Pagination)
    $allKoperasi = (clone $baseKoperasi)->paginate(20, ['*'], 'total_p')->withQueryString();
    $koperasiAktif = (clone $baseKoperasi)->where('aktif', '>', 0)->paginate(20, ['*'], 'aktif_p')->withQueryString();
    $koperasiTidakAktif = (clone $baseKoperasi)->where('tidak_aktif', '>', 0)->paginate(20, ['*'], 'tidak_aktif_p')->withQueryString();
    $padatKaryaDetail = (clone $baseKoperasi)->where('padat_karya', '>', 0)->paginate(20, ['*'], 'padat_karya_p')->withQueryString();
    $pelaksanaanRatDetail = (clone $baseKoperasi)->where('pelaksanaan_rat', '>', 0)->paginate(20, ['*'], 'pelaksanaan_rat_p')->withQueryString();

    // 5. Data KKMP
    $baseKKMP = KKMP::with(['kecamatan', 'kelurahan']);
    if ($request->kecamatan_id) { $baseKKMP->where('ID_KECAMATAN', $request->kecamatan_id); }
    if ($request->kelurahan_id) { $baseKKMP->where('ID_KELURAHAN', $request->kelurahan_id); }
    if ($request->tahun)        { $baseKKMP->where('tahun', $request->tahun); }
    
    $totalKKMP = (clone $baseKKMP)->count();
    $allKKMP = $baseKKMP->paginate(20, ['*'], 'kkmp_p')->withQueryString();

    return view('bidang.koperasi', compact(
        'totalJumlah', 'jumlahAktif', 'jumlahTidakAktif', 'jumlahPadatKarya', 'totalPelaksanaanRat',
        'allKoperasi', 'koperasiAktif', 'koperasiTidakAktif', 'padatKaryaDetail', 
        'pelaksanaanRatDetail', 'totalKKMP', 'allKKMP',
        'kecamatan', 'kelurahan', 'tahunOptions'
    ));
    }
}