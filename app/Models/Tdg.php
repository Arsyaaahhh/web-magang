<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tdg extends Model
{
    protected $fillable = [
    'nama_usaha',
    'pemilik',
    'alamat',
    'nama_gudang',
    'lokasi_gudang',
    'nomor_tdg',
    'tanggal_terbit',
    'status'
];
}
