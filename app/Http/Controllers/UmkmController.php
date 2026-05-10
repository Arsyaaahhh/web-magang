<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umkm;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

class UmkmController extends Controller
{
    // ================= ADMIN =================
    public function index(Request $request)
    {
        $query = Umkm::with('kelurahan.kecamatan');

        // FILTER KECAMATAN
        if ($request->kecamatan_id) {
            $query->whereHas('kelurahan', function($q) use ($request) {
                $q->where('ID_KECAMATAN', $request->kecamatan_id);
            });
        }

        // FILTER KELURAHAN
        if ($request->kelurahan_id) {
            $query->where('kelurahan_id', $request->kelurahan_id);
        }

        $data = $query->latest()->paginate(10)->withQueryString();
        $kecamatan = Kecamatan::all();

        // Path view sudah disesuaikan ke dalam folder umkm
        return view('admin.admin_pum.umkm.adminumkm', compact(
            'data',
            'kecamatan'
        ));
    }

    public function create()
    {
        $kecamatan = Kecamatan::all();
        $kelurahan = collect(); 
        
        // Path view sudah disesuaikan ke dalam folder umkm
        return view('admin.admin_pum.umkm.umkmcreate', compact('kecamatan', 'kelurahan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelurahan_id'      => 'required',
            'total_umkm'        => 'required|numeric',
            'umkm_binaan'       => 'required|numeric',
            'sertifikasi_halal' => 'required|numeric',
            'sertifikasi_merek' => 'required|numeric',
            'nib'               => 'required|numeric',
            'peken'             => 'required|numeric',
            'padat_karya'       => 'required|numeric',
        ]);

        Umkm::create($request->all());

        return redirect('/admin/admin_pum/adminumkm')->with('success','Data UMKM berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Umkm::with(['kelurahan.kecamatan'])->findOrFail($id);
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::where('ID_KECAMATAN', $data->kelurahan->ID_KECAMATAN ?? null)->get();

        // Path view sudah disesuaikan ke dalam folder umkm
        return view('admin.admin_pum.umkm.umkmedit', compact('data', 'kecamatan', 'kelurahan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kelurahan_id'      => 'required',
            'total_umkm'        => 'required|numeric',
            'umkm_binaan'       => 'required|numeric',
            'sertifikasi_halal' => 'required|numeric',
            'sertifikasi_merek' => 'required|numeric',
            'nib'               => 'required|numeric',
            'peken'             => 'required|numeric',
            'padat_karya'       => 'required|numeric',
        ]);

        $data = Umkm::findOrFail($id);
        $data->update($request->all());

        return redirect('/admin/admin_pum/adminumkm')->with('success','Data UMKM berhasil diperbarui');
    }

    public function destroy($id)
    {
        $umkm = Umkm::findOrFail($id);
        $umkm->delete();

        return redirect('/admin/admin_pum/adminumkm')->with('success','Data berhasil dihapus');
    }

    public function getKelurahan($ID_KECAMATAN)
    {
        $kelurahan = Kelurahan::where('ID_KECAMATAN', $ID_KECAMATAN)->get();
        return response()->json($kelurahan);
    }

    // ================= FRONTEND =================
    public function umkm(Request $request)
    {
        $query = Umkm::with('kelurahan.kecamatan');

        // FILTER KECAMATAN
        if ($request->kecamatan_id) {
            $query->whereHas('kelurahan', function($q) use ($request) {
                $q->where('ID_KECAMATAN', $request->kecamatan_id);
            });
        }

        // FILTER KELURAHAN
        if ($request->kelurahan_id) {
            $query->where('kelurahan_id', $request->kelurahan_id);
        }

        // FILTER KATEGORI
        if($request->search){
            $query->where(function($q) use ($request){
                $q->where('kategori','like','%'.$request->search.'%');
            });
        }

        $summaryQuery = clone $query;

        // ambil data Umkm
        $data = $query->latest()->paginate(10)->withQueryString();

        $summary = $summaryQuery->selectRaw('
            SUM(total_umkm) as total_umkm,
            SUM(umkm_binaan) as umkm_binaan,
            SUM(sertifikasi_halal) as sertifikasi_halal,
            SUM(sertifikasi_merek) as sertifikasi_merek,
            SUM(nib) as nib,
            SUM(pirt) as pirt,
            SUM(peken) as peken,
            SUM(padat_karya) as padat_karya
        ')->first();

        if ($request->ajax()) {
            return response()->json([
                'data' => $data,
                'summary' => $summary
            ]);
        }

        $kecamatan = Kecamatan::all();

        // kirim ke blade
        return view('bidang.pum.umkm', [
            'data' => $data,
            'kecamatan' => $kecamatan,
            'summary' => $summary
        ]);
    }
}