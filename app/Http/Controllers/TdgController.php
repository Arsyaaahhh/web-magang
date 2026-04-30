<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tdg;

class TdgController extends Controller
{
    // ================= INDEX =================
    public function index()
    {
        $data = Tdg::latest()->paginate(10);
        return view('admin.admin_pup.tdg.index', compact('data'));
    }

    // ================= CREATE =================
    public function create()
    {
        return view('admin.admin_pup.tdg.create');
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'nama_usaha'      => 'required',
            'pemilik'         => 'required',
            'alamat'          => 'required',
            'nama_gudang'     => 'nullable',
            'lokasi_gudang'   => 'nullable',
            'nomor_tdg'       => 'required|unique:tdgs',
            'tanggal_terbit'  => 'required|date',
            'status'          => 'nullable'
        ]);

        Tdg::create([
            'nama_usaha'     => $request->nama_usaha,
            'pemilik'        => $request->pemilik,
            'alamat'         => $request->alamat,
            'nama_gudang'    => $request->nama_gudang,
            'lokasi_gudang'  => $request->lokasi_gudang,
            'nomor_tdg'      => $request->nomor_tdg,
            'tanggal_terbit' => $request->tanggal_terbit,
            'status'         => $request->status ?? 'Aktif'
        ]);

        return redirect()->route('tdg.index')->with('success','Data berhasil ditambahkan');
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $data = Tdg::findOrFail($id);
        return view('admin.admin_pup.tdg.edit', compact('data'));
    }

    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        $data = Tdg::findOrFail($id);

        $request->validate([
            'nama_usaha'      => 'required',
            'pemilik'         => 'required',
            'alamat'          => 'required',
            'nama_gudang'     => 'nullable',
            'lokasi_gudang'   => 'nullable',
            'nomor_tdg'       => 'required|unique:tdgs,nomor_tdg,' . $id,
            'tanggal_terbit'  => 'required|date',
            'status'          => 'nullable'
        ]);

        $data->update([
            'nama_usaha'     => $request->nama_usaha,
            'pemilik'        => $request->pemilik,
            'alamat'         => $request->alamat,
            'nama_gudang'    => $request->nama_gudang,
            'lokasi_gudang'  => $request->lokasi_gudang,
            'nomor_tdg'      => $request->nomor_tdg,
            'tanggal_terbit' => $request->tanggal_terbit,
            'status'         => $request->status ?? 'Aktif'
        ]);

        return redirect()->route('tdg.index')->with('success','Data berhasil diupdate');
    }

    // ================= DELETE =================
    public function destroy($id)
    {
        Tdg::findOrFail($id)->delete();
        return back()->with('success','Data berhasil dihapus');
    }
}