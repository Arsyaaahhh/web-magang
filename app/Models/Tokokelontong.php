<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tokokelontong extends Model
{
    protected $table = 'toko_kelontong';

    protected $fillable = [
        'kelurahan_id',
        'total_toko',
        'peken',
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