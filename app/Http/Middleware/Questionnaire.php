<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Questionnaire
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melanjutkan.');
        }

        $user = Auth::user();

        // Cek jika pengguna adalah admin
        if ($user->role === 'admin') {
            // Redirect admin ke dashboard admin jika mencoba akses rute yang dilindungi middleware ini
            return redirect()->route('admin.dashboard')->with('error', 'Admin tidak diizinkan mengakses halaman ini.');
        }

        // Cek jika pengguna telah mengisi kuesioner (untuk non-admin)
        $hasCompletedQuestionnaire = $user->questionnaire()->exists();
        if (!$hasCompletedQuestionnaire) {
            return redirect()->route('questionnaire.index')->with('error', 'Silakan lengkapi kuesioner sebelum melanjutkan.');
        }

        return $next($request);
    }
}
