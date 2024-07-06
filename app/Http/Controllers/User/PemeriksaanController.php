<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use App\Models\Pasien;
use App\Models\Layanan;
use App\Models\Pemeriksaan;
use App\Models\DaftarLayanan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class PemeriksaanController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tableName = 'daftar_layanans'; // Ganti dengan nama tabel yang Anda inginkan
        $columns = DB::getSchemaBuilder()->getColumnListing($tableName);

        // dd($columns);
        return Inertia::render('User/Pemeriksaan/Index', [
            'search' =>  Request::input('search'),
            'table_colums' => array_values(array_diff($columns, ['remember_token', 'password', 'email_verified_at', 'created_at', 'updated_at', 'user_id', 'hasil_pemeriksaan', 'id_layanan', 'id_pasien'])),
            'pemeriksaan' => Pemeriksaan::filter(Request::only('search', 'order'))->where('id_pasien', Auth::user()->pasien->id)->paginate(10),
            // 'can' => [
            //     'add' => Auth::user()->can('add pasien'),
            //     'edit' => Auth::user()->can('edit pasien'),
            //     'show' => Auth::user()->can('show pasien'),
            //     'delete' => Auth::user()->can('delete pasien'),
            //     'reset' => Auth::user()->can('reset pasien'),

            // ]
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
    public function show(Pemeriksaan $pemeriksaan)
    {
        return Inertia::render('User/Pemeriksaan/Show', [
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemeriksaan $pemeriksaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemeriksaan $pemeriksaan)
    {
        //
    }
}
