<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'jam_pemeriksaan',
        'tgl',
        'status',
    ];

    protected $appends = [
        'status_layanan',
    ];

    public function statusLayanan(): Attribute
    {
        $value = '';
        switch ($this->status) {
            case '0' || 0:
                $value = 'Butuh Konfirmasi';
                break;
            case '1' || 1:
                $value = 'Sudah di Konfirmasi';
                break;
            case '2' || 2:
                $value = 'Selesai';
                break;

            default:
                $value = 'Butuh Konfirmasi';

                break;
        }
        return new Attribute(
            get: fn()=> $value,
        );
    }
    //  Filter Data
    public function scopeFilter($query, $filter)
    {
        $query->when($filter['search'] ?? null, function ($query, $search) {
            $query->where('nama_layanan', 'like', '%' . $search . '%')
                ->orWhere('nomor_antrian', 'like', '%' . $search . '%');
        })->when($filter['order'] ?? null, function ($query, $order) {
            $query->orderBy('id', $order);
        })->when(Auth::user()->hasRole('Pasien'), function ($query, $trashed) {
            $query->where('id_pasien', Auth::user()->pasien->id);
        });
    }
}
