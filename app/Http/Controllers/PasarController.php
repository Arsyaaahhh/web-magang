<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasar;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

class PasarController extends Controller
{
    // ================= ADMIN =================
    public function index(Request $request)
    {
        $query = Pasar::with('kelurahan.kecamatan');

        if($request->search){
            $query->where(function($q) use ($request){
                $q->where('nama_pasar','like','%'.$request->search.'%');
            });
        }

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

        return view('admin.admin_perdagangan.pasar.adminpasar', compact(
            'data',
            'kecamatan'
        ));
    }


    public function create(){
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();
        return view('admin.admin_perdagangan.pasar.pasarcreate', compact('kecamatan', 'kelurahan'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_pasar'  => 'required',
            'alamat'  => 'required',
            'kelurahan_id'  => 'required',
            'jumlah_pedagang'  => 'required',
            'jumlah_stan'  => 'required',
            'stan_belum_terisi'  => 'required',
        ]);

        Pasar::create([
            'nama_pasar' => $request->nama_pasar,
            'alamat' => $request->alamat,
            'kelurahan_id' => $request->kelurahan_id,
            'jumlah_pedagang' => $request->jumlah_pedagang,
            'jumlah_stan' => $request->jumlah_stan,
            'stan_belum_terisi' => $request->stan_belum_terisi,
        ]);

        return redirect('/admin/admin_perdagangan/pasar/adminpasar')->with('success','Upload berhasil');
    }


    public function edit($id){
        $data = Pasar::with(['kelurahan.kecamatan'])->findOrFail($id);
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();

        return view('admin.admin_perdagangan.pasar.pasaredit', compact('data', 'kecamatan', 'kelurahan'));
    }


    public function update(Request $request, $id)
    {
        $data = Pasar::findOrFail($id);

        $data->update([
            'nama_pasar' => $request->nama_pasar,
            'alamat' => $request->alamat,
            'kelurahan_id' => $request->kelurahan_id,
            'jumlah_pedagang' => $request->jumlah_pedagang,
            'jumlah_stan' => $request->jumlah_stan,
            'stan_belum_terisi' => $request->stan_belum_terisi,
        ]);

        return redirect('/admin/admin_perdagangan/pasar/adminpasar')->with('success','Update berhasil');
    }


    public function destroy($id)
    {
        $pasar = Pasar::findOrFail($id);
        $pasar->delete();

        return redirect('/admin/admin_perdagangan/pasar/adminpasar')->with('success','Data berhasil dihapus');
    }

    public function getKelurahan($ID_KECAMATAN)
    {
        $kelurahan = Kelurahan::where('ID_KECAMATAN', $ID_KECAMATAN)->get();
        return response()->json($kelurahan);
    }

    // ================= FRONTEND =================
    public function pasar(Request $request)
    {
        $query = Pasar::with('kelurahan.kecamatan');

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

        // DATA
        $data = $query->get();

        // ================= SUMMARY =================
        $summary = Pasar::selectRaw('
            COUNT(*) as total_pasar,
            SUM(jumlah_pedagang) as total_pedagang,
            SUM(jumlah_stan) as total_stan,
            SUM(stan_belum_terisi) as total_stan_kosong
        ')->first();

        // ================= AJAX =================
        if ($request->ajax()) {
            return response()->json([
                'data' => $data,
                'summary' => $summary
            ]);
        }

        return view('frontend.pasar', compact(
            'data',
            'summary'
        ));
    }
}