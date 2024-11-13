<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Pasien;
use App\Models\Antrian;
use App\Models\Layanan;
use App\Models\DaftarLayanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreDaftarLayananRequest;
use App\Http\Requests\UpdateDaftarLayananRequest;
use App\Models\JamPelayanan;

class DaftarLayananController extends Controller
{
    /**
     * success
     * @return void
     */
    public function success()
    {
        return Inertia::render('User/Success');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tableName = 'layanans'; // Ganti dengan nama tabel yang Anda inginkan
        $columns = DB::getSchemaBuilder()->getColumnListing($tableName);

        // dd($columns);
        return Inertia::render('User/Layanan/Index', [
            'search' =>  Request::input('search'),
            'table_colums' => array_values(array_diff($columns, ['remember_token', 'password', 'email_verified_at', 'created_at', 'updated_at', 'user_id', 'hasil_pemeriksaan', 'id_layanan', 'id_pasien'])),
            'layanan' => Layanan::filter(Request::only('search', 'order'))->paginate(10),
            'can' => [
                'add' => Auth::user()->can('add pasien'),
                'edit' => Auth::user()->can('edit pasien'),
                'show' => Auth::user()->can('show pasien'),
                'delete' => Auth::user()->can('delete pasien'),
                'reset' => Auth::user()->can('reset pasien'),

            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDaftarLayananRequest $request)
    {
        try {
            $tgl = $request->tgl;
            $antrian = new AntrianController();

            $jampelayanan = JamPelayanan::where('jam', $request->jam_pelayanan)->first();
            $nomor_antrian = $jampelayanan->no_antrian;

            $data_antrian = $antrian->createAntrian($nomor_antrian);
            $pasien = Pasien::with(['user'])->where('user_id', Auth::user()->id)->first();

            $daftarLayanan = DaftarLayanan::create([
                'id_pasien' => $pasien->id,
                'nama_pasien' => $pasien->user->name . '|'. $pasien->id_pasien,
                'id_layanan' => $request->id_layanan,
                'nama_layanan' => $request->nama_layanan,
                'nomor_antrian' => $nomor_antrian,
                'tgl' => $tgl,
                'jam_pemeriksaan'=> $request->jam_pelayanan,
                'status' => '0',
            ]);

            return redirect()->route("User.Layanan.success")->with("message", "Data Layanan Berhasil Di Daftarkan");
        } catch (\Throwable $th) {
            return redirect()->back()->with("message", $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DaftarLayanan $daftarLayanan)
    {
        return Inertia::render('User/Layanan/Show', [
            'layanan' => $daftarLayanan->find(Request::input('slug')),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DaftarLayanan $daftarLayanan)
    {
        return Inertia::render('User/Layanan/Edit', [
            'layanan' => $daftarLayanan->find(Request::input('slug')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDaftarLayananRequest $request, DaftarLayanan $daftarLayanan)
    {
        $daftarLayanan = DaftarLayanan::create($request->all());

        return redirect()->route("User.Layanan.success")->with("message", "Data Layanan Berhasil Di Ubah");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DaftarLayanan $daftarLayanan)
    {
        $daftarLayanan = DaftarLayanan::find(Request::input('slug'));

        return redirect()->route("User.Layanan.success")->with("message", "Data Layanan Berhasil Di Hapus");
    }
}
