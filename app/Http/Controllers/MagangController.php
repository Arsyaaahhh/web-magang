<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RekapMagang; // Pastikan menggunakan model RekapMagang

class MagangController extends Controller
{
    /**
     * Menampilkan halaman daftar data (index)
     */
    public function index()
    {
        // Variabel bernama $data agar tidak error undefined variable di blade
        $data = RekapMagang::orderBy('created_at', 'desc')->get();
        
        // Path view disesuaikan dengan struktur folder kamu
        return view('admin.admin_sekre.magang.index', compact('data'));
    }

    /**
     * Menampilkan form tambah data
     */
    public function create()
    {
        return view('admin.admin_sekre.magang.create');
    }

    /**
     * Menyimpan data baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun'  => 'required',
            'bulan'  => 'required',
            'jumlah' => 'required|numeric'
        ]);

        RekapMagang::create([
            'tahun'  => $request->tahun,
            'bulan'  => $request->bulan,
            'jumlah' => $request->jumlah
        ]);

        return redirect()->route('magang.index')->with('success', 'Data Rekap Magang berhasil disimpan!');
    }

    /**
     * Menampilkan form edit data
     */
    public function edit($id)
    {
        // Menggunakan nama variabel $data agar konsisten dengan file blade edit kamu nantinya
        $data = RekapMagang::findOrFail($id);
        
        return view('admin.admin_sekre.magang.edit', compact('data'));
    }

    /**
     * Memperbarui data di database
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun'  => 'required',
            'bulan'  => 'required',
            'jumlah' => 'required|numeric'
        ]);

        $magang = RekapMagang::findOrFail($id);
        
        $magang->update([
            'tahun'  => $request->tahun,
            'bulan'  => $request->bulan,
            'jumlah' => $request->jumlah
        ]);

        return redirect()->route('magang.index')->with('success', 'Data Rekap Magang berhasil diubah!');
    }

    /**
     * Menghapus data dari database
     */
    public function destroy($id)
    {
        $magang = RekapMagang::findOrFail($id);
        $magang->delete();

        return redirect()->route('magang.index')->with('success', 'Data Rekap Magang berhasil dihapus!');
    }
}