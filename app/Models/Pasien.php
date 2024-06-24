<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $tables = 'pasiens';
    protected $fillable = [
        'user_id',
        'alamat',
        'no_telpon',
        'tgl_lahir',
    ];

     //  FIlter Data User
     public function scopeFilter($query, $filter)
     {
         $query->when($filter['search'] ?? null, function ($query, $search) {
             $query->where('alamat', 'like', '%' . $search . '%')
                 ->orWhere('no_telpon', 'like', '%' . $search . '%')
                 ->orWhereDate('tgl_lahir', 'like', '%' . $search . '%');
         })->when($filter['order'] ?? null, function ($query, $order) {
             $query->orderBy('id', $order);
         });
     }

     public function user(){
        return $this->hasOne(User::class,'id','user_id');
     }
}
