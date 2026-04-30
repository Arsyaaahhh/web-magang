<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembinaan extends Model
{
    protected $table = 'data_pembinaan';

    protected $fillable = [
        'nama_usaha',
        'jenis',
        'sub_jenis',
        'alamat',
        'tahun',
        'keterangan'
    ];
}