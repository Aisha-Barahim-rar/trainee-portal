<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        if(Auth::user()->role=="admin"){  
            return redirect(RouteServiceProvider::ADMIN);
        }elseif(Auth::user()->role=="student"){
            return redirect(RouteServiceProvider::STUDENT);
        }elseif(Auth::user()->role=="hr"){
            return redirect(RouteServiceProvider::HR);
        }elseif(Auth::user()->role=="company"){
            return redirect(RouteServiceProvider::COMPANY);
        }elseif(Auth::user()->role=="university"){
            return redirect(RouteServiceProvider::UNIVERSITY);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
