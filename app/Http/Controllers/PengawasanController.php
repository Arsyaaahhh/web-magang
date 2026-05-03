<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengawasan;

class PengawasanController extends Controller
{
    /**
     * Menampilkan halaman utama (tabel data pengawasan)
     */
    public function index()
    {
        // Mengambil data dari database, diurutkan dari yang terbaru, 10 data per halaman
        $data = Pengawasan::latest()->paginate(10);
        
        // Mengarah ke file: resources/views/admin/admin_pup/pengawasan/pengawasan.blade.php
        return view('admin.admin_pup.pengawasan.pengawasan', compact('data'));
    }

    /**
     * Menampilkan form tambah data
     */
    public function create()
    {
        // Mengarah ke file: resources/views/admin/admin_pup/pengawasan/create.blade.php
        return view('admin.admin_pup.pengawasan.create');
    }

    /**
     * Memproses penyimpanan data baru ke database
     */
    public function store(Request $request)
    {
        // 1. Validasi inputan form
        $request->validate([
            'jenis_pengawasan' => 'required',
            'tahun' => 'required|numeric',
            'jumlah' => 'required|numeric',
        ]);

        // 2. Simpan ke database
        Pengawasan::create($request->all());

        // 3. Kembali ke halaman index bawa pesan sukses
        return redirect()->route('pengawasan.index')->with('success', 'Data Pengawasan berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit data beserta data lamanya
     */
    public function edit($id)
    {
        // Cari data berdasarkan ID
        $data = Pengawasan::findOrFail($id);
        
        // Mengarah ke file: resources/views/admin/admin_pup/pengawasan/edit.blade.php
        return view('admin.admin_pup.pengawasan.edit', compact('data'));
    }

    /**
     * Memproses perubahan data (update) ke database
     */
    public function update(Request $request, $id)
    {
        // 1. Validasi inputan form
        $request->validate([
            'jenis_pengawasan' => 'required',
            'tahun' => 'required|numeric',
            'jumlah' => 'required|numeric',
        ]);

        // 2. Cari data yang mau diedit, lalu update
        $data = Pengawasan::findOrFail($id);
        $data->update($request->all());

        // 3. Kembali ke halaman index bawa pesan sukses
        return redirect()->route('pengawasan.index')->with('success', 'Data Pengawasan berhasil diperbarui!');
    }

    /**
     * Menghapus data dari database
     */
    public function destroy($id)
    {
        // Cari data berdasarkan ID, lalu hapus
        $data = Pengawasan::findOrFail($id);
        $data->delete();

        // Kembali ke halaman sebelumnya bawa pesan sukses
        return back()->with('success', 'Data Pengawasan berhasil dihapus!');
    }
}