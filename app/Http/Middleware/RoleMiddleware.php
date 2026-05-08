<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user() || $request->user()->role !== $role) {
            abort(403, 'Unauthorized action.');
        }

        if ($role === 'siswa' && ($request->user()->registration_status ?? null) !== User::REGISTRATION_APPROVED) {
            Auth::logout();

            return redirect()->route('login')->with('status', 'Akun Anda masih menunggu verifikasi admin.');
        }

        return $next($request);
    }
}
