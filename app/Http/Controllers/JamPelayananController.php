<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\JamPelayanan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreJamPelayananRequest;
use App\Http\Requests\UpdateJamPelayananRequest;

class JamPelayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tableName = 'jam_pelayanans'; // Ganti dengan nama tabel yang Anda inginkan
        $columns = DB::getSchemaBuilder()->getColumnListing($tableName);

        return Inertia::render('Admin/JamPelayanan/Index', [
            'search' =>  Request::input('search'),
            'table_colums' => array_values(array_diff($columns, ['remember_token', 'posyandus_id', 'password', 'email_verified_at', 'created_at', 'updated_at', 'user_id'])),
            'data' => JamPelayanan::filterBySearch(Request::input('search'))
            ->filterByOrder(Request::input('order'))
                ->paginate(10),
            'can' => [
                'add' => Auth::user()->can('add layanan'),
                'edit' => Auth::user()->can('edit layanan'),
                'show' => Auth::user()->can('show layanan'),
                'delete' => Auth::user()->can('delete layanan'),
            ]
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
    public function store(StoreJamPelayananRequest $request)
    {
        JamPelayanan::create($request->all());

        return redirect()->route('JamPelayanan.index')->with('message', 'Data Berhasil Di Tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(JamPelayanan $jamPelayanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JamPelayanan $jamPelayanan)
    {
        return response()->json($jamPelayanan->find(Request::input('slug')), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJamPelayananRequest $request, JamPelayanan $jamPelayanan)
    {
        JamPelayanan::find($request->id)->update($request->all());

        return redirect()->route('JamPelayanan.index')->with('message', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JamPelayanan $jamPelayanan)
    {
        JamPelayanan::find(Request::input('slug'))->delete();

        return redirect()->route('JamPelayanan.index')->with('message', 'Data Berhasil Di Hapus');
    }
}
