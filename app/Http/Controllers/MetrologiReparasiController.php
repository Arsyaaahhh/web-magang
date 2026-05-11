<?php

namespace App\Http\Controllers;

use App\Models\MetrologiReparasi;
use App\Models\Kecamatan; // Memanggil model Kecamatan
use Illuminate\Validation\Rule; // Memanggil Rule untuk validasi unik
use Illuminate\Http\Request;

class MetrologiReparasiController extends Controller
{
    public function index(Request $request)
    {
        $query = MetrologiReparasi::query();
        
        // 1. Tangkap Filter Tahun
        if ($request->tahun) {
            $query->where('tahun', $request->tahun);
        }

        // 2. Tangkap Filter Kecamatan
        if ($request->kecamatan) {
            $query->where('kecamatan', $request->kecamatan);
        }
        
        // 3. Menampilkan data dengan pagination (dan menyimpan state filter di URL)
        $data = $query->orderBy('tahun', 'desc')->paginate(10)->withQueryString();
        
        // 4. Ambil list kecamatan dari database untuk dropdown filter
        $list_kecamatan = Kecamatan::orderBy('NM_KECAMATAN', 'asc')->get();

        // 5. Ambil list tahun yang sudah ada di database (unik/tidak ganda) untuk dropdown filter
        $list_tahun = MetrologiReparasi::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');
        
        // Lempar semua variabel ke view
        return view('admin.admin_metro.reparasi.reparasi', compact('data', 'list_kecamatan', 'list_tahun'));
    }

    public function create()
    {
        // Ambil data kecamatan untuk ditampilkan di form tambah data
        $list_kecamatan = Kecamatan::orderBy('NM_KECAMATAN', 'asc')->get();
        return view('admin.admin_metro.reparasi.create', compact('list_kecamatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => [
                'required',
                // Validasi agar kombinasi tahun & kecamatan tidak dobel
                Rule::unique('metrologi_reparasis')->where(function ($query) use ($request) {
                    return $query->where('kecamatan', $request->kecamatan);
                })
            ],
            'kecamatan' => 'required',
            'jumlah' => 'required|numeric'
        ], [
            'tahun.unique' => 'Data reparasi untuk tahun dan kecamatan ini sudah ada!'
        ]);

        MetrologiReparasi::create($request->all());
        
        return redirect('/admin/admin_metro/reparasi')->with('success', 'Data berhasil ditambah');
    }

    public function edit($id)
    {
        $data = MetrologiReparasi::findOrFail($id);
        
        // Ambil data kecamatan untuk form edit
        $list_kecamatan = Kecamatan::orderBy('NM_KECAMATAN', 'asc')->get();
        
        return view('admin.admin_metro.reparasi.edit', compact('data', 'list_kecamatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun' => [
                'required',
                // Abaikan ID yang sedang diedit agar bisa update datanya sendiri
                Rule::unique('metrologi_reparasis')->where(function ($query) use ($request) {
                    return $query->where('kecamatan', $request->kecamatan);
                })->ignore($id)
            ],
            'kecamatan' => 'required',
            'jumlah' => 'required|numeric'
        ], [
            'tahun.unique' => 'Data reparasi untuk tahun dan kecamatan ini sudah ada!'
        ]);

        MetrologiReparasi::findOrFail($id)->update($request->all());
        
        return redirect('/admin/admin_metro/reparasi')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        MetrologiReparasi::findOrFail($id)->delete();
        return redirect('/admin/admin_metro/reparasi')->with('success', 'Data berhasil dihapus');
    }
}