<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PegawaiRekap;

class PegawaiController extends Controller
{
    // ================= LIST =================
    public function rekap()
    {
        $data = PegawaiRekap::latest()->get();
        return view('admin.admin_sekre.pegawai.rekap', compact('data'));
    }

    // ================= CREATE =================
    public function createRekap()
    {
        return view('admin.admin_sekre.pegawai.create'); // ✅ FIX
    }

    // ================= STORE =================
    public function storeRekap(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'pendidikan' => 'required',
            'bidang' => 'required', // <--- TAMBAHAN VALIDASI BIDANG
            'jumlah' => 'required|numeric'
        ]);

        PegawaiRekap::create($request->all());

        return redirect()->route('pegawai.rekap')
            ->with('success','Data berhasil ditambahkan');
    }

    // ================= EDIT =================
    public function editRekap($id)
    {
        $data = PegawaiRekap::findOrFail($id);
        return view('admin.admin_sekre.pegawai.edit', compact('data')); // ✅ FIX
    }

    // ================= UPDATE =================
    public function updateRekap(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
            'pendidikan' => 'required',
            'bidang' => 'required', // <--- TAMBAHAN VALIDASI BIDANG
            'jumlah' => 'required|numeric'
        ]);

        $data = PegawaiRekap::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('pegawai.rekap')
            ->with('success','Data berhasil diupdate');
    }

    // ================= DELETE =================
    public function deleteRekap($id)
    {
        PegawaiRekap::findOrFail($id)->delete();

        return back()->with('success','Data berhasil dihapus');
    }
}