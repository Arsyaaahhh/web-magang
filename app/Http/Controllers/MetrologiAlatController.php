<?php

namespace App\Http\Controllers;

use App\Models\MetrologiAlat;
use Illuminate\Http\Request;

class MetrologiAlatController extends Controller
{
    public function index(Request $request)
    {
        $query = MetrologiAlat::query();
        if ($request->tahun) {
            $query->where('tahun', $request->tahun);
        }
        $data = $query->orderBy('tahun', 'desc')->paginate(10);
        return view('admin.admin_metro.alat.alat', compact('data'));
    }

    public function create() { return view('admin.admin_metro.alat.create'); }

    public function store(Request $request)
    {
        $request->validate(['tahun' => 'required', 'jumlah' => 'required|numeric']);
        MetrologiAlat::create($request->all());
        return redirect('/admin/admin_metro/alat')->with('success', 'Data berhasil ditambah');
    }

    public function edit($id)
    {
        $data = MetrologiAlat::findOrFail($id);
        return view('admin.admin_metro.alat.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['tahun' => 'required', 'jumlah' => 'required|numeric']);
        MetrologiAlat::findOrFail($id)->update($request->all());
        return redirect('/admin/admin_metro/alat')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        MetrologiAlat::findOrFail($id)->delete();
        return redirect('/admin/admin_metro/alat')->with('success', 'Data berhasil dihapus');
    }
}