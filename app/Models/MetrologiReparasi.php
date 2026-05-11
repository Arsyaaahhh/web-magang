<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetrologiReparasi extends Model
{
    protected $table = 'metrologi_reparasis';
    protected $fillable = ['tahun', 'kecamatan', 'jumlah'];
}
