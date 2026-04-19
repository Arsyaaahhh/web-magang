<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;

class SuratController extends Controller
{
    // ================= ADMIN =================
    public function index(){

        if(session('role') != 'admin'){
            return redirect('/');
        }

        $data = Surat::latest()->get();
        return view('admin.index', compact('data'));
    }

    public function create(){
        return view('admin.create');
    }

    public function store(Request $request){

        $request->validate([
            'nomor'  => 'required',
            'judul'  => 'required',
            'jenis'  => 'required',
            'tahun'  => 'required',
            'file'   => 'required|mimes:pdf',
            'bidang' => 'required'
        ]);

        $fileName = time().'.'.$request->file->extension();
        $request->file->move(public_path('pdf'), $fileName);

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

    public function update(Request $request, $id){

        $data = Surat::findOrFail($id);

        if($request->file){
            $fileName = time().'.'.$request->file->extension();
            $request->file->move(public_path('pdf'), $fileName);
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

    public function destroy($id){
        Surat::findOrFail($id)->delete();
        return back()->with('success','Data dihapus');
    }


    // ================= FRONTEND =================
    public function sekretariat(Request $request)
    {
        $query = Surat::where('bidang','sekretariat');

        // FILTER JENIS
        if ($request->jenis) {
            $query->where('jenis', strtolower($request->jenis));
        }

        // SEARCH
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nomor','like','%'.$request->search.'%')
                  ->orWhere('judul','like','%'.$request->search.'%');
            });
        }

        // FILTER TAHUN
        if ($request->tahun && $request->tahun != 'all') {
            $query->where('tahun', $request->tahun);
        }

        $data = $query->latest()->get();

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


        // ================= 🔥 COUNT =================
        $jumlahSK = Surat::where('bidang','sekretariat')
            ->where('jenis','sk')
            ->count();

        $jumlahSP = Surat::where('bidang','sekretariat')
            ->where('jenis','sp')
            ->count();

        $jumlahSOP = Surat::where('bidang','sekretariat')
            ->where('jenis','sop')
            ->count();


        // ================= AJAX =================
        if ($request->header('X-Requested-With') === 'XMLHttpRequest') {
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

        // ================= VIEW =================
        return view('bidang.sekretariat', compact(
            'data',
            'tahunList',
            'jumlahSK',
            'jumlahSP',
            'jumlahSOP'
        ));
    }
}