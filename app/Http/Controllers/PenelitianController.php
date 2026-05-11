<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penelitian;

class PenelitianController extends Controller
{
    // ================= LIST =================
    public function index()
    {
        $data = Penelitian::latest()->get();
        // Mengarah ke: resources/views/admin/admin_sekre/penelitian/penelitian.blade.php
        return view('admin.admin_sekre.penelitian.penelitian', compact('data'));
    }

    // ================= CREATE =================
    public function create()
    {
        // Mengarah ke: resources/views/admin/admin_sekre/penelitian/create.blade.php
        return view('admin.admin_sekre.penelitian.create');
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'univ' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'tahun' => 'required|numeric'
        ]);

        Penelitian::create($request->all());

        return redirect()->route('penelitian.index')
            ->with('success', 'Data Penelitian berhasil ditambahkan!');
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $data = Penelitian::findOrFail($id);
        // Mengarah ke: resources/views/admin/admin_sekre/penelitian/edit.blade.php
        return view('admin.admin_sekre.penelitian.edit', compact('data'));
    }

    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'univ' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'tahun' => 'required|numeric'
        ]);

        $data = Penelitian::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('penelitian.index')
            ->with('success', 'Data Penelitian berhasil diupdate!');
    }

    // ================= DELETE =================
    public function destroy($id)
    {
        Penelitian::findOrFail($id)->delete();
        
        return back()->with('success', 'Data Penelitian berhasil dihapus!');
    }
}