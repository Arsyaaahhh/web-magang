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
        return view('admin.admin_sekre.pegawai.create'); 
    }

    // ================= STORE =================
    public function storeRekap(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'pendidikan' => 'required',
            'bidang' => 'required', 
            'jumlah' => 'required|numeric',
            'pangkat_golongan' => 'nullable|string'
        ]);

        $data = $request->all();
        
        // PERBAIKAN: Gunakan huruf besar 'PNS' sesuai dengan value di HTML
        if ($data['status'] !== 'PNS') {
            $data['pangkat_golongan'] = null;
        }

        PegawaiRekap::create($data);

        return redirect()->route('pegawai.rekap')
            ->with('success','Data berhasil ditambahkan');
    }

    // ================= EDIT =================
    public function editRekap($id)
    {
        $data = PegawaiRekap::findOrFail($id);
        return view('admin.admin_sekre.pegawai.edit', compact('data')); 
    }

    // ================= UPDATE =================
    public function updateRekap(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
            'pendidikan' => 'required',
            'bidang' => 'required', 
            'jumlah' => 'required|numeric',
            'pangkat_golongan' => 'nullable|string'
        ]);

        $input = $request->all();
        
        // PERBAIKAN: Gunakan huruf besar 'PNS' sesuai dengan value di HTML
        if ($input['status'] !== 'PNS') {
            $input['pangkat_golongan'] = null;
        }

        $data = PegawaiRekap::findOrFail($id);
        $data->update($input);

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