<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (!in_array($user->role, $roles)) {
            // Redirect otomatis sesuai role
            switch ($user->role) {
                case 'pembeli':
                    return redirect()->route('pembeli.dashboard');
                case 'pelaku_umkm':
                    return redirect()->route('pelaku_umkm.dashboard');
                case 'admin':
                    return redirect()->route('admin.dashboard');
                default:
                    abort(403, 'Unauthorized role');
            }
        }

        return $next($request);
    }
}
