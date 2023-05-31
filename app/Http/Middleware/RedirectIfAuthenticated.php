<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if (Auth::user()->password_change_at == null) {
                    return redirect(route('profile.edit'));
                } else {
                    if (Auth::user()->role == 'admin') {
                        return redirect(RouteServiceProvider::ADMIN);
                    } elseif (Auth::user()->role == 'student') {
                        return redirect(RouteServiceProvider::STUDENT);
                    } elseif (Auth::user()->role == 'hr') {
                        return redirect(RouteServiceProvider::HR);
                    } elseif (Auth::user()->role == 'company') {
                        return redirect(RouteServiceProvider::COMPANY);
                    } elseif (Auth::user()->role == 'university') {
                        return redirect(RouteServiceProvider::UNIVERSITY);
                    }
                }
            }
        }

        return $next($request);
    }
}
