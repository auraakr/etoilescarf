<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Super admin bisa akses semua
        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        // Cek apakah user punya salah satu role yang diizinkan
        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        // Jika tidak punya akses, redirect dengan error
        return redirect()->route('admin.dashboard')
            ->with('error', 'You do not have permission to access this page.');
    }
}