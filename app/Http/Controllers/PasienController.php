<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Pasien;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StorePasienRequest;
use App\Http\Requests\UpdatePasienRequest;
use App\Models\DaftarLayanan;
use PDF;
class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tableName = 'pasiens'; // Ganti dengan nama tabel yang Anda inginkan
        // $columns = DB::getSchemaBuilder()->getColumnListing($tableName);
        $columns[] = 'id';
        $columns[] = 'id_pasien';
        $columns[] = 'tgl_pendaftaran';
        $columns[] = 'nama_pasien';
        $columns[] = 'no_telpon';
        $columns[] = 'tgl_lahir';
        $columns[] = 'alamat';
        $columns[] = 'daftar_layanan';

        // dd($columns);
        return Inertia::render('Admin/Pasien/Index', [
            'search' =>  Request::input('search'),
            'table_colums' => array_values(array_diff($columns, ['remember_token', 'password', 'email_verified_at', 'created_at', 'updated_at', 'user_id', 'deskripsi'])),
            'data' => Pasien::with(['user','daftarlayanan'])->filter(Request::only('search', 'order'))
            ->when(Request::input('start_date') !=null && Request::input('end_date') != null, function($query){
                $query->whereBetween('tgl_pendaftaran', [Request::input('start_date'), Request::input('end_date')]);
            })
            ->paginate(10),
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
        return Inertia::render('Admin/Pasien/Form', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePasienRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->no_telpon,
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ]);
        $role = Role::findByName('pasien');
        if ($role) {
            $user->assignRole($role); // Assign 'user' role to the user
            $user->givePermissionTo([
                'add antrian',
                'edit antrian',
                'delete antrian',
                'show antrian',
            ]);
        }

        $lastId = Pasien::max('id') + 1;

        // Membuat kode transaksi dengan format yang diinginkan
        $id_pasien = str_pad($lastId, 3, '0', STR_PAD_LEFT);
        $pasien = new Pasien([
            'user_id' => $user->id,
            'id_pasien'=> $id_pasien,
            'alamat' => $request->alamat,
            'tgl_lahir' => $request->tgl_lahir,
            'no_telpon' => $request->no_telpon,
            'tgl_pendaftaran' => $request->tgl_pendaftaran,
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
        $pasien = Pasien::find(Request::input('slug'));
        $user = User::find($pasien->user_id)->update(['name'=> $request->name, 'phone'=> $request->no_telpon]);
        $pasien->update([
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_telpon' => $request->no_telpon,
            'tgl_pendaftaran'=> $request->tgl_pendaftaran,
        ]);

        return redirect()->route('Pasien.index')->with('message', 'Data Pasien Berhasil Di Ubah!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pasien $pasien)
    {
        $pasien = Pasien::find(Request::input('slug'));
        DaftarLayanan::where('id_pasien', $pasien->id)->delete();
        $user = User::find($pasien->user_id)->delete();
        return redirect()->route('Pasien.index')->with('message', 'Data Pasien Berhasil Di Hapus!!');
    }

    /**
     * Rest Password the specified resource.
     */
    public function resetpassword(Pasien $pasien)
    {

        return Inertia::render('Admin/Pasien/UpdatePassword', [
            'user' => User::find(Request::input('slug')),
        ]);
    }
    public function resetpasswordUpdate(Pasien $pasien)
    {

        Request::validate([
            'password' => 'required|string|confirmed|min:8',
            'password_confirmation' => 'required',
        ]);

        $user = User::find(Request::input('slug'));
        $user->update([
            'remember_token' => Str::random(60),
            'password' => Hash::make(Request::input('password')),
        ]);
        return redirect()->route('Pasien.index')->with('message', 'Password Pasien berhasil Di Ubah!');

    }

    public function cetakPDF()
    {
        // Ambil data pemeriksaan berdasarkan id
        $data = Pasien::whereBetween('tgl_pendaftaran', Request::only('start_date', 'end_date'))
            ->with(['user','daftarlayanan'])
            ->get();



        // Load view untuk PDF dan pass data pemeriksaan
        $pdf = PDF::loadView('pdf.pasien', compact('data'))->setPaper('A4', 'landscape');

        // Unduh PDF
        return $pdf->download('pasien.pdf');
    }
}
