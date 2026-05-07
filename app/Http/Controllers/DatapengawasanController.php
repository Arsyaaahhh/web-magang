<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai; // tetap pakai model Pegawai

class DatapengawasanController extends Controller
{
    // ================= ADMIN =================
    public function index(Request $request)
    {
        $query = Pegawai::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('jumlah_pegawai', 'like', '%' . $request->search . '%')
                  ->orWhere('status', 'like', '%' . $request->search . '%')
                  ->orWhere('program', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->program) {
            $query->where('program', $request->program);
        }

        $data = $query->latest()->paginate(10)->withQueryString();

        return view('admin.datapengawasan.index', compact('data'));
    }

    public function create()
    {
        return view('admin.datapengawasan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah_pegawai' => 'required|integer|min:0',
            'status' => 'required|in:pns,non_pns',
            'program' => 'required|in:diklat,bimtek,tidak ada',
        ]);

        Pegawai::create($request->only([
            'jumlah_pegawai',
            'status',
            'program'
        ]));

        return redirect('/admin/datapengawasan')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Pegawai::findOrFail($id);
        return view('admin.datapengawasan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah_pegawai' => 'required|integer|min:0',
            'status' => 'required|in:pns,non_pns',
            'program' => 'required|in:diklat,bimtek,tidak ada',
        ]);

        $pegawai = Pegawai::findOrFail($id);
        $pegawai->update($request->only([
            'jumlah_pegawai',
            'status',
            'program'
        ]));

        return redirect('/admin/datapengawasan')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Pegawai::findOrFail($id)->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}