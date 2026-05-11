<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penelitian extends Model
{
    protected $table = 'penelitians';
    
    // Ganti status jadi tahun
    protected $fillable = ['nama', 'univ', 'judul', 'tahun'];
}