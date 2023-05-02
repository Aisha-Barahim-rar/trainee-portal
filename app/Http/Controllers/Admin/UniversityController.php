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

class UniversityController extends Controller
{
    //
    public function index(Request $request): View
    {
        // make conditions
        $university_mentors = DB::table('users')
            ->join('university_mentor', 'users.ID', '=', 'university_mentor.user_id')
            ->select('university_mentor.*', 'users.email', 'users.name')
            ->get();
        $students = DB::table('users')
            ->join('student', 'users.ID', '=', 'student.user_id')
            ->select('student.*', 'users.email', 'users.name')
            ->get();

        $university_students = DB::table('student_university')->get();
        return view('admin.university.list', [
            'university_mentors' => $university_mentors,
            'students' => $students,
            'university_students' => $university_students,
        ]);
    }

    public function create(): View
    {
        return view('admin.university.insert');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
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
        if ($user->role == 'admin') {
            $admin = DB::table('admin')->insert([
                'user_id' => $user->id,
            ]);
            return Redirect::route('admin.dashboard')->with('status', 'admin-created');
        } elseif ($user->role == 'student') {
            $student = DB::table('student')->insert([
                'user_id' => $user->id,
            ]);
            return Redirect::route('admin.trainees.index')->with('status', 'trainee-created');
        } elseif ($user->role == 'hr') {
            $hr_admin = DB::table('hr_admin')->insert([
                'user_id' => $user->id,
            ]);
            return Redirect::route('admin.hr.index')->with('status', 'hr-created');
        } elseif ($user->role == 'company') {
            $company_mentor = DB::table('company_mentor')->insert([
                'user_id' => $user->id,
            ]);
            return Redirect::route('admin.company.index')->with('status', 'company-created');
        } elseif ($user->role == 'university') {
            $university_mentor = DB::table('university_mentor')->insert([
                'user_id' => $user->id,
            ]);
            return Redirect::route('admin.university.index')->with('status', 'university-created');
        } else {
            return Redirect::route('admin.dashboard');
        }
    }

    public function destroy($id, Request $request): RedirectResponse
    {
        $user_id = DB::table('university_mentor')->find($id);
        DB::table('university_mentor')->delete($id);
        DB::table('users')->delete($user_id->user_id);
        return Redirect::route('admin.university.index')->with('status', 'university-deleted');
    }

    public function store_trainee($id, Request $request): RedirectResponse
    {
        try {
            DB::table('student_university')
                ->where('mentor_id', $id)
                ->delete();

            if ($request->trainees) {
                foreach ($request->trainees as $index => $trainee) {
                    if ($trainee) {
                        DB::table('student_university')
                            ->where('mentor_id', $id)
                            ->updateOrInsert([
                                'student_id' => $trainee,
                                'mentor_id' => $id,
                            ]);
                    }
                }
            }
            return Redirect::route('admin.university.index')->with('status', 'university-trainee-created');
        } catch (\Exception $ex) {
            return Redirect::route('admin.dashboard');
        }
    }
}
