<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sentrausaha extends Model
{
    protected $table = 'sentra_usaha';

    protected $fillable = [
        'nama_sentrausaha',
        'alamat',
        'kelurahan_id',
        'luas',
        'foto',
        'kapasitas',
        'latitude',
        'longitude',
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