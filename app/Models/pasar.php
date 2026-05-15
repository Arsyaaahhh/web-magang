<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasar extends Model
{
    protected $table = 'pasar';

    protected $fillable = [
        'nama_pasar',
        'alamat',
        'kelurahan_id',
        'jumlah_pedagang',
        'jumlah_stan',
        'stan_belum_terisi',
        'luas',
        'foto',
        'kapasitas',
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