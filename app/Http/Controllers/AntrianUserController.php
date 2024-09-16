<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Antrian;
use App\Models\DaftarLayanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AntrianUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tableName = 'daftar_layanans'; // Ganti dengan nama tabel yang Anda inginkan
        $columns = DB::getSchemaBuilder()->getColumnListing($tableName);

        // dd($columns);
        return Inertia::render('User/Antrian/Index', [
            'search' =>  Request::input('search'),
            'table_colums' => array_values(array_diff($columns, ['remember_token', 'password', 'email_verified_at', 'created_at', 'updated_at', 'user_id', 'hasil_pemeriksaan', 'id_layanan', 'id_pasien'])),
            'layanan' => DaftarLayanan::filter(Request::only('search', 'order'))
            ->paginate(10),
            // 'can' => [
            //     'add' => Auth::user()->can('add pasien'),
            //     'edit' => Auth::user()->can('edit pasien'),
            //     'show' => Auth::user()->can('show pasien'),
            //     'delete' => Auth::user()->can('delete pasien'),
            //     'reset' => Auth::user()->can('reset pasien'),

            // ]
        ]);
    }
    public function cetakAntrian($id)
    {
        return Inertia::render('User/Antrian/Cetak', [
            'layanan' => DaftarLayanan::find($id),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Antrian $antrian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Antrian $antrian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Antrian $antrian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Antrian $antrian)
    {
        //
    }
}
