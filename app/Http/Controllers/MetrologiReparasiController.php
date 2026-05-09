<?php

namespace App\Http\Controllers;

use App\Models\MetrologiReparasi;
use Illuminate\Http\Request;

class MetrologiReparasiController extends Controller
{
    public function index(Request $request)
    {
        $query = MetrologiReparasi::query();
        if ($request->tahun) {
            $query->where('tahun', $request->tahun);
        }
        $data = $query->orderBy('tahun', 'desc')->paginate(10);
        
        // Memanggil view di folder reparasi
        return view('admin.admin_metro.reparasi.reparasi', compact('data'));
    }

    public function create()
    {
        return view('admin.admin_metro.reparasi.create');
    }

    public function store(Request $request)
    {
        $request->validate(['tahun' => 'required', 'jumlah' => 'required|numeric']);
        MetrologiReparasi::create($request->all());
        return redirect('/admin/admin_metro/reparasi')->with('success', 'Data berhasil ditambah');
    }

    public function edit($id)
    {
        $data = MetrologiReparasi::findOrFail($id);
        return view('admin.admin_metro.reparasi.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['tahun' => 'required', 'jumlah' => 'required|numeric']);
        MetrologiReparasi::findOrFail($id)->update($request->all());
        return redirect('/admin/admin_metro/reparasi')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        MetrologiReparasi::findOrFail($id)->delete();
        return redirect('/admin/admin_metro/reparasi')->with('success', 'Data berhasil dihapus');
    }
}