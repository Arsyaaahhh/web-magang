<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lppd;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

class LppdController extends Controller
{
    // ================= ADMIN =================
    public function index(Request $request)
    {
        $query = Lppd::with('kelurahan.kecamatan');

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

        return view('admin.admin_pum.lppd.adminlppd', compact(
            'data',
            'kecamatan'
        ));
    }


    public function create(){
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();
        return view('admin.admin_pum.lppd.lppdcreate', compact('kecamatan', 'kelurahan'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'kelurahan_id'  => 'required',
            'tahun'  => 'required',
            'jumlah'  => 'required',
        ]);

        Lppd::create([
            'kelurahan_id' => $request->kelurahan_id,
            'tahun' => $request->tahun,
            'jumlah' => $request->jumlah,
        ]);

        return redirect('/admin/admin_pum/adminlppd')->with('success','Upload berhasil');
    }


    public function edit($id){
        $data = Lppd::with(['kelurahan.kecamatan'])->findOrFail($id);
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();

        return view('admin.admin_pum.lppd.lppdedit', compact('data', 'kecamatan', 'kelurahan'));
    }


    public function update(Request $request, $id)
    {
        $data = Lppd::findOrFail($id);

        $data->update([
            'kelurahan_id' => $request->kelurahan_id,
            'tahun' => $request->tahun,
            'jumlah' => $request->jumlah,
        ]);

        return redirect('/admin/admin_pum/adminlppd')->with('success','Update berhasil');
    }


    public function destroy($id)
    {
        $lppd = Lppd::findOrFail($id);
        $lppd->delete();

        return redirect('/admin/admin_pum/adminlppd')->with('success','Data berhasil dihapus');
    }

    public function getKelurahan($ID_KECAMATAN)
    {
        $kelurahan = Kelurahan::where('ID_KECAMATAN', $ID_KECAMATAN)->get();
        return response()->json($kelurahan);
    }

    // ================= FRONTEND =================
    public function lppd(Request $request)
    {
        $query = Lppd::with('kelurahan.kecamatan');

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

        // FILTER TAHUN
        if($request->search){
            $query->where(function($q) use ($request){
                $q->where('tahun','like','%'.$request->search.'%');
            });
        }

        $summaryQuery = clone $query;

        // ambil data Lppd
        $data = $query->latest()->paginate(10)->withQueryString();

        // summary
        $summary = $summaryQuery->selectRaw('
            SUM(jumlah) as jumlah
        ')->first();

        // AJAX
        if ($request->ajax()) {
            return response()->json([
                'data' => $data,
                'summary' => $summary
            ]);
        }

        $kecamatan = Kecamatan::all();

        // kirim ke blade
        return view('bidang.pum.lppd', [
            'data' => $data,
            'kecamatan' => $kecamatan,
            'summary' => $summary
        ]);
    }
}