<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;

class SuratController extends Controller
{
    // ================= ADMIN =================
    public function index(Request $request)
    {
        // 🔐 CEK ROLE
        if(session('role') != 'admin'){
            return redirect('/');
        }

        $query = Surat::query();

        // 🔍 SEARCH
        if($request->search){
            $query->where(function($q) use ($request){
                $q->where('nomor','like','%'.$request->search.'%')
                  ->orWhere('judul','like','%'.$request->search.'%');
            });
        }

        // 🔍 JENIS (dibuat lowercase biar konsisten)
        if($request->jenis){
            $query->where('jenis', strtolower($request->jenis));
        }

        // 🔍 TAHUN
        if($request->tahun){
            $query->where('tahun', $request->tahun);
        }

        // 🔍 BIDANG
        if($request->bidang){
            $query->where('bidang', strtolower($request->bidang));
        }

        // 🔥 PAGINATION + BAWA QUERY
        $data = $query->latest()->paginate(10)->withQueryString();

        return view('admin.index', compact('data'));
    }


    public function create(){
        return view('admin.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nomor'  => 'required',
            'judul'  => 'required',
            'jenis'  => 'required',
            'tahun'  => 'required',
            'file'   => 'required|mimes:pdf',
            'bidang' => 'required'
        ]);

        // 🔥 UPLOAD FILE
        $fileName = time().'.'.$request->file('file')->extension();
        $request->file('file')->move(public_path('pdf'), $fileName);

        Surat::create([
            'nomor'  => $request->nomor,
            'judul'  => $request->judul,
            'jenis'  => strtolower($request->jenis),
            'tahun'  => $request->tahun,
            'file'   => $fileName,
            'bidang' => strtolower($request->bidang)
        ]);

        return redirect('/admin')->with('success','Upload berhasil');
    }


    public function edit($id){
        $data = Surat::findOrFail($id);
        return view('admin.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        $data = Surat::findOrFail($id);

        // 🔥 UPDATE FILE (optional)
        if($request->file){
            $fileName = time().'.'.$request->file('file')->extension();
            $request->file('file')->move(public_path('pdf'), $fileName);
            $data->file = $fileName;
        }

        $data->update([
            'nomor'  => $request->nomor,
            'judul'  => $request->judul,
            'jenis'  => strtolower($request->jenis),
            'tahun'  => $request->tahun,
            'bidang' => strtolower($request->bidang)
        ]);

        return redirect('/admin')->with('success','Update berhasil');
    }


    public function destroy($id)
    {
        Surat::findOrFail($id)->delete();
        return back()->with('success','Data dihapus');
    }



    // ================= FRONTEND =================
    public function sekretariat(Request $request)
    {
        $query = Surat::where('bidang','sekretariat');

        // 🔍 FILTER JENIS
        if ($request->jenis) {
            $query->where('jenis', strtolower($request->jenis));
        }

        // 🔍 SEARCH
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nomor','like','%'.$request->search.'%')
                  ->orWhere('judul','like','%'.$request->search.'%');
            });
        }

        // 🔍 FILTER TAHUN
        if ($request->tahun && $request->tahun != 'all') {
            $query->where('tahun', $request->tahun);
        }

        // 🔥 SELECT (biar ringan)
        $data = $query->select('id','nomor','judul','tahun','file')
                      ->latest()
                      ->get();

        // ================= TAHUN =================
        $tahunQuery = Surat::where('bidang','sekretariat');

        if ($request->jenis) {
            $tahunQuery->where('jenis', strtolower($request->jenis));
        }

        $tahunList = $tahunQuery
            ->select('tahun')
            ->distinct()
            ->orderBy('tahun','desc')
            ->pluck('tahun');

        // ================= COUNT =================
        $jumlahSK = Surat::where('bidang','sekretariat')->where('jenis','sk')->count();
        $jumlahSP = Surat::where('bidang','sekretariat')->where('jenis','sp')->count();
        $jumlahSOP = Surat::where('bidang','sekretariat')->where('jenis','sop')->count();

        // ================= AJAX =================
        if ($request->ajax()) {
            return response()->json([
                'data' => $data,
                'tahunList' => $tahunList,
                'jumlah' => [
                    'sk' => $jumlahSK,
                    'sp' => $jumlahSP,
                    'sop' => $jumlahSOP
                ]
            ]);
        }

        return view('bidang.sekretariat', compact(
            'data',
            'tahunList',
            'jumlahSK',
            'jumlahSP',
            'jumlahSOP'
        ));
    }
}