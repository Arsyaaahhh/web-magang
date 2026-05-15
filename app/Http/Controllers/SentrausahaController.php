<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Sentrausaha;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

class SentrausahaController extends Controller
{
    // ================= ADMIN =================
    public function index(Request $request)
    {
        $query = Sentrausaha::with('kelurahan.kecamatan');

        if($request->search){
            $query->where(function($q) use ($request){
                $q->where('nama_sentrausaha','like','%'.$request->search.'%');
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

        return view('admin.admin_pum.sentrausaha.adminsentrausaha', compact(
            'data',
            'kecamatan'
        ));
    }


    public function create(){
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();
        return view('admin.admin_pum.sentrausaha.sentrausahacreate', compact('kecamatan', 'kelurahan'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_sentrausaha'  => 'required',
            'alamat'  => 'required',
            'kelurahan_id'  => 'required',
            'luas'  => 'required',
            'kapasitas'  => 'required',
            'latitude'  => 'required',
            'longitude'  => 'required',

            'foto'  => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        // upload foto
        $foto = null;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('sentrausaha', 'public');
        }

        Sentrausaha::create([
            'nama_sentrausaha' => $request->nama_sentrausaha,
            'alamat' => $request->alamat,
            'kelurahan_id' => $request->kelurahan_id,
            'luas' => $request->luas,
            'kapasitas' => $request->kapasitas,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'foto' => $foto,
        ]);

        
        return redirect()->route('adminsentrausaha')->with('success', 'Upload berhasil');
    }


    public function edit($id){
        $data = Sentrausaha::with(['kelurahan.kecamatan'])->findOrFail($id);
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();

        return view('admin.admin_pum.sentrausaha.sentrausahaedit', compact('data', 'kecamatan', 'kelurahan'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_sentrausaha'        => 'required|string',
            'alamat'            => 'required|string',
            'kelurahan_id'      => 'required',
            'luas'              => 'required|numeric',
            'kapasitas'         => 'required|numeric',
            'latitude'          => 'required',
            'longitude'         => 'required',
            'foto'              => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $data = Sentrausaha::findOrFail($id);

        // upload foto baru
        if ($request->hasFile('foto')) {

            // hapus foto lama
            if ($data->foto && Storage::disk('public')->exists($data->foto)) {
                Storage::disk('public')->delete($data->foto);
            }

            $foto = $request->file('foto')->store('sentrausaha', 'public');

        } else {
            $foto = $data->foto;
        }

        $data->update([
            'nama_sentrausaha' => $request->nama_sentrausaha,
            'alamat' => $request->alamat,
            'kelurahan_id' => $request->kelurahan_id,
            'luas' => $request->luas,
            'kapasitas' => $request->kapasitas,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'foto' => $foto,
        ]);

        return redirect()->route('adminsentrausaha')->with('success', 'Update berhasil');
    }


    public function destroy($id)
    {
        $sentrausaha = Sentrausaha::findOrFail($id);

        // hapus foto
        if ($sentrausaha->foto && Storage::disk('public')->exists($sentrausaha->foto)) {
            Storage::disk('public')->delete($sentrausaha->foto);
        }

        $sentrausaha->delete();

        return redirect()->route('adminsentrausaha')->with('success', 'Data berhasil dihapus');
    }

    public function getKelurahan($ID_KECAMATAN)
    {
        $kelurahan = Kelurahan::where('ID_KECAMATAN', $ID_KECAMATAN)->get();
        return response()->json($kelurahan);
    }

    // ================= FRONTEND =================
    public function sentrausaha(Request $request)
    {
        $query = Sentrausaha::with('kelurahan.kecamatan');

        if($request->search){
            $query->where(function($q) use ($request){
                $q->where('nama_sentrausaha','like','%'.$request->search.'%');
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

        $summaryQuery = clone $query;

        // ambil data Sentrausaha
        $data = $query->latest()->get();

        // AJAX
        if ($request->ajax()) {
            return response()->json([
                'data' => $data
            ]);
        }

        $kecamatan = Kecamatan::all();

        // kirim ke blade
        return view('bidang.pum.sentrausaha', [
            'sentrausaha' => $data,
            'kecamatan' => $kecamatan,
        ]);
    }
}