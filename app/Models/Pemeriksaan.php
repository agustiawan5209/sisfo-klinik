<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemeriksaan extends Model
{
    use HasFactory;
    protected $table = 'pemeriksaans';
    protected $fillable = [
        'id_layanan',
        'id_pendaftaran',
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

    public function scopeFilterBySearch($query, $search)
    {
        $query->when($search ?? null, function ($query, $search) {
            $query->where('nama_layanan', 'like', '%' . $search . '%')
            ->orWhere('nama_pasien', 'like', '%' . $search . '%')
            ->orWhere('nama_petugas', 'like', '%' . $search . '%')
            ->orWhere('tgl_pemeriksaan', 'like', '%' . $search . '%');
        });
    }

    public function scopeFilterByOrder($query, $order)
    {
        $query->when($order ?? null, function ($query, $order) {
            $query->orderBy('id', $order);
        });
    }
    public function scopeFilterByDate($query, $date)
    {
        $query->when($date ?? null, function ($query, $date) {
            $query->whereDate('tgl_pemeriksaan', $date);
        });
    }

    public function scopeFilterByRole($query, $role)
    {
        // $query->when(Auth::user()->hasRole('Pasien'), function ($query, $role) {
        //     $query->where('id_pasien', Auth::user()->pasien->id);
        // });
    }
}
