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
class CompanyController extends Controller
{
    //
    public function index(Request $request): View
    {
        // make conditions
        $company_mentors = DB::table('users')
            ->join('company_mentor', 'users.ID', '=', 'company_mentor.user_id')
            ->select('company_mentor.*', 'users.email', 'users.name')
            ->get();

        $students = DB::table('users')
            ->join('student', 'users.ID', '=', 'student.user_id')
            ->select('student.*', 'users.email', 'users.name')
            ->get();

        $company_students = DB::table('student_company')->get();

        return view('admin.company.list', [
            'company_mentors' => $company_mentors,
            'students' => $students,
            'company_students' => $company_students,
        ]);
    }

    public function create(): View
    {
        return view('admin.company.insert');
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
        $user_id = DB::table('company_mentor')->find($id);
        DB::table('company_mentor')->delete($id);
        DB::table('users')->delete($user_id->user_id);
        return Redirect::route('admin.company.index')->with('status', 'company-deleted');
    }

    public function store_trainee($id, Request $request): RedirectResponse
    {
        try {
            DB::table('student_company')
                ->where('mentor_id', $id)
                ->delete();

            if ($request->trainees) {
                foreach ($request->trainees as $index => $trainee) {
                    if ($trainee) {
                        DB::table('student_company')
                            ->where('mentor_id', $id)
                            ->updateOrInsert([
                                'student_id' => $trainee,
                                'mentor_id' => $id,
                            ]);
                    }
                }
            }
            return Redirect::route('admin.company.index')->with('status', 'company-trainee-created');
        } catch (\Exception $ex) {
            return Redirect::route('admin.dashboard');
        }
    }

    public function view($id, Request $request): View
    {
        $company_mentors = DB::table('users')
            ->join('company_mentor', 'users.ID', '=', 'company_mentor.user_id')
            ->select('company_mentor.*', 'users.email', 'users.name')
            ->where('company_mentor.ID', $id)
            ->get();
        return view('admin.company.view', [
            'company_mentors' => $company_mentors,
        ]);
    }

    public function edit($id, Request $request): View
    {
        $company_mentors = DB::table('users')
            ->join('company_mentor', 'users.ID', '=', 'company_mentor.user_id')
            ->select('company_mentor.*', 'users.email', 'users.name')
            ->where('company_mentor.ID', $id)
            ->get();
        return view('admin.company.edit', [
            'company_mentor' => $company_mentors[0],
        ]);
    }

    public function update($id, ProfileUpdateRequest $request): RedirectResponse
    {
        DB::table('users')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

        DB::table('company_mentor')
            ->where('user_id', $id)
            ->update([
                'mobile' => $request->mobile,
                'department' => $request->department,
            ]);

        return Redirect::route('admin.company.index')->with('status', 'company-updated');
    }
}
