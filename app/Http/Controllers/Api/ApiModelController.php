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
use App\Models\Pemeriksaan;
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

    public function getJumlahPengguna($tahun = '2024')
    {
        // Mendapatkan tanggal saat ini
        $now = Carbon::now();

        // Mendapatkan 12 bulan terakhir dari sekarang
        $last12Months = [];
        for ($i = 0; $i < 12; $i++) {
            $last12Months[] = $now->copy()->subMonths($i);
        }
        $data = [];
        $months = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
        foreach ($months as $key => $value) {
            $data[] = Pemeriksaan::whereYear('created_at', '=', $tahun)->whereMonth('created_at', '=', $key)->count();
        }
        return [
            'data' => $data,
            'label' => array_values(array_unique($months)),
        ];
    }
}
