<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Swk;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

class SwkController extends Controller
{
    // ================= ADMIN =================
    public function index(Request $request)
    {
        $query = Swk::with('kelurahan.kecamatan');

        if($request->search){
            $query->where(function($q) use ($request){
                $q->where('nama_swk','like','%'.$request->search.'%');
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

        // Path view sudah disesuaikan ke dalam folder swk
        return view('admin.admin_pum.swk.adminswk', compact(
            'data',
            'kecamatan'
        ));
    }

    public function create()
    {
        $kecamatan = Kecamatan::all();
        $kelurahan = collect(); 
        
        // Path view sudah disesuaikan ke dalam folder swk
        return view('admin.admin_pum.swk.swkcreate', compact('kecamatan', 'kelurahan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_swk'          => 'required|string',
            'alamat'            => 'required|string',
            'kelurahan_id'      => 'required',
            'jumlah_pedagang'   => 'required|numeric',
            'jumlah_stan'       => 'required|numeric',
            'stan_belum_terisi' => 'required|numeric',
        ]);

        Swk::create([
            'nama_swk' => $request->nama_swk,
            'alamat' => $request->alamat,
            'kelurahan_id' => $request->kelurahan_id,
            'jumlah_pedagang' => $request->jumlah_pedagang,
            'jumlah_stan' => $request->jumlah_stan,
            'stan_belum_terisi' => $request->stan_belum_terisi,
        ]);

        return redirect('/admin/admin_pum/adminswk')->with('success','Data SWK berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Swk::with(['kelurahan.kecamatan'])->findOrFail($id);
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::where('ID_KECAMATAN', $data->kelurahan->ID_KECAMATAN ?? null)->get();

        // Path view sudah disesuaikan ke dalam folder swk
        return view('admin.admin_pum.swk.swkedit', compact('data', 'kecamatan', 'kelurahan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_swk'          => 'required|string',
            'alamat'            => 'required|string',
            'kelurahan_id'      => 'required',
            'jumlah_pedagang'   => 'required|numeric',
            'jumlah_stan'       => 'required|numeric',
            'stan_belum_terisi' => 'required|numeric',
        ]);

        $data = Swk::findOrFail($id);

        $data->update([
            'nama_swk' => $request->nama_swk,
            'alamat' => $request->alamat,
            'kelurahan_id' => $request->kelurahan_id,
            'jumlah_pedagang' => $request->jumlah_pedagang,
            'jumlah_stan' => $request->jumlah_stan,
            'stan_belum_terisi' => $request->stan_belum_terisi,
        ]);

        return redirect('/admin/admin_pum/adminswk')->with('success','Data SWK berhasil diperbarui');
    }

    public function destroy($id)
    {
        $swk = Swk::findOrFail($id);
        $swk->delete();

        return redirect('/admin/admin_pum/adminswk')->with('success','Data berhasil dihapus');
    }

    public function getKelurahan($ID_KECAMATAN)
    {
        $kelurahan = Kelurahan::where('ID_KECAMATAN', $ID_KECAMATAN)->get();
        return response()->json($kelurahan);
    }

    // ================= FRONTEND =================
    public function swk(Request $request)
    {
        $query = Swk::with('kelurahan.kecamatan');

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
        $data = $query->get();

        $summary = $summaryQuery->selectRaw('
            COUNT(*) as total_swk,
            SUM(jumlah_pedagang) as total_pedagang,
            SUM(jumlah_stan) as total_stan,
            SUM(stan_belum_terisi) as total_stan_kosong
        ')->first();

        if ($request->ajax()) {
            return response()->json([
                'data' => $data,
                'summary' => $summary
            ]);
        }

        return view('frontend.swk', compact(
            'data',
            'summary'
        ));
    }
}