<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            "alamat" => "required|string|max:200",
            "no_telpon" => "required|max:12",
            "tgl_lahir" => "required|date",
            'username' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->no_telpon,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);
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
            'tgl_pendaftaran' => $user->created_at,
        ]);
        $pasien->save();

        return redirect(RouteServiceProvider::HOMEPASIEN);
    }
}
