<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Koperasi extends Model
{
    protected $table = 'koperasis';

    protected $fillable = [
        'jumlah',
        'aktif',
        'tidak_aktif',
        'bermitra',
        'mitra_perbankan',
        'tahun',
        'ID_KECAMATAN',
        'ID_KELURAHAN',
        'padat_karya',
        'lpj_lengkap',
        'pelaksanaan_rat',
    ];

    protected $casts = [
        'jumlah' => 'integer',
        'aktif' => 'integer',
        'tidak_aktif' => 'integer',
        'bermitra' => 'integer',
        'mitra_perbankan' => 'integer',
        'padat_karya' => 'integer',
        'lpj_lengkap' => 'integer',
        'pelaksanaan_rat' => 'integer',
        'tahun' => 'integer',
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