<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Antrian;
use App\Models\DaftarLayanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

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

    public function index(){
        $tableName = 'daftar_layanans'; // Ganti dengan nama tabel yang Anda inginkan
        $columns = DB::getSchemaBuilder()->getColumnListing($tableName);

        // dd($columns);
        return Inertia::render('Admin/Antrian/Index', [
            'search' =>  Request::input('search'),
            'table_colums' => array_values(array_diff($columns, ['remember_token', 'password', 'email_verified_at', 'created_at', 'updated_at', 'user_id', 'hasil_pemeriksaan', 'id_layanan', 'id_pasien'])),
            'layanan' => DaftarLayanan::filterBySearch(Request::input('search'))
            ->filterByOrder(Request::input('order'))
            ->filterByRole(Request::input('order'))
            ->filterByDate(Request::input('date'))
            ->orderBy('status', 'asc')
            ->paginate(10),
            'can' => [
                'add' =>  false,
                'edit' =>  true,
                'show' =>  true,
                'delete' =>  false,
                'reset' =>  false,

            ]
        ]);
    }

    public function show(DaftarLayanan $daftarLayanan){
        return Inertia::render('Admin/Antrian/Show', [
            'layanan' => $daftarLayanan->find(Request::input('slug')),
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DaftarLayanan $daftarLayanan)
    {
        return Inertia::render('Admin/Antrian/Edit', [
            'layanan' => $daftarLayanan->find(Request::input('slug')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DaftarLayanan $daftarLayanan)
    {
        Request::validate(['slug'=> 'required|exists:daftar_layanans,id',
            'status'=> 'required',
            'jam_pemeriksaan'=> 'required',
        ]);
        $daftarLayanan = DaftarLayanan::find(Request::input('slug'))->update([
            'status'=> Request::input('status'),
            'jam_pemeriksaan'=> Request::input('jam_pemeriksaan'),
        ]);

        return redirect()->route("Admin.Antrian.index")->with("message", "Data Layanan Berhasil Di Ubah");
    }
}
