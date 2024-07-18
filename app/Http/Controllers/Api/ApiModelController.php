<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Balita;
use App\Models\OrangTua;
use App\Models\JadwalImunisasi;
use App\Models\RiwayatImunisasi;
use App\Http\Controllers\Controller;
use App\Models\DaftarLayanan;
use App\Models\Layanan;
use App\Models\Puskesmas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ApiModelController extends Controller
{

    /**
     * getUser
     *
     * @return void
     */
    public function getUser()
    {
        $search = Request::input('search');

        $user = User::filter($search)->role('Kader')->get();

        return json_encode($user);
    }

    public function getJadwal()
    {
        $user_id = User::find(Request::input('user'))->pasien->id;
        $jadwal = DaftarLayanan::where('id_pasien', $user_id)->get();
        $data = [];
        $tanggal = [];

        foreach ($jadwal as $key => $value) {
            $data[] = [
                'tanggal' => $value->tgl,
                'deskripsi' => $value->nama_layanan,
            ];
            $tanggal[] = $value->tgl;
        }

        return [
            'data' => $data,
            'tanggal' => array_values(array_unique($tanggal)),
            'pasien'=> Auth::user()
        ];
    }

    public function getLayanan($id)
    {
        try {
            $layanan = Layanan::find($id);

            return response($layanan, 200);
        } catch (\Throwable $th) {
            return response("Error :". $th->getMessage(),500);
        }
    }
    public function getPendaftaran($id)
    {
        try {
            $layanan = DaftarLayanan::find($id);

            return response($layanan, 200);
        } catch (\Throwable $th) {
            return response("Error :". $th->getMessage(),500);
        }
    }
}