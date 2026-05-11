<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengawasan;
use App\Models\Kecamatan; // 🔥 TAMBAHAN: Panggil model Kecamatan

class PengawasanController extends Controller
{
    /**
     * Menampilkan halaman utama (tabel data pengawasan)
     */
    public function index(Request $request)
    {
        $query = Pengawasan::query();

        // 🔥 Tangkap Filter Tahun
        if ($request->tahun) {
            $query->where('tahun', $request->tahun);
        }

        // 🔥 Tangkap Filter Kecamatan
        if ($request->kecamatan) {
            $query->where('kecamatan', $request->kecamatan);
        }

        // Mengambil data dari database dengan filter, diurutkan terbaru, dan simpan state pagination
        $data = $query->orderBy('tahun', 'desc')->paginate(10)->withQueryString();
        
        // 🔥 Ambil list kecamatan untuk dropdown filter
        $list_kecamatan = Kecamatan::orderBy('NM_KECAMATAN', 'asc')->get();

        // 🔥 Ambil list tahun yang ada di database (unik) untuk dropdown filter
        $list_tahun = Pengawasan::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        // Mengarah ke file: resources/views/admin/admin_pup/pengawasan/pengawasan.blade.php
        return view('admin.admin_pup.pengawasan.pengawasan', compact('data', 'list_kecamatan', 'list_tahun'));
    }

    /**
     * Menampilkan form tambah data
     */
    public function create()
    {
        // Mengambil list kecamatan dari database
        $list_kecamatan = Kecamatan::orderBy('NM_KECAMATAN', 'asc')->get();

        return view('admin.admin_pup.pengawasan.create', compact('list_kecamatan'));
    }

    /**
     * Memproses penyimpanan data baru ke database
     */
    public function store(Request $request)
    {
        // 1. Validasi inputan form
        $request->validate([
            'jenis_pengawasan' => 'required',
            'kecamatan'        => 'required', 
            'tahun'            => 'required|numeric',
            'jumlah'           => 'required|numeric',
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
        
        // Mengambil list kecamatan dari database
        $list_kecamatan = Kecamatan::orderBy('NM_KECAMATAN', 'asc')->get();
        
        return view('admin.admin_pup.pengawasan.edit', compact('data', 'list_kecamatan'));
    }

    /**
     * Memproses perubahan data (update) ke database
     */
    public function update(Request $request, $id)
    {
        // 1. Validasi inputan form
        $request->validate([
            'jenis_pengawasan' => 'required',
            'kecamatan'        => 'required',
            'tahun'            => 'required|numeric',
            'jumlah'           => 'required|numeric',
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