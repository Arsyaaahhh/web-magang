<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KKMP;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

class KKMPController extends Controller
{
    public function index(Request $request)
    {
        $query = KKMP::with(['kecamatan', 'kelurahan']);

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('tahun', 'like', '%' . $request->search . '%')
                  ->orWhere('alamat', 'like', '%' . $request->search . '%')
                  ->orWhere('jenis_kkmp', 'like', '%' . $request->search . '%')
                  ->orWhere('jumlah_anggota', 'like', '%' . $request->search . '%')
                  ->orWhere('total_omzet', 'like', '%' . $request->search . '%')
                  ->orWhereHas('kelurahan', function ($q2) use ($request) {
                      $q2->where('NM_KELURAHAN', 'like', '%' . $request->search . '%');
                  })
                  ->orWhereHas('kecamatan', function ($q2) use ($request) {
                      $q2->where('NM_KECAMATAN', 'like', '%' . $request->search . '%');
                  });
            });
        }

        if ($request->jenis_kkmp) {
            $query->where('jenis_kkmp', $request->jenis_kkmp);
        }

        if ($request->ID_KECAMATAN) {
            $query->where('ID_KECAMATAN', $request->ID_KECAMATAN);
        }

        if ($request->ID_KELURAHAN) {
            $query->where('ID_KELURAHAN', $request->ID_KELURAHAN);
        }

        $dataKKMP = $query->latest()->paginate(20)->withQueryString();
        $kecamatan = Kecamatan::all();

        return view('admin.koperasi.kkmp.index', compact('dataKKMP', 'kecamatan'));
    }

    public function create()
    {
        $kecamatan = Kecamatan::all();
        return view('admin.koperasi.kkmp.create', compact('kecamatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_KECAMATAN' => 'required|exists:kecamatan,ID_KECAMATAN',
            'ID_KELURAHAN' => 'required|exists:kelurahan,ID_KELURAHAN',
            'nama_kkmp' => 'required|string|max:255',
            'no_badan_hukum' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:2999',
            'alamat' => 'required|string|max:255',
            'jenis_kkmp' => 'required|in:Gerai/Outlet Sembako (Kios Pangan),Apotek & Klinik Kelurahan,Unit Jasa Keuangan Mikro,Fasilitas Cold Storage & Logistik,Unit Pemasaran UMKM,Unit Jasa Pemenuhan Gizi (Pemasok SPPG)',
            'jumlah_anggota' => 'required|integer|min:0',
            'total_omzet' => 'required|numeric|min:0',
        ]);

        KKMP::create($request->only([
            'ID_KECAMATAN',
            'ID_KELURAHAN',
            'nama_kkmp',
            'no_badan_hukum',
            'tahun',
            'alamat',
            'jenis_kkmp',
            'jumlah_anggota',
            'total_omzet'
        ]));

        return redirect('/admin/koperasi/kkmp')->with('success', 'Data KKMP berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = KKMP::findOrFail($id);
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::where('ID_KECAMATAN', $data->ID_KECAMATAN)->get();

        return view('admin.koperasi.kkmp.edit', compact('data', 'kecamatan', 'kelurahan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ID_KECAMATAN' => 'required|exists:kecamatan,ID_KECAMATAN',
            'ID_KELURAHAN' => 'required|exists:kelurahan,ID_KELURAHAN',
            'nama_kkmp' => 'required|string|max:255',
            'no_badan_hukum' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:2999',
            'alamat' => 'required|string|max:255',
            'jenis_kkmp' => 'required|in:Gerai/Outlet Sembako (Kios Pangan),Apotek & Klinik Kelurahan,Unit Jasa Keuangan Mikro,Fasilitas Cold Storage & Logistik,Unit Pemasaran UMKM,Unit Jasa Pemenuhan Gizi (Pemasok SPPG)',
            'jumlah_anggota' => 'required|integer|min:0',
            'total_omzet' => 'required|numeric|min:0',
        ]);

        $kkmp = KKMP::findOrFail($id);
        $kkmp->update($request->only([
            'ID_KECAMATAN',
            'ID_KELURAHAN',
            'nama_kkmp',
            'no_badan_hukum',
            'tahun',
            'alamat',
            'jenis_kkmp',
            'jumlah_anggota',
            'total_omzet'
        ]));

        return redirect('/admin/koperasi/kkmp')->with('success', 'Data KKMP berhasil diupdate');
    }

    public function destroy($id)
    {
        $kkmp = KKMP::findOrFail($id);
        $kkmp->delete();

        return redirect('/admin/koperasi/kkmp')->with('success', 'Data KKMP berhasil dihapus');
    }

    public function getKelurahan($id)
    {
        $data = Kelurahan::where('ID_KECAMATAN', $id)->get();
        return response()->json($data);
    }
}
