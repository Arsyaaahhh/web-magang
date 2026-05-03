<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';

    protected $fillable = [
        'NM_KECAMATAN'
    ];

    protected $primaryKey = 'ID_KECAMATAN';

    // Relasi ke kelurahan
    public function kelurahan()
    {
        return $this->hasMany(Kelurahan::class);
    }
}