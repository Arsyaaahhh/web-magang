<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Swk extends Model
{
    protected $table = 'swk';

    protected $fillable = [
        'nama_swk',
        'alamat',
        'kelurahan_id',
        'jumlah_pedagang',
        'jumlah_stan',
        'stan_belum_terisi',
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