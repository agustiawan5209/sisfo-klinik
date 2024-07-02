<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarLayanan extends Model
{
    use HasFactory;

    protected $table = 'daftar_layanans';
    protected $fillable = [
        'id_pasien',
        'nama_pasien',
        'id_layanan',
        'nama_layanan',
        'nomor_antrian',
        'tgl',
        'status',
    ];
}
