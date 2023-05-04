<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        

        event(new Registered($user));

        Auth::login($user);

        if(Auth::user()->role=="admin"){
            $admin = DB::table('admin')->insert([
                'user_id' => $user->id,
            ]);
            return redirect(RouteServiceProvider::ADMIN);
        }elseif(Auth::user()->role=="student"){
            $student = DB::table('student')->insert([
                'user_id' => $user->id,
            ]);
            return redirect(RouteServiceProvider::STUDENT);
        }elseif(Auth::user()->role=="hr"){
            $hr_admin = DB::table('hr_admin')->insert([
                'user_id' => $user->id,
            ]);
            return redirect(RouteServiceProvider::HR);
        }elseif(Auth::user()->role=="company"){
            $company_mentor = DB::table('company_mentor')->insert([
                'user_id' => $user->id,
            ]);
            return redirect(RouteServiceProvider::COMPANY);
        }elseif(Auth::user()->role=="university"){
            $university_mentor = DB::table('university_mentor')->insert([
                'user_id' => $user->id,
            ]);
            return redirect(RouteServiceProvider::UNIVERSITY);
        }
        else{
            return redirect(RouteServiceProvider::STUDENT);
        }
    }
}
