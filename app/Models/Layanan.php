<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanans';
    protected $fillable = [
        'id_layanan',
        'nama_layanan',
        'keterangan',
        'harga',
    ];

     //  FIlter Data User
     public function scopeFilter($query, $filter)
     {
         $query->when($filter['search'] ?? null, function ($query, $search) {
             $query->where('nama_layanan', 'like', '%' . $search . '%')
                 ->orWhere('id_layanan', 'like', '%' . $search . '%');
         })->when($filter['order'] ?? null, function ($query, $order) {
             $query->orderBy('id_layanan', $order);
         });
     }
}
