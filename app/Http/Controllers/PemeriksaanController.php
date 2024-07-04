<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Pasien;
use App\Models\Layanan;
use App\Models\Pemeriksaan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StorePemeriksaanRequest;
use App\Http\Requests\UpdatePemeriksaanRequest;
use App\Models\DaftarLayanan;
use Carbon\Carbon;

class PemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tableName = 'pemeriksaans'; // Ganti dengan nama tabel yang Anda inginkan
        $columns = DB::getSchemaBuilder()->getColumnListing($tableName);

        // dd($columns);
        return Inertia::render('Admin/Pemeriksaan/Index', [
            'search' =>  Request::input('search'),
            'table_colums' => array_values(array_diff($columns, ['remember_token', 'password', 'email_verified_at', 'created_at', 'updated_at', 'user_id', 'hasil_pemeriksaan','id_layanan','id_pasien'])),
            'data' => Pemeriksaan::filter(Request::only('search', 'order'))->paginate(10),
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
        return Inertia::render('Admin/Pemeriksaan/Form', [
            'layanan'=> Layanan::all(),
            'pasien'=> Pasien::with(['user'])->get(),
            'pendaftaran'=> DaftarLayanan::whereDate('tgl', Carbon::now()->format('Y-m-d'))->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePemeriksaanRequest $request)
    {
        // $pasien = Pasien::with(['user'])->find($request->id_pasien);
        // $layanan = Layanan::find($request->id_layanan);

        $pemeriksaan = Pemeriksaan::create($request->all());
        return redirect()->route('Pemeriksaan.index')->with('message', 'Data Pasien Berhasil Di Simpan!!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Pemeriksaan $pemeriksaan)
    {
        return Inertia::render('Admin/Pemeriksaan/Show', [
            'pemeriksaan' => Pemeriksaan::find(Request::input('slug')),
            'layanan'=> Layanan::all(),
            'pasien'=> Pasien::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemeriksaan $pemeriksaan)
    {
        return Inertia::render('Admin/Pemeriksaan/Edit', [
            'pemeriksaan' => Pemeriksaan::find(Request::input('slug')),
            'layanan'=> Layanan::all(),
            'pasien'=> Pasien::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePemeriksaanRequest $request, Pemeriksaan $pemeriksaan)
    {
        $pemeriksaan = Pemeriksaan::find(Request::input('slug'))->update($request->all());
        return redirect()->route('Pemeriksaan.index')->with('message', 'Data Pasien Berhasil Di Simpan!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemeriksaan $pemeriksaan)
    {
        $pemeriksaan = Pemeriksaan::find(Request::input('slug'))->delete();
        return redirect()->route('Pemeriksaan.index')->with('message', 'Data Pasien Berhasil Di Hapus!!');
    }
}
