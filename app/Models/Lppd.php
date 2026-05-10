<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lppd extends Model
{
    protected $table = 'lppd';

    protected $fillable = [
        'kelurahan_id',
        'jumlah',
        'tahun',
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