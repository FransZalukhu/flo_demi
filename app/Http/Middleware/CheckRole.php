<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role  The required role (e.g., 'superadmin')
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Check if user has the required role
        if (!$user || $user->role !== $role) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini. Hanya untuk ' . ucfirst($role) . '.');
        }

        return $next($request);
    }
}
