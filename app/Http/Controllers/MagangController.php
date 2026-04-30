<?php

namespace App\Http\Controllers;

use App\Models\Magang;
use Illuminate\Http\Request;

class MagangController extends Controller
{
    public function index()
    {
        $data = Magang::latest()->paginate(10);
        return view('admin.admin_sekre.magang.index', compact('data'));
    }

    public function indexPup()
    {
        $data = Magang::latest()->paginate(10);
        return view('admin.admin_pup.magang.index', compact('data'));
    }

    public function create()
    {
        return view('admin.admin_sekre.magang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:magangs,email,' . $id,
            'nama' => 'required',
            'asal_univ' => 'required',
            'awal_pelaksanaan' => 'required|date',
            'akhir_pelaksanaan' => 'required|date',
            'posisi' => 'required',
        ]);

        Magang::create($request->all());

        return redirect()->route('magang.index')->with('success', 'Data magang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Magang::findOrFail($id);
        return view('admin.admin_sekre.magang.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email|unique:magangs,email,' . $id,
            'nama' => 'required',
            'asal_univ' => 'required',
            'awal_pelaksanaan' => 'required|date',
            'akhir_pelaksanaan' => 'required|date',
            'posisi' => 'required',
        ]);

        $magang = Magang::findOrFail($id);
        $magang->update($request->all());

        return redirect()->route('magang.index')->with('success', 'Data magang berhasil diupdate');
    }

    public function destroy($id)
    {
        $magang = Magang::findOrFail($id);
        $magang->delete();

        return redirect()->route('magang.index')->with('success', 'Data magang berhasil dihapus');
    }
}
