<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tdg;
use App\Models\Kecamatan; // Pastikan Model Kecamatan dipanggil
use Illuminate\Validation\Rule;

class TdgController extends Controller
{
    // ================= INDEX =================
    public function index(Request $request)
    {
        $query = Tdg::query();

        // 🔥 Tangkap Filter Tahun
        if ($request->tahun) {
            $query->where('tahun', $request->tahun);
        }

        // 🔥 Tangkap Filter Kecamatan
        if ($request->kecamatan) {
            $query->where('kecamatan', $request->kecamatan);
        }

        // Mengurutkan dari tahun terbaru dan simpan query string
        $data = $query->orderBy('tahun', 'desc')->paginate(10)->withQueryString();
        
        // 🔥 Ambil list kecamatan
        $list_kecamatan = Kecamatan::orderBy('NM_KECAMATAN', 'asc')->get();

        // 🔥 Ambil list tahun yang ada di database (unik)
        $list_tahun = Tdg::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        return view('admin.admin_pup.tdg.index', compact('data', 'list_kecamatan', 'list_tahun'));
    }

    // ================= CREATE =================
    public function create()
    {
        $list_kecamatan = Kecamatan::orderBy('NM_KECAMATAN', 'asc')->get();
        return view('admin.admin_pup.tdg.create', compact('list_kecamatan'));
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'tahun'     => [
                'required',
                'integer',
                Rule::unique('tdgs')->where(function ($query) use ($request) {
                    return $query->where('kecamatan', $request->kecamatan);
                })
            ],
            'kecamatan' => 'required',
            'jumlah'    => 'required|integer|min:0'
        ], [
            'tahun.unique' => 'Data untuk Tahun dan Kecamatan ini sudah ada! Silakan edit data yang sudah ada.'
        ]);

        Tdg::create([
            'tahun'     => $request->tahun,
            'kecamatan' => $request->kecamatan,
            'jumlah'    => $request->jumlah
        ]);

        return redirect()->route('tdg.index')->with('success','Data TDG berhasil ditambahkan');
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $data = Tdg::findOrFail($id);
        $list_kecamatan = Kecamatan::orderBy('NM_KECAMATAN', 'asc')->get();
        return view('admin.admin_pup.tdg.edit', compact('data', 'list_kecamatan'));
    }

    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        $data = Tdg::findOrFail($id);

        $request->validate([
            'tahun'     => [
                'required',
                'integer',
                Rule::unique('tdgs')->where(function ($query) use ($request) {
                    return $query->where('kecamatan', $request->kecamatan);
                })->ignore($id)
            ],
            'kecamatan' => 'required',
            'jumlah'    => 'required|integer|min:0'
        ], [
            'tahun.unique' => 'Data untuk Tahun dan Kecamatan ini sudah ada!'
        ]);

        $data->update([
            'tahun'     => $request->tahun,
            'kecamatan' => $request->kecamatan,
            'jumlah'    => $request->jumlah
        ]);

        return redirect()->route('tdg.index')->with('success','Data TDG berhasil diupdate');
    }

    // ================= DELETE =================
    public function destroy($id)
    {
        Tdg::findOrFail($id)->delete();
        return back()->with('success','Data TDG berhasil dihapus');
    }
}