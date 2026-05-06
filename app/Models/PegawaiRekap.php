<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PegawaiRekap extends Model
{
    protected $table = 'pegawai_rekap';

    protected $fillable = [
        'status',
        'pendidikan',
        'bidang', // <--- TAMBAHKAN INI
        'jumlah'
    ];
}