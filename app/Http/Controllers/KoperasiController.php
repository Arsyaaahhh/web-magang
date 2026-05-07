<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Koperasi;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Pegawai;

class KoperasiController extends Controller
{
    // ================= ADMIN =================
    public function index(Request $request)
    {
        $query = Koperasi::with(['kecamatan', 'kelurahan']);

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('jumlah', 'like', '%' . $request->search . '%')
                  ->orWhere('status', 'like', '%' . $request->search . '%')
                  ->orWhere('status_mitra', 'like', '%' . $request->search . '%')
                  ->orWhere('jenis_mitra', 'like', '%' . $request->search . '%')
                  ->orWhere('status_rat', 'like', '%' . $request->search . '%')
                  ->orWhere('status_lpj', 'like', '%' . $request->search . '%')
                  ->orWhere('total_pengawasan', 'like', '%' . $request->search . '%')
                  ->orWhereHas('kelurahan', function ($q2) use ($request) {
                      $q2->where('NM_KELURAHAN', 'like', '%' . $request->search . '%');
                  })
                  ->orWhereHas('kecamatan', function ($q2) use ($request) {
                      $q2->where('NM_KECAMATAN', 'like', '%' . $request->search . '%');
                  });
            });
        }

        if ($request->status) {
            $query->where('status', strtolower($request->status));
        }

        if ($request->status_mitra) {
            $query->where('status_mitra', strtolower($request->status_mitra));
        }

        if ($request->jenis_mitra) {
            $query->where('jenis_mitra', $request->jenis_mitra);
        }

        if ($request->status_rat) {
            $query->where('status_rat', $request->status_rat);
        }

        if ($request->status_lpj) {
            $query->where('status_lpj', $request->status_lpj);
        }

        if ($request->ID_KECAMATAN) {
            $query->where('ID_KECAMATAN', $request->ID_KECAMATAN);
        }

        if ($request->ID_KELURAHAN) {
            $query->where('ID_KELURAHAN', $request->ID_KELURAHAN);
        }

        $dataKoperasi = $query->latest()->paginate(10, ['*'], 'page_koperasi')->withQueryString();
        
        // Get pegawai data
        $queryPegawai = Pegawai::query();
        
        if ($request->search_pegawai) {
            $queryPegawai->where(function ($q) use ($request) {
                $q->where('jumlah_pegawai', 'like', '%' . $request->search_pegawai . '%')
                  ->orWhere('status', 'like', '%' . $request->search_pegawai . '%')
                  ->orWhere('program', 'like', '%' . $request->search_pegawai . '%');
            });
        }

        if ($request->status_pegawai) {
            $queryPegawai->where('status', $request->status_pegawai);
        }

        if ($request->program_pegawai) {
            $queryPegawai->where('program', $request->program_pegawai);
        }

        $dataPegawai = $queryPegawai->latest()->paginate(10, ['*'], 'page_pegawai')->withQueryString();

        return view('admin.koperasi.adminkoperasi', compact('dataKoperasi', 'dataPegawai'));
    }

    public function create()
    {
        $kecamatan = Kecamatan::all();
        return view('admin.koperasi.create', compact('kecamatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:0',
            'tahun' => 'required|integer|min:1900|max:2999',
            'status' => 'required|in:aktif,tidak aktif',
            'status_mitra' => 'required|in:bermitra,belum',
            'jenis_mitra' => 'required|in:perbankan,non',
            'ID_KECAMATAN' => 'required|exists:kecamatan,ID_KECAMATAN',
            'ID_KELURAHAN' => 'required|exists:kelurahan,ID_KELURAHAN',
            'status_rat' => 'required|in:YA,TIDAK',
            'status_lpj' => 'required|in:LENGKAP,TIDAK LENGKAP',
            'total_pengawasan' => 'required|integer|min:0',
        ]);

        Koperasi::create($request->only([
            'jumlah',
            'tahun',
            'status',
            'status_mitra',
            'jenis_mitra',
            'ID_KECAMATAN',
            'ID_KELURAHAN',
            'status_rat',
            'status_lpj',
            'total_pengawasan'
        ]));

        return redirect('/admin/koperasi')->with('success', 'Data berhasil ditambahkan');
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
            'jumlah' => 'required|integer|min:0',
            'tahun' => 'required|integer|min:1900|max:2999',
            'status' => 'required|in:aktif,tidak aktif',
            'status_mitra' => 'required|in:bermitra,belum',
            'jenis_mitra' => 'required|in:perbankan,non',
            'ID_KECAMATAN' => 'required|exists:kecamatan,ID_KECAMATAN',
            'ID_KELURAHAN' => 'required|exists:kelurahan,ID_KELURAHAN',
            'status_rat' => 'required|in:YA,TIDAK',
            'status_lpj' => 'required|in:LENGKAP,TIDAK LENGKAP',
            'total_pengawasan' => 'required|integer|min:0',
        ]);

        $koperasi = Koperasi::findOrFail($id);
        $koperasi->update($request->only([
            'jumlah',
            'tahun',
            'status',
            'status_mitra',
            'jenis_mitra',
            'ID_KECAMATAN',
            'ID_KELURAHAN',
            'status_rat',
            'status_lpj',
            'total_pengawasan'
        ]));

        return redirect('/admin/koperasi')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Koperasi::findOrFail($id)->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }

    public function getKelurahan($id)
    {
        $data = Kelurahan::where('ID_KECAMATAN', $id)->get();
        return response()->json($data);
    }

    public function getTotalKoperasi()
    {
        $total = Koperasi::sum('jumlah');
        return response()->json(['total' => $total]);
    }

    public function userPage()
    {
        $totalJumlah = Koperasi::sum('jumlah');
        $jumlahAktif = Koperasi::where('status','aktif')->sum('jumlah');
        $jumlahTidakAktif = Koperasi::where('status','tidak aktif')->sum('jumlah');

        // Data Pegawai
        $totalPegawai = \App\Models\Pegawai::sum('jumlah_pegawai');
        $pegawaiPNS = \App\Models\Pegawai::where('status','pns')->sum('jumlah_pegawai');
        $pegawaiNonPNS = \App\Models\Pegawai::where('status','non_pns')->sum('jumlah_pegawai');

        // Detail Data Koperasi
        $allKoperasi = Koperasi::with(['kecamatan', 'kelurahan'])->paginate(20, ['*'], 'all_p');
        $koperasiAktif = Koperasi::with(['kecamatan', 'kelurahan'])->where('status', 'aktif')->paginate(20, ['*'], 'aktif_p');
        $koperasiTidakAktif = Koperasi::with(['kecamatan', 'kelurahan'])->where('status', 'tidak aktif')->paginate(20, ['*'], 'nonaktif_p');

        // Detail Data Pegawai
        $allPegawai = \App\Models\Pegawai::paginate(20, ['*'], 'pegawai_p');
        $pegawaiPNSDetail = \App\Models\Pegawai::where('status','pns')->paginate(20, ['*'], 'pns_p');
        $pegawaiNonPNSDetail = \App\Models\Pegawai::where('status','non_pns')->get();

        return view('bidang.koperasi', compact(
            'totalJumlah', 'jumlahAktif', 'jumlahTidakAktif', 
            'totalPegawai', 'pegawaiPNS', 'pegawaiNonPNS',
            'allKoperasi', 'koperasiAktif', 'koperasiTidakAktif',
            'allPegawai', 'pegawaiPNSDetail', 'pegawaiNonPNSDetail'
        ));
    }
}
