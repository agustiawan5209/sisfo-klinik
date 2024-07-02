<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;
    protected $table = 'pemeriksaans';
    protected $fillable = [
        'id_layanan',
        'id_pasien',
        'nama_petugas',
        'hasil_pemeriksaan',
        'tgl_pemeriksaan',
    ];
}
