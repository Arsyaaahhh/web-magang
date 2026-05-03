<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tdg extends Model
{
    // Hanya mengizinkan mass-assignment untuk tahun dan jumlah
    protected $fillable = [
        'tahun',
        'jumlah'
    ];
}