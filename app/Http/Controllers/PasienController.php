<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Pasien;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StorePasienRequest;
use App\Http\Requests\UpdatePasienRequest;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tableName = 'pasiens'; // Ganti dengan nama tabel yang Anda inginkan
        $columns = DB::getSchemaBuilder()->getColumnListing($tableName);

        return Inertia::render('Admin/Pasien/Index', [
            'search' =>  Request::input('search'),
            'table_colums' => array_values(array_diff($columns, ['remember_token', 'password', 'email_verified_at', 'created_at', 'updated_at', 'user_id', 'deskripsi'])),
            'data' => Pasien::filter(Request::only('search', 'order'))->paginate(10),
            'can' => [
                'add' => Auth::user()->can('add pasien'),
                'edit' => Auth::user()->can('edit pasien'),
                'show' => Auth::user()->can('show pasien'),
                'delete' => Auth::user()->can('delete pasien'),
                'reset' => Auth::user()->can('reset staff'),

            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Pasien/Form', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePasienRequest $request)
    {
        $pasien = new Pasien([
            'user_id' => Auth::id(),
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_telepon' => $request->no_telepon,
        ]);
        $pasien->save();

        return redirect()->route('Pasien.index')->with('message', 'Data Pasien Berhasil Di Simpan!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pasien $pasien)
    {
        return Inertia::render('Admin/Pasien/Show', [
            'pasien' => Pasien::with(['user'])->find(Request::input('slug'))
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pasien $pasien)
    {
        return Inertia::render('Admin/Pasien/Edit', [
            'pasien' => Pasien::with(['user'])->find(Request::input('slug'))
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePasienRequest $request, Pasien $pasien)
    {
        $pasien = new Pasien([
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_telepon' => $request->no_telepon,
        ]);
        $pasien->save();

        return redirect()->route('Pasien.index')->with('message', 'Data Pasien Berhasil Di Ubah!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pasien $pasien)
    {
        $pasien = Pasien::find(Request::input('id'));
        $pasien->delete();
        return redirect()->route('Pasien.index')->with('message', 'Data Pasien Berhasil Di Hapus!!');
    }
}
