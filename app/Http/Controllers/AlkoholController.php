<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alkohol;

class AlkoholController extends Controller
{
    public function index()
    {
        $data = Alkohol::latest()->paginate(10);
        return view('admin.admin_pup.alkohol.alkohol', compact('data'));
    }

    public function create()
    {
        return view('admin.admin_pup.alkohol.create');
    }

    public function store(Request $request)
    {
        $request->validate(['golongan' => 'required', 'tahun' => 'required|numeric', 'jumlah' => 'required|numeric']);
        Alkohol::create($request->all());
        return redirect()->route('alkohol.index')->with('success', 'Data Penjual Alkohol berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = Alkohol::findOrFail($id);
        return view('admin.admin_pup.alkohol.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['golongan' => 'required', 'tahun' => 'required|numeric', 'jumlah' => 'required|numeric']);
        $data = Alkohol::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('alkohol.index')->with('success', 'Data Penjual Alkohol berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Alkohol::findOrFail($id)->delete();
        return back()->with('success', 'Data Penjual Alkohol berhasil dihapus!');
    }
}