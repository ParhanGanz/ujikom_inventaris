<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PenanggungJawab extends Model
{
    use HasFactory;

    protected $table = 'penanggung_jawab';

    protected $fillable = [
        'nip_nutpk',
        'nama_lengkap',
        'jabatan',
        'no_telepon',
        'email',
        'status',
    ];

    protected $attributes = [
        'status' => 'aktif',
    ];

    public function lokasi(): HasMany
    {
        return $this->hasMany(
            Lokasi::class,
            'id_penanggung_jawab'
        );
    }
}
