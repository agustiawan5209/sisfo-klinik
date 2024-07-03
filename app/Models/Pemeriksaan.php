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
        'nama_layanan',
        'id_pasien',
        'nama_pasien',
        'nama_petugas',
        'hasil_pemeriksaan',
        'tgl_pemeriksaan',
    ];

    /**
     * scopeFilter
     *
     * @param  mixed $query
     * @param  mixed $filter
     * @return void
     */
    public function scopeFilter($query, $filter)
     {
         $query->when($filter['search'] ?? null, function ($query, $search) {
             $query->where('nama_layanan', 'like', '%' . $search . '%')
                 ->orWhere('nama_pasien', 'like', '%' . $search . '%')
                 ->orWhere('nama_petugas', 'like', '%' . $search . '%')
                 ->orWhere('tgl_pemeriksaan', 'like', '%' . $search . '%');
         })->when($filter['order'] ?? null, function ($query, $order) {
             $query->orderBy('id', $order);
         });
     }
}
