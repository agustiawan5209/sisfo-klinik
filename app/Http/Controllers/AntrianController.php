<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AntrianController extends Controller
{
    public function generateNomorAntrian($tgl)
    {
        $max_antrian = Antrian::select(['nomor_antrian'])->whereDate('created_at', $tgl)->orderBy('id', 'desc')->first();
        // dd($max_antrian);
        if ($max_antrian == null) {
            $nomor = 1;
        } else {
            $nomor = intval($max_antrian->nomor_antrian) + 1;
        }

        $nomor_antrian = str_pad($nomor, 2, "0", STR_PAD_LEFT);
        return $nomor_antrian;
    }

    public function createAntrian($nomor){
        $antrian = Antrian::create([
            'user_id'=> Auth::user()->id,
            'nomor_antrian'=> $nomor,
            'tanggal'=> Carbon::now()->format('Y-m-d'),
        ]);

        return $antrian;
    }
}
