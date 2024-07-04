<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

     //  Filter Data
     public function scopeFilter($query, $filter)
     {
         $query->when($filter['search'] ?? null, function ($query, $search) {
             $query->where('nama_layanan', 'like', '%' . $search . '%')
                 ->orWhere('nomor_antrian', 'like', '%' . $search . '%');
         })->when($filter['order'] ?? null, function ($query, $order) {
             $query->orderBy('id', $order);
         })->where('id_pasien', Auth::user()->pasien->id);
     }
}
