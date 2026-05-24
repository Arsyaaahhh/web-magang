<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umkm;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class UmkmController extends Controller
{
    // ================= ADMIN =================
    public function index(Request $request)
    {
        $query = Umkm::with('kelurahan.kecamatan');

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

        // FILTER KATEGORI
        if($request->kategori){
            $query->where('kategori', strtoupper($request->kategori));
        }

        $data = $query->latest()->paginate(10)->withQueryString();
        $kecamatan = Kecamatan::all();

        // Path view sudah disesuaikan ke dalam folder umkm
        return view('admin.admin_pum.umkm.adminumkm', compact(
            'data',
            'kecamatan'
        ));
    }

    public function create()
    {
        $kecamatan = Kecamatan::all();
        $kelurahan = collect(); 
        
        // Path view sudah disesuaikan ke dalam folder umkm
        return view('admin.admin_pum.umkm.umkmcreate', compact('kecamatan', 'kelurahan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelurahan_id'      => 'required',
            'total_umkm'        => 'required|numeric',
            'umkm_binaan'       => 'required|numeric',
            'sertifikasi_halal' => 'required|numeric',
            'sertifikasi_merek' => 'required|numeric',
            'nib'               => 'required|numeric',
            'peken'             => 'required|numeric',
            'padat_karya'       => 'required|numeric',
        ]);

        Umkm::create($request->all());

        return redirect('/admin/admin_pum/adminumkm')->with('success','Data UMKM berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Umkm::with(['kelurahan.kecamatan'])->findOrFail($id);
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::where('ID_KECAMATAN', $data->kelurahan->ID_KECAMATAN ?? null)->get();

        // Path view sudah disesuaikan ke dalam folder umkm
        return view('admin.admin_pum.umkm.umkmedit', compact('data', 'kecamatan', 'kelurahan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kelurahan_id'      => 'required',
            'total_umkm'        => 'required|numeric',
            'umkm_binaan'       => 'required|numeric',
            'sertifikasi_halal' => 'required|numeric',
            'sertifikasi_merek' => 'required|numeric',
            'nib'               => 'required|numeric',
            'peken'             => 'required|numeric',
            'padat_karya'       => 'required|numeric',
        ]);

        $data = Umkm::findOrFail($id);
        $data->update($request->all());

        return redirect('/admin/admin_pum/adminumkm')->with('success','Data UMKM berhasil diperbarui');
    }

    public function destroy($id)
    {
        $umkm = Umkm::findOrFail($id);
        $umkm->delete();

        return redirect('/admin/admin_pum/adminumkm')->with('success','Data berhasil dihapus');
    }

    public function getKelurahan($ID_KECAMATAN)
    {
        $kelurahan = Kelurahan::where('ID_KECAMATAN', $ID_KECAMATAN)->get();
        return response()->json($kelurahan);
    }

    // ================= FRONTEND =================
    public function umkm(Request $request)
    {
        $query = Umkm::with('kelurahan.kecamatan');

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

        // FILTER KATEGORI
        if($request->kategori){
            $query->where('kategori', strtoupper($request->kategori));
        }

        $summaryQuery = clone $query;

        // ambil data Umkm
        $data = $query->latest()->paginate(10)->withQueryString();

        $summary = $summaryQuery->selectRaw('
            SUM(total_umkm) as total_umkm,
            SUM(umkm_binaan) as umkm_binaan,
            SUM(sertifikasi_halal) as sertifikasi_halal,
            SUM(sertifikasi_merek) as sertifikasi_merek,
            SUM(nib) as nib,
            SUM(peken) as peken,
            SUM(padat_karya) as padat_karya,
            SUM(pirt) as pirt
        ')->first();

        if ($request->ajax()) {
            return response()->json([
                'data' => $data,
                'summary' => $summary
            ]);
        }

        $kecamatan = Kecamatan::all();

        // kirim ke blade
        return view('bidang.pum.umkm', [
            'data' => $data,
            'kecamatan' => $kecamatan,
            'summary' => $summary
        ]);
    }

    // EXPORT EXCEL
    public function exportExcel(Request $request)
    {
        $query = Umkm::with(['kelurahan.kecamatan']);

        // FILTER
        if ($request->kecamatan_id) {
            $query->whereHas('kelurahan', function ($q) use ($request) {
                $q->where('ID_KECAMATAN', $request->kecamatan_id);
            });
        }

        if ($request->kelurahan_id) {
            $query->where('kelurahan_id', $request->kelurahan_id);
        }

        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
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
            'Kecamatan',
            'Kelurahan',
            'Kategori',
            'Total UMKM',
            'UMKM Binaan',
            'NIB',
            'PIRT',
            'Sertifikasi Halal',
            'Sertifikasi Merek',
            'Peken',
            'Padat Karya'
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
                $d->kelurahan->kecamatan->NM_KECAMATAN ?? '-');

            $sheet->setCellValue('C' . $row,
                $d->kelurahan->NM_KELURAHAN ?? '-');

            $sheet->setCellValue('D' . $row,
                $d->kategori);

            $sheet->setCellValue('E' . $row,
                $d->total_umkm);

            $sheet->setCellValue('F' . $row,
                $d->umkm_binaan);

            $sheet->setCellValue('G' . $row,
                $d->nib);

            $sheet->setCellValue('H' . $row,
                $d->pirt);

            $sheet->setCellValue('I' . $row,
                $d->sertifikasi_halal);

            $sheet->setCellValue('J' . $row,
                $d->sertifikasi_merek);

            $sheet->setCellValue('K' . $row,
                $d->peken);

            $sheet->setCellValue('L' . $row,
                $d->padat_karya);

            $row++;
        }

        // AUTO WIDTH
        foreach (range('A', 'L') as $col) {
            $sheet->getColumnDimension($col)
                ->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);

        $filename = 'data-umkm.xlsx';

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