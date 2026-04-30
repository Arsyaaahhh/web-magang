<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Magang;
use App\Models\Pegawai;

class SuratController extends Controller
{
    // ================= ADMIN =================
    public function index(Request $request)
    {
        if(session('role') != 'admin'){
            return redirect('/');
        }

        $query = Surat::where('bidang','sekretariat');

        if($request->search){
            $query->where(function($q) use ($request){
                $q->where('nomor','like','%'.$request->search.'%')
                  ->orWhere('judul','like','%'.$request->search.'%');
            });
        }

        if($request->jenis){
            $query->where('jenis', strtoupper($request->jenis));
        }

        if($request->tahun){
            $query->where('tahun', $request->tahun);
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        return view('admin.admin_sekre.index', compact('data'));
    }

    public function indexPup(Request $request)
    {
        if(session('role') != 'admin'){
            return redirect('/');
        }

        $query = Surat::where('bidang','sekretariat');

        if($request->search){
            $query->where(function($q) use ($request){
                $q->where('nomor','like','%'.$request->search.'%')
                  ->orWhere('judul','like','%'.$request->search.'%');
            });
        }

        if($request->jenis){
            $query->where('jenis', strtoupper($request->jenis));
        }

        if($request->tahun){
            $query->where('tahun', $request->tahun);
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        return view('admin.admin_pup.admin_sekre.index', compact('data'));
    }


    public function list(Request $request)
    {
        $query = Surat::where('bidang','sekretariat');

        if($request->search){
            $query->where(function($q) use ($request){
                $q->where('nomor','like','%'.$request->search.'%')
                  ->orWhere('judul','like','%'.$request->search.'%');
            });
        }

        if($request->jenis){
            $query->where('jenis', strtoupper($request->jenis));
        }

        if($request->tahun){
            $query->where('tahun', $request->tahun);
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        return view('admin.admin_sekre.surat.index', compact('data'));
    }


    public function create(){
        return view('admin.admin_sekre.surat.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nomor'  => 'required',
            'judul'  => 'required',
            'jenis'  => 'required',
            'tahun'  => 'required',
            'file'   => 'required|mimes:pdf',
        ]);

        $fileName = time().'.'.$request->file('file')->extension();
        $request->file('file')->move(public_path('pdf'), $fileName);

        Surat::create([
            'nomor'  => $request->nomor,
            'judul'  => $request->judul,
            'jenis'  => strtoupper($request->jenis),
            'tahun'  => $request->tahun,
            'file'   => $fileName,
            'bidang' => 'sekretariat'
        ]);

        return redirect()->route('surat.index')->with('success','Upload berhasil');
    }


    public function edit($id){
        $data = Surat::findOrFail($id);
        return view('admin.admin_sekre.surat.edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        $data = Surat::findOrFail($id);

        if($request->file){
            $fileName = time().'.'.$request->file('file')->extension();
            $request->file('file')->move(public_path('pdf'), $fileName);
            $data->file = $fileName;
        }

        $data->update([
            'nomor'  => $request->nomor,
            'judul'  => $request->judul,
            'jenis'  => strtoupper($request->jenis),
            'tahun'  => $request->tahun,
        ]);

        return redirect()->route('surat.index')->with('success','Update berhasil');
    }


    public function destroy($id)
    {
        Surat::findOrFail($id)->delete();
        return back()->with('success','Data dihapus');
    }


    // ================= FRONTEND =================
    public function sekretariat(Request $request)
    {
        // ===== SURAT =====
        $query = Surat::where('bidang','sekretariat');

        if ($request->jenis) {
            $query->where('jenis', strtoupper($request->jenis));
        }

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nomor','like','%'.$request->search.'%')
                  ->orWhere('judul','like','%'.$request->search.'%');
            });
        }

        if ($request->tahun && $request->tahun != 'all') {
            $query->where('tahun', $request->tahun);
        }

        $data = $query->select('id','nomor','judul','tahun','file')
                      ->latest()
                      ->get();

        // ===== MAGANG =====
        $magang = Magang::latest()->get();

        // ===== PEGAWAI =====
        $pegawai = Pegawai::latest()->get();

        // ===== TAHUN =====
        $tahunList = Surat::where('bidang','sekretariat')
            ->select('tahun')
            ->distinct()
            ->orderBy('tahun','desc')
            ->pluck('tahun');

        // ===== COUNT =====
        $jumlahSK = Surat::where('bidang','sekretariat')->where('jenis','SK')->count();
        $jumlahSP = Surat::where('bidang','sekretariat')->where('jenis','SP')->count();
        $jumlahSOP = Surat::where('bidang','sekretariat')->where('jenis','SOP')->count();

        // ===== AJAX (HANYA UNTUK JS) =====
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

        // ===== VIEW =====
        return view('bidang.sekretariat', [
            'data' => $data,
            'tahunList' => $tahunList,
            'jumlahSK' => $jumlahSK,
            'jumlahSP' => $jumlahSP,
            'jumlahSOP' => $jumlahSOP,
            'magang' => $magang,
            'pegawai' => $pegawai
        ]);
    }
}