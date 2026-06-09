<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MenteeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors([
                'email' => 'Silakan login terlebih dahulu.'
            ]);
        }

        $user = Auth::user();

        if ($user->role !== 'mentee') {
            if ($user->role === 'superadmin' || $user->role === 'admin') {
                return redirect()->route('superadmin.dashboard.index')->with('error', 'Akses ditolak. Halaman ini hanya untuk Mentee.');
            }

            return redirect()->route('home')->with('error', 'Akses ditolak. Halaman ini hanya untuk Mentee.');
        }

        if ($user->status === 'nonaktif') {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'email' => 'Akun Anda dinonaktifkan. Silakan hubungi admin jika membutuhkan bantuan.'
            ]);
        }

        return $next($request);
    }
}
