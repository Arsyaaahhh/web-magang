<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    public function index()
    {
        $data = Pegawai::latest()->paginate(10);
        return view('admin.admin_sekre.pegawai.index', compact('data'));
    }

    public function indexPup()
    {
        $data = Pegawai::latest()->paginate(10);
        return view('admin.admin_pup.pegawai.index', compact('data'));
    }

    public function create()
    {
        return view('admin.admin_sekre.pegawai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'bidang' => 'required',
            'posisi' => 'required',
            'alamat' => 'required',
        ]);

        Pegawai::create($request->all());

        return redirect()->route('pegawai.index')->with('success','Data berhasil ditambah');
    }

    public function edit($id)
    {
        $data = Pegawai::findOrFail($id);
        return view('admin.admin_sekre.pegawai.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'bidang' => 'required',
            'posisi' => 'required',
            'alamat' => 'required',
        ]);

        $data = Pegawai::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('pegawai.index')->with('success','Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Pegawai::findOrFail($id)->delete();
        return back()->with('success','Data dihapus');
    }
}