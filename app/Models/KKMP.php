<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KKMP extends Model
{
    protected $table = 'kkmp';

    protected $fillable = [
        'ID_KECAMATAN',
        'ID_KELURAHAN',
        'nama_kkmp',
        'no_badan_hukum',
        'tahun',
        'alamat',
        'jenis_kkmp',
        'jumlah_anggota',
        'total_omzet',
    ];

    public $timestamps = true;

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'ID_KECAMATAN');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'ID_KELURAHAN');
    }
}
