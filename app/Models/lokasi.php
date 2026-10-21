<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lokasi extends Model
{
    protected $table = 'lokasi';

    protected $fillable = [
        'kode',
        'ruangan',
        'id_penanggung_jawab',
        'keterangan',
    ];

    public function penanggungJawab(): BelongsTo
    {
        return $this->belongsTo(
            PenanggungJawab::class,
            'id_penanggung_jawab'
        );
    }
}