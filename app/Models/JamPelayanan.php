<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamPelayanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'jam', 'no_antrian'
    ];

    public function scopeFilterBySearch($query, $search)
    {
        $query->when($search ?? null, function ($query, $search) {
            $query->where('jam', 'like', '%' . $search . '%');
        });
    }
    public function scopeFilterByOrder($query, $order)
    {
        $query->when($order ?? null, function ($query, $order) {
            $query->orderBy('id', $order);
        });
    }

}
