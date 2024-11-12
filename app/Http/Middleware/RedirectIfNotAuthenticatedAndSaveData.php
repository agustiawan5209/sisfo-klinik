<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotAuthenticatedAndSaveData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika pengguna belum login
        if (!Auth::check()) {
            // Simpan data pendaftaran sementara di session
            session(['pendaftaran' => $request->all()]);
            // Redirect ke halaman login
            return redirect()->route('login');
        }

        return $next($request);
    }
}
