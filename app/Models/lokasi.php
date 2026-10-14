<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit jika berbeda dari konvensi plural bahasa Inggris
    protected $table = 'lokasi';

    // Kolom yang diizinkan untuk diisi secara massal (Mass Assignment)
    protected $fillable = [
        'kode',
        'ruangan',
        'keterangan',
        'penanggung_jawab',
    ];
}