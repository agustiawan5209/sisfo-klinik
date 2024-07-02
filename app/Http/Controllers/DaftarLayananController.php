<?php

namespace App\Http\Controllers;

use App\Models\DaftarLayanan;
use App\Http\Requests\StoreDaftarLayananRequest;
use App\Http\Requests\UpdateDaftarLayananRequest;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class DaftarLayananController extends Controller
{
    /**
     * success
     * @return void
     */
    public function success()
    {
        return Inertia::render('User/Layanan/Success');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('User/Layanan/Index');
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
        $daftarLayanan = DaftarLayanan::create($request->all());

        return redirect()->route("DaftarLayanan.success")->with("message", "Data Layanan Berhasil Di Daftarkan");
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

        return redirect()->route("DaftarLayanan.success")->with("message", "Data Layanan Berhasil Di Ubah");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DaftarLayanan $daftarLayanan)
    {
        $daftarLayanan = DaftarLayanan::find(Request::input('slug'));

        return redirect()->route("DaftarLayanan.success")->with("message", "Data Layanan Berhasil Di Hapus");
    }
}
