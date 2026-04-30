<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    protected $fillable = [
    'email',
    'nama',
    'nim',
    'asal_univ',
    'alamat',
    'kelurahan',
    'kecamatan',
    'no_hp',
    'awal_pelaksanaan',
    'akhir_pelaksanaan',
    'durasi',
    'kepemilikan_r2',
    'bidang',
    'posisi'
];
}
