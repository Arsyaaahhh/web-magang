<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tokokelontong;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

class TokokelontongController extends Controller
{
    // ================= ADMIN =================
    public function index(Request $request)
    {
        $query = Tokokelontong::with('kelurahan.kecamatan');

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

        return view('admin.admin_perdagangan.toko_kelontong.admintokokelontong', compact(
            'data',
            'kecamatan'
        ));
    }


    public function create(){
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();
        return view('admin.admin_perdagangan.toko_kelontong.tokokelontongcreate', compact('kecamatan', 'kelurahan'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'kelurahan_id'  => 'required',
            'total_toko'  => 'required',
            'peken'  => 'required',
        ]);

        Tokokelontong::create([
            'kelurahan_id' => $request->kelurahan_id,
            'total_toko' => $request->total_toko,
            'peken' => $request->peken,
        ]);

        return redirect('/admin/admin_perdagangan/tokokelontong/admintokokelontong')->with('success','Upload berhasil');
    }


    public function edit($id){
        $data = Tokokelontong::with(['kelurahan.kecamatan'])->findOrFail($id);
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();

        return view('admin.admin_perdagangan.toko_kelontong.tokokelontongedit', compact('data', 'kecamatan', 'kelurahan'));
    }


    public function update(Request $request, $id)
    {
        $data = Tokokelontong::findOrFail($id);

        $data->update([
            'kelurahan_id' => $request->kelurahan_id,
            'total_toko' => $request->total_toko,
            'peken' => $request->peken,
        ]);

        return redirect('/admin/admin_perdagangan/tokokelontong/admintokokelontong')->with('success','Update berhasil');
    }


    public function destroy($id)
    {
        $tokokelontong = Tokokelontong::findOrFail($id);
        $tokokelontong->delete();

        return redirect('/admin/admin_perdagangan/tokokelontong/admintokokelontong')->with('success','Data berhasil dihapus');
    }

    public function getKelurahan($ID_KECAMATAN)
    {
        $kelurahan = Kelurahan::where('ID_KECAMATAN', $ID_KECAMATAN)->get();
        return response()->json($kelurahan);
    }

    // ================= FRONTEND =================
    public function tokokelontong(Request $request)
    {
        $query = Tokokelontong::with('kelurahan.kecamatan');

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

        $summaryQuery = clone $query;

        // ambil data Tokokelontong
        $data = $query->latest()->paginate(10)->withQueryString();

        // summary
        $summary = $summaryQuery->selectRaw('
            SUM(total_toko) as total_toko,
            SUM(peken) as total_peken
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
        return view('bidang.perdagangan.tokokelontong', [
            'data' => $data,
            'kecamatan' => $kecamatan,
            'summary' => $summary
        ]);
    }
}