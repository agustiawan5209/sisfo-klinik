<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pasien extends Model
{
    use HasFactory;

    protected $tables = 'pasiens';
    protected $fillable = [
        'user_id',
        'id_pasien',
        'alamat',
        'no_telpon',
        'tgl_lahir',
        'tgl_pendaftaran',
    ];


    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function daftarlayanan()
    {
        return $this->hasMany(DaftarLayanan::class, 'id_pasien', 'id');
    }

    protected $appends = [
        'nama_pasien',
    ];

    public function namaPasien(): Attribute
    {
        return new Attribute(
            get: fn() => $this->user()->first()->name,
        );
    }

    //  FIlter Data User
    public function scopeFilter($query, $filter)
    {
        $query->when($filter['search'] ?? null, function ($query, $search) {
            $query->where('no_telpon', 'like', '%' . $search . '%')
                ->orWhereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereDate('tgl_pendaftaran', 'like', '%' . $search . '%');
        })->when($filter['order'] ?? null, function ($query, $order) {
            $query->orderBy('id', $order);
        });
    }
}
