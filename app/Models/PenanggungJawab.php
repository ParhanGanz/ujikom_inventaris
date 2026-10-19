<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenanggungJawab extends Model
{
    protected $table = 'penanggung_jawab';

    protected $fillable = [
        'nip_nutpk',
        'nama_lengkap',
        'jabatan',
        'id_lokasi',
        'no_telepon',
        'email',
        'status',
    ];

    /**
     * Setiap penanggung jawab memiliki satu lokasi.
     */
    public function lokasi(): BelongsTo
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi');
    }
}