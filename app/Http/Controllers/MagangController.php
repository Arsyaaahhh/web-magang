<?php

namespace App\Http\Controllers;

use App\Models\Magang;
use Illuminate\Http\Request;

class MagangController extends Controller
{
    // ================= INDEX =================
    public function index()
    {
        $data = Magang::latest()->paginate(10);
        return view('admin.admin_sekre.magang.index', compact('data'));
    }

    // ================= CREATE =================
    public function create()
    {
        return view('admin.admin_sekre.magang.create');
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:magangs,email',
            'nama' => 'required',
            'asal_univ' => 'required',
            'awal_pelaksanaan' => 'required|date',
            'akhir_pelaksanaan' => 'required|date|after_or_equal:awal_pelaksanaan',
            'posisi' => 'required',
        ]);

        Magang::create([
            'email' => $request->email,
            'nama' => $request->nama,
            'asal_univ' => $request->asal_univ,
            'awal_pelaksanaan' => $request->awal_pelaksanaan,
            'akhir_pelaksanaan' => $request->akhir_pelaksanaan,
            'posisi' => $request->posisi,
        ]);

        return redirect()->route('magang.index')
            ->with('success', 'Data magang berhasil ditambahkan');
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $data = Magang::findOrFail($id);
        return view('admin.admin_sekre.magang.edit', compact('data'));
    }

    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email|unique:magangs,email,' . $id,
            'nama' => 'required',
            'asal_univ' => 'required',
            'awal_pelaksanaan' => 'required|date',
            'akhir_pelaksanaan' => 'required|date|after_or_equal:awal_pelaksanaan',
            'posisi' => 'required',
        ]);

        $magang = Magang::findOrFail($id);

        $magang->update([
            'email' => $request->email,
            'nama' => $request->nama,
            'asal_univ' => $request->asal_univ,
            'awal_pelaksanaan' => $request->awal_pelaksanaan,
            'akhir_pelaksanaan' => $request->akhir_pelaksanaan,
            'posisi' => $request->posisi,
        ]);

        return redirect()->route('magang.index')
            ->with('success', 'Data magang berhasil diupdate');
    }

    // ================= DELETE =================
    public function destroy($id)
    {
        $magang = Magang::findOrFail($id);
        $magang->delete();

        return redirect()->route('magang.index')
            ->with('success', 'Data magang berhasil dihapus');
    }
}