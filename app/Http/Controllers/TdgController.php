<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tdg;

class TdgController extends Controller
{
    // ================= INDEX =================
    public function index()
    {
        // Mengurutkan dari tahun terbaru
        $data = Tdg::orderBy('tahun', 'desc')->paginate(10);
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
            'tahun'  => 'required|integer|unique:tdgs,tahun',
            'jumlah' => 'required|integer|min:0'
        ], [
            'tahun.unique' => 'Data untuk tahun ini sudah ada! Silakan edit data yang sudah ada.'
        ]);

        Tdg::create([
            'tahun'  => $request->tahun,
            'jumlah' => $request->jumlah
        ]);

        return redirect()->route('tdg.index')->with('success','Data TDG berhasil ditambahkan');
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
            // Validasi unique mengabaikan ID yang sedang diedit
            'tahun'  => 'required|integer|unique:tdgs,tahun,' . $id,
            'jumlah' => 'required|integer|min:0'
        ], [
            'tahun.unique' => 'Data untuk tahun ini sudah ada!'
        ]);

        $data->update([
            'tahun'  => $request->tahun,
            'jumlah' => $request->jumlah
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