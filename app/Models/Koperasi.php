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
        'status_rat',
        'status_lpj',
        'total_pengawasan',
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
