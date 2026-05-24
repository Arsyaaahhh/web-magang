<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Swk;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SwkController extends Controller
{
    // ================= ADMIN =================
    public function index(Request $request)
    {
        $query = Swk::with('kelurahan.kecamatan');

        if($request->search){
            $query->where(function($q) use ($request){
                $q->where('nama_swk','like','%'.$request->search.'%');
            });
        }

        // FILTER KECAMATAN
        if ($request->kecamatan_id) {
            $query->whereHas('kelurahan', function($q) use ($request) {
                $q->where('ID_KECAMATAN', $request->kecamatan_id);
            });
        }

        // FILTER KELURAHAN
        if ($request->kelurahan_id) {
            $query->where('kelurahan_id', $request->kelurahan_id);
        }

        $data = $query->latest()->paginate(10)->withQueryString();
        $kecamatan = Kecamatan::all();

        // Path view sudah disesuaikan ke dalam folder swk
        return view('admin.admin_pum.swk.adminswk', compact(
            'data',
            'kecamatan'
        ));
    }

    public function create()
    {
        $kecamatan = Kecamatan::all();
        $kelurahan = collect(); 
        
        // Path view sudah disesuaikan ke dalam folder swk
        return view('admin.admin_pum.swk.swkcreate', compact('kecamatan', 'kelurahan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_swk'          => 'required|string',
            'alamat'            => 'required|string',
            'kelurahan_id'      => 'required',
            'jumlah_pedagang'   => 'required|numeric',
            'jumlah_stan'       => 'required|numeric',
            'stan_belum_terisi' => 'required|numeric',
            'luas'              => 'required|numeric',
            'kapasitas'         => 'required|numeric',
            'peken'             => 'required|numeric',
            'latitude'          => 'required',
            'longitude'         => 'required',
            'foto'              => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        // upload foto
        $foto = null;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('swk', 'public');
        }

        Swk::create([
            'nama_swk' => $request->nama_swk,
            'alamat' => $request->alamat,
            'kelurahan_id' => $request->kelurahan_id,
            'jumlah_pedagang' => $request->jumlah_pedagang,
            'jumlah_stan' => $request->jumlah_stan,
            'stan_belum_terisi' => $request->stan_belum_terisi,
            'luas' => $request->luas,
            'kapasitas' => $request->kapasitas,
            'peken' => $request->peken,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'foto' => $foto,
        ]);

        return redirect('/admin/admin_pum/adminswk')->with('success','Data SWK berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Swk::with(['kelurahan.kecamatan'])->findOrFail($id);
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::where('ID_KECAMATAN', $data->kelurahan->ID_KECAMATAN ?? null)->get();

        // Path view sudah disesuaikan ke dalam folder swk
        return view('admin.admin_pum.swk.swkedit', compact('data', 'kecamatan', 'kelurahan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_swk'          => 'required|string',
            'alamat'            => 'required|string',
            'kelurahan_id'      => 'required',
            'jumlah_pedagang'   => 'required|numeric',
            'jumlah_stan'       => 'required|numeric',
            'stan_belum_terisi' => 'required|numeric',
            'luas'              => 'required|numeric',
            'kapasitas'         => 'required|numeric',
            'peken'             => 'required|numeric',
            'latitude'          => 'required',
            'longitude'         => 'required',
            'foto'              => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $data = Swk::findOrFail($id);

        // upload foto baru
        if ($request->hasFile('foto')) {

            // hapus foto lama
            if ($data->foto && Storage::disk('public')->exists($data->foto)) {
                Storage::disk('public')->delete($data->foto);
            }

            $foto = $request->file('foto')->store('swk', 'public');

        } else {
            $foto = $data->foto;
        }

        $data->update([
            'nama_swk' => $request->nama_swk,
            'alamat' => $request->alamat,
            'kelurahan_id' => $request->kelurahan_id,
            'jumlah_pedagang' => $request->jumlah_pedagang,
            'jumlah_stan' => $request->jumlah_stan,
            'stan_belum_terisi' => $request->stan_belum_terisi,
            'luas' => $request->luas,
            'kapasitas' => $request->kapasitas,
            'peken' => $request->peken,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'foto' => $foto,
        ]);

        return redirect('/admin/admin_pum/adminswk')->with('success','Data SWK berhasil diperbarui');
    }

    public function destroy($id)
    {
        $swk = Swk::findOrFail($id);

        // hapus foto
        if ($swk->foto && Storage::disk('public')->exists($swk->foto)) {
            Storage::disk('public')->delete($swk->foto);
        }

        $swk->delete();

        return redirect('/admin/admin_pum/adminswk')->with('success','Data berhasil dihapus');
    }

    public function getKelurahan($ID_KECAMATAN)
    {
        $kelurahan = Kelurahan::where('ID_KECAMATAN', $ID_KECAMATAN)->get();
        return response()->json($kelurahan);
    }

    // ================= FRONTEND =================
    public function swk(Request $request)
    {
        $query = Swk::with('kelurahan.kecamatan');

        if($request->search){
            $query->where(function($q) use ($request){
                $q->where('nama_swk','like','%'.$request->search.'%');
            });
        }

        // FILTER KECAMATAN
        if ($request->kecamatan_id) {
            $query->whereHas('kelurahan', function($q) use ($request) {
                $q->where('ID_KECAMATAN', $request->kecamatan_id);
            });
        }

        // FILTER KELURAHAN
        if ($request->kelurahan_id) {
            $query->where('kelurahan_id', $request->kelurahan_id);
        }

        $summaryQuery = clone $query;

        // ambil data SWK
        $data = $query->latest()->paginate(12)->withQueryString();

        // summary
        $summary = $summaryQuery->selectRaw('
            COUNT(*) as total_swk,
            SUM(jumlah_pedagang) as total_pedagang,
            SUM(jumlah_stan) as total_stan,
            SUM(stan_belum_terisi) as total_stan_kosong
        ')->first();

        // AJAX
        if ($request->ajax()) {
            return response()->json([
                'data' => $data,
                'summary' => $summary
            ]);
        }

        $kecamatan = Kecamatan::all();

        // kirim ke blade
        return view('bidang.pum.swk', [
            'swks' => $data,
            'kecamatan' => $kecamatan,
            'summary' => $summary
        ]);
    }

    // EXPORT EXCEL
    public function exportExcel(Request $request)
    {
        $query = Swk::with(['kelurahan.kecamatan']);

        // FILTER
        if($request->search){
            $query->where(function($q) use ($request){
                $q->where('nama_swk','like','%'.$request->search.'%');
            });
        }

        if ($request->kecamatan_id) {
            $query->whereHas('kelurahan', function ($q) use ($request) {
                $q->where('ID_KECAMATAN', $request->kecamatan_id);
            });
        }

        if ($request->kelurahan_id) {
            $query->where('kelurahan_id', $request->kelurahan_id);
        }

        $data = $query->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        if (ob_get_length()) {
            ob_end_clean();
        }

        // HEADER
        $headers = [
            'No',
            'Nama SWK',
            'Alamat',
            'Kecamatan',
            'Kelurahan',
            'Jumlah Pedagang',
            'Jumlah Stan',
            'Stan Belum Terisi',
            'peken',
            'Luas (m2)',
            'Kapasitas',
            'Latitude',
            'Longitude'
        ];

        $column = 'A';

        foreach ($headers as $header) {
            $sheet->setCellValue($column . '1', $header);
            $column++;
        }

        // DATA
        $row = 2;
        $no = 1;

        foreach ($data as $d) {

            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row,
                $d->nama_swk);
            
            $sheet->setCellValue('C' . $row,
                $d->alamat); 
            
            $sheet->setCellValue('D' . $row,
                $d->kelurahan->kecamatan->NM_KECAMATAN ?? '-');

            $sheet->setCellValue('E' . $row,
                $d->kelurahan->NM_KELURAHAN ?? '-');

            $sheet->setCellValue('F' . $row,
                $d->jumlah_pedagang);
            
            $sheet->setCellValue('G' . $row,
                $d->jumlah_stan);
            
            $sheet->setCellValue('H' . $row,
                $d->stan_belum_terisi);
            
            $sheet->setCellValue('I' . $row,
                $d->peken);

            $sheet->setCellValue('J' . $row,
                $d->luas);

            $sheet->setCellValue('K' . $row,
                $d->kapasitas);

            $sheet->setCellValue('L' . $row,
                $d->latitude);

            $sheet->setCellValue('M' . $row,
                $d->longitude);

            $row++;
        }

        // AUTO WIDTH
        foreach (range('A', 'M') as $col) {
            $sheet->getColumnDimension($col)
                ->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);

        $filename = 'data-swk.xlsx';

        return response()->streamDownload(
            function () use ($writer) {
                $writer->save('php://output');
            },
            $filename,
            [
                'Content-Type' =>
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ]
        );
    }
}