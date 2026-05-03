<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $table = 'kelurahan';

    protected $fillable = [
        'ID_KECAMATAN',
        'NM_KELURAHAN'
    ];

    protected $primaryKey = 'ID_KELURAHAN';

    // Relasi ke kecamatan
    public function kecamatan()
    {
        return $this->belongsTo(
            Kecamatan::class,
            'ID_KECAMATAN',
            'ID_KECAMATAN'
        );
    }

    // Relasi ke UMKM (opsional tapi disarankan)
    public function umkm()
    {
        return $this->hasMany(Umkm::class);
    }
}