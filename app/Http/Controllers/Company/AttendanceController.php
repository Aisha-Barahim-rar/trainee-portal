<?php

namespace App\Http\Controllers\Company;
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
    public function index($id,Request $request): View
    {
        //get full user
        $attendance = DB::table('attendance')
        ->where('student_id','=',$id)
        ->orderBy("date")
        ->get();

        $user = DB::table('student')
        ->where('student.ID','=',$id)
        ->join('users', 'users.id', '=', 'student.user_id')
        ->select('student.*', 'users.*')
        ->get();

        return view('company.attendance.view', [
            'attendance' => $attendance,
            'user' => $user[0]
        ]);
    }

    public function edit($id,Request $request): View
    {
        $attendance = DB::table('attendance')
        ->find($id);

        $user = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->select('student.*', 'users.email', 'users.name')
        ->where('student.ID',$attendance->student_id)
        ->get();
        return view('company.attendance.edit', [
            'attendance' => $attendance,
            'user' => $user[0],
        ]);
    }

    public function update($id,Request $request): RedirectResponse
    {
        DB::table('attendance')
        ->where('ID', $id)
        ->update([
            'date' => $request->date,
            'attendance' => $request->timein,
            'departure' => $request->timeout
    ]);

    $attendance = DB::table('attendance')
        ->find($id);

        return Redirect::route('company.attendance.index',[$attendance->student_id])->with('status', 'attendance-updated');
    }

    public function create($id): View
    {
        $user = DB::table('student')
        ->where('student.ID','=',$id)
        ->join('users', 'users.id', '=', 'student.user_id')
        ->select('student.*', 'users.email','users.name')
        ->get();
        return view('company.attendance.insert',[
            'user' => $user[0],
        ]);
    }

    public function store($id,Request $request): RedirectResponse
    {


        $attendance = DB::table('attendance')->insert([
            'date' => $request->date,
            'attendance' => $request->timein,
            'departure' => $request->timeout,
            'student_id' => $id,
        ]);

        return Redirect::route('company.attendance.index',[$id])->with('status', 'attendance-created');
    }

    public function destroy($id,Request $request): RedirectResponse
    {
        $student_id = DB::table('attendance') ->find($id);
        DB::table('attendance')
        ->where('ID','=',$id)->delete();
        return Redirect::route('company.attendance.index',[$student_id->student_id])->with('status', 'attendance-deleted');
    }
}
