<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Koperasi extends Model
{
    protected $table = 'koperasis';

    protected $fillable = [
        'jumlah',
        'status',
        'tahun',
        'status_mitra',
        'jenis_mitra',
        'ID_KECAMATAN',
        'ID_KELURAHAN',
        'padat_karya',
        'status_lpj',
        'pelaksanaan_rat',
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
