<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengawasan extends Model
{
    // Tambahkan ini:
    protected $fillable = ['jenis_pengawasan', 'kecamatan', 'tahun', 'jumlah'];
}