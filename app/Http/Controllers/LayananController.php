<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Layanan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreLayananRequest;
use App\Http\Requests\UpdateLayananRequest;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tableName = 'layanans'; // Ganti dengan nama tabel yang Anda inginkan
        $columns = DB::getSchemaBuilder()->getColumnListing($tableName);

        // dd($columns);
        return Inertia::render('Admin/Layanan/Index', [
            'search' =>  Request::input('search'),
            'table_colums' => array_values(array_diff($columns, ['remember_token', 'password', 'email_verified_at', 'created_at', 'updated_at', 'user_id', 'deskripsi'])),
            'data' => Layanan::filter(Request::only('search', 'order'))->paginate(10),
            'can' => [
                'add' => true,
                'edit' => true,
                'show' => false,
                'delete' => true,
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Layanan/Form', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLayananRequest $request)
    {
        $data = $request->all();
        // Mendapatkan ID terakhir
        $lastId = Layanan::max('id') + 1;

        // Membuat kode transaksi dengan format yang diinginkan
        $id_layanan = 'LN-' . str_pad($lastId, 3, '0', STR_PAD_LEFT);
        $data['id_layanan'] = $id_layanan;
        $layanan = Layanan::create($data);
        return redirect()->route('Layanan.index')->with('message', 'Data Layanan Berhasil Di Simpan!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Layanan $layanan)
    {
        return Inertia::render('Admin/Layanan/Show', [
            'layanan' => Layanan::find(Request::input('slug'))
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Layanan $layanan)
    {
        return Inertia::render('Admin/Layanan/Edit', [
            'layanan' => Layanan::find(Request::input('slug'))
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLayananRequest $request, Layanan $layanan)
    {
        $layanan = Layanan::find(Request::input('slug'));
        $layanan->update($request->all());

        return redirect()->route('Layanan.index')->with('message', 'Data Layanan Berhasil Di Ubah!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Layanan $layanan)
    {
        $layanan = Layanan::find(Request::input('slug'));
        $layanan->delete();
        return redirect()->route('Layanan.index')->with('message', 'Data Layanan Berhasil Di Hapus!!');
    }
}
