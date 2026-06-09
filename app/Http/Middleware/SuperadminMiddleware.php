<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperadminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('superadmin.login')->withErrors([
                'email' => 'Silakan login terlebih dahulu.'
            ]);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Check if user has superadmin or admin role
        if ($user->role !== 'superadmin' && $user->role !== 'admin') {
            return redirect()->route('home')->with('error', 'Akses ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        // Check if user status is active
        if ($user->status === 'nonaktif') {
            Auth::logout();
            return redirect()->route('superadmin.login')->withErrors([
                'email' => 'Akun Anda dinonaktifkan. Silakan hubungi Superadmin jika membutuhkan akses.'
            ]);
        }

        return $next($request);
    }
}
