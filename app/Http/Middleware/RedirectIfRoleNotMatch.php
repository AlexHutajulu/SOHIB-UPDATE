<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RedirectIfRoleNotMatch
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/login');
        }

        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Sesuaikan dengan halaman yang sesuai untuk setiap role
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role == 'masyarakat') {
            return redirect()->route('masyarakat.dashboard');
        } elseif ($user->role == 'kelurahan') {
            return redirect()->route('kelurahan.index');
        }
        

        return redirect('/login');
    }
}
