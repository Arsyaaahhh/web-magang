<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PegawaiRekap extends Model
{
    protected $table = 'pegawai_rekap';

    // BAGIAN INI SANGAT PENTING
    protected $fillable = [
        'status',
        'pendidikan',
        'bidang',
        'jumlah',
        'pangkat_golongan' // <--- Pastikan baris ini tertulis!
    ];
}