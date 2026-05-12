<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekapMagang extends Model
{
    protected $fillable = ['tahun', 'bulan', 'jumlah'];
}