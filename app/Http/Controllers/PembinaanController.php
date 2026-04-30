<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tdg;

class PembinaanController extends Controller
{
    // VIEW (halaman HTML)
    public function view()
    {
        return view('bidang.pembinaan');
    }

    // DATA (JSON untuk AJAX)
    public function index(Request $request)
    {
        $data = collect();

        if($request->jenis == 'tdg'){
            $data = Tdg::latest()->get();
        }

        return response()->json([
            'data' => $data,
            'jumlah' => [
                'tdg' => Tdg::count(),
                'pengawasan' => 0,
                'minol' => 0,
            ]
        ]);
    }
}