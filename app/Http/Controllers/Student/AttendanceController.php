<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
class AttendanceController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request): View
    {
        //get full user
        $user = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->select('student.*', 'users.email', 'users.name')
        ->where('users.id',Auth::user()->id)
        ->get();

        $attendance = DB::table('attendance')
        ->where('student_id','=',$user[0]->ID)
        ->get();

        return view('student.attendance.view', [
            'attendance' => $attendance,
            'user' => $user[0]
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        // add all data
        DB::table('student')
        ->where('user_id', Auth::user()->id)
        ->update([
            'mobile' => $request->mobile,
            'academic_id' => $request->academic_id,
            'university' => $request->university,
            'major' => $request->major
    ]);

        return Redirect::route('student.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function create(): View
    {
        return view('student.attendance.insert');
    }
}
