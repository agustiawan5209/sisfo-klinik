<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        if(Auth::check()){
            abort(401, 'Maaf Akses anda Ditolak');
        }
        // dd(Auth::user());

    }

    public function validate(Request $request, array $rules, array $messages = [], array $attributes = [])
    {
        $role = Auth::user()->getRoleNames()->toArray();
        // dd($role);
        if(in_array('Admin', $role) || in_array('Klinik', $role)){
            return redirect()->route('dashboard');
        }

        if(in_array('Pasien', $role)){
            return redirect()->route('dashboard.pengguna');
        }else{
            Auth::logout();
        }
    }

    public function dashboard()
    {
        return Inertia::render('Dashboard',[
            'pasien'=> Pasien::count(),
            'pemeriksaan'=> Pemeriksaan::count(),
        ]);
    }

    public function dashboardPengguna()
    {
        // Auth::logout();
        // dd(Auth::user()->orangtua);
        return Inertia::render('User/Dashboard');
    }
}
