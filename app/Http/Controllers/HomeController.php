<?php

namespace App\Http\Controllers;

use App\Models\JamPelayanan;
use App\Models\Layanan;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function index() {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'layanan'=> Layanan::where('id_layanan', '!=', 'LN-000')->get(),
            'pemeriksaan'=> Layanan::where('id_layanan', '=', 'LN-000')->first(),
            'jampelayanan'=> JamPelayanan::all(),
        ]);
    }
}
