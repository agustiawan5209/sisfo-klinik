<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\DaftarLayanan;
use App\Http\Controllers\Controller;

class GrafikController extends Controller
{
    public function allAntrian()
    {
        $jadwal = DaftarLayanan::all();
        $data = [];
        $tanggal = [];

        foreach ($jadwal as $key => $value) {
            $data[] = [
                'tanggal' => $value->tgl,
                'deskripsi' => $value->nama_pasien,
            ];
            $tanggal[] = $value->tgl;
        }

        return [
            'data' => $data,
            'tanggal' => array_values(array_unique($tanggal)),
        ];
    }
}
