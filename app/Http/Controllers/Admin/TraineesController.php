<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ProfileUpdateRequest;

class TraineesController extends Controller
{
    //
    public function create(): View
    {
        return view('admin.trainee.insert');
    }

    public function index(Request $request): View
    {
        // make conditions
        $students = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->select('student.*', 'users.email', 'users.name')
        ->get();
        return view('admin.trainee.list', [
            'students' => $students,
        ]);
    }

    public function view($id,Request $request): View
    {
        $students = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->select('student.*', 'users.email', 'users.name')
        ->where('student.ID',$id)
        ->get();
        return view('admin.trainee.view', [
            'students' => $students,
        ]);
    }

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

        //redirect
        if($user->role=="admin"){
            $admin = DB::table('admin')->insert([
                'user_id' => $user->id,
            ]);
            return Redirect::route('admin.dashboard')->with('status', 'admin-created');
        }elseif($user->role=="student"){
            $student = DB::table('student')->insert([
                'user_id' => $user->id,
            ]);
            return Redirect::route('admin.trainees.index')->with('status', 'trainee-created');
        }elseif($user->role=="hr"){
            $hr_admin = DB::table('hr_admin')->insert([
                'user_id' => $user->id,
            ]);
            return Redirect::route('admin.hr.index')->with('status', 'hr-created');
        }elseif($user->role=="company"){
            $company_mentor = DB::table('company_mentor')->insert([
                'user_id' => $user->id,
            ]);
            return Redirect::route('admin.company.index')->with('status', 'company-created');
        }elseif($user->role=="university"){
            $university_mentor = DB::table('university_mentor')->insert([
                'user_id' => $user->id,
            ]);
            return Redirect::route('admin.university.index')->with('status', 'university-created');
        }
        else{
            return Redirect::route('admin.dashboard');
        }
    }

    public function destroy($id,Request $request): RedirectResponse
    {
        $user_id = DB::table('student')
       ->find($id);
        DB::table('student')->delete($id);
        DB::table('users')->delete($user_id->user_id);
        return Redirect::route('admin.trainees.index')->with('status', 'trainee-deleted');
    }

    public function edit($id,Request $request): View
    {
        $students = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->select('student.*', 'users.email', 'users.name')
        ->where('student.ID',$id)
        ->get();
        return view('admin.trainee.edit', [
            'student' => $students[0],
        ]);
    }

    public function update($id,ProfileUpdateRequest $request): RedirectResponse
    {

        DB::table('users')
        ->where('id', $id)
        ->update([
            'name' => $request->name,
            'email' => $request->email
    ]);

        DB::table('student')
        ->where('user_id', $id)
        ->update([
            'mobile' => $request->mobile,
            'academic_id' => $request->academic_id,
            'university' => $request->university,
            'major' => $request->major,
            'hours' => $request->hours
    ]);
        

        return Redirect::route('admin.trainees.index')->with('status', 'trainee-updated');
    }

}
