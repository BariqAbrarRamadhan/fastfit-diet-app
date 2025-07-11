<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // if (Auth::check() && Auth::user()?->role === 'admin') {
        //     return $next($request);
        // } else {
        //     // Redirect to login if not authenticated or not an admin
        //     return redirect()->route('login')->with('error', 'Silakan login sebagai admin untuk melanjutkan.');
        // }
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melanjutkan.');
        }

        // Cek jika pengguna adalah admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak. Anda bukan admin.');
        }

        return $next($request);
    }
}