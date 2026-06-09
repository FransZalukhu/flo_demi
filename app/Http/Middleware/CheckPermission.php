<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $permission  The permission to check
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user && $user->role === 'superadmin') {
            return $next($request);
        }

        if (!$user || !$user->hasPermission($permission)) {
            // Abort with 403 Forbidden
            abort(403, 'Anda tidak memiliki akses ke halaman ini. Hubungi administrator jika membutuhkan akses.');
        }

        return $next($request);
    }
}
