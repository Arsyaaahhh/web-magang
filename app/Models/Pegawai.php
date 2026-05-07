<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawais';

    protected $fillable = [
        'jumlah_pegawai',
        'status',
        'program',
    ];

    public $timestamps = true;
}