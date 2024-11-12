<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Pasien;
use App\Models\JamPelayanan;
use Illuminate\Http\Request;
use App\Models\DaftarLayanan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\AntrianController;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();
        // Role Admin Dan Klinik
        if ($user->hasRole('Admin') || $user->hasRole('Klinik')) {
            return redirect()->intended(RouteServiceProvider::HOME);

            // Role Pasien
        } elseif ($user->hasRole('Pasien')) {

            // Cek apakah ada data pendaftaran di session
            if (session()->has('pendaftaran')) {
                $session =session()->get('pendaftaran');

                $tgl = null;
                if ($session['tgl'] == 'hari ini') {
                    $tgl = Carbon::now()->format('Y-m-d');
                } else if ($session['tgl'] == 'besok') {
                    $tgl = Carbon::now()->addDay(1)->format('Y-m-d');
                } else {
                    $tgl = Carbon::now()->format('Y-m-d');
                }
                $antrian = new AntrianController();

                $jampelayanan = JamPelayanan::where('jam', $session['jam_pelayanan'])->first();
                $nomor_antrian = $jampelayanan->no_antrian;

                $data_antrian = $antrian->createAntrian($nomor_antrian);
                $pasien = Pasien::with(['user'])->where('user_id', Auth::user()->id)->first();

                $daftarLayanan = DaftarLayanan::create([
                    'id_pasien' => $pasien->id,
                    'nama_pasien' => $pasien->user->name . '|' . $pasien->id_pasien,
                    'id_layanan' => $session['id_layanan'],
                    'nama_layanan' => $session['nama_layanan'],
                    'nomor_antrian' => $nomor_antrian,
                    'tgl' => $tgl,
                    'jam_pemeriksaan' => $session['jam_pelayanan'],
                    'status' => '0',
                ]);
                session()->forget('pendaftaran');
                return redirect()->route("User.Layanan.success")->with("message", "Data Layanan Berhasil Di Daftarkan");
            }
            return redirect()->intended(RouteServiceProvider::HOMEPASIEN);
        }

        return back()->withErrors([
            'username' => 'Email/No.Telpon Tidak Cocok dengan data kami.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
