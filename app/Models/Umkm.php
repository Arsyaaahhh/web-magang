<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $table = 'umkm';

    protected $fillable = [
        'kelurahan_id',
        'total_umkm',
        'umkm_binaan',
        'sertifikasi_halal',
        'sertifikasi_merek',
        'nib',
        'peken',
        'padat_karya'
    ];

    public function kelurahan()
    {
        return $this->belongsTo(
            Kelurahan::class,
            'kelurahan_id',
            'ID_KELURAHAN'
        );
    }
}