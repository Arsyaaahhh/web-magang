<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetrologiAlat extends Model
{
    protected $table = 'metrologi_alats';
    protected $fillable = ['tahun', 'jumlah'];
}