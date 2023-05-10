<?php

namespace App\Http\Controllers\University;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use File;
class ReportController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index($id,Request $request): View
    {
        //get full user
        $reports = DB::table('report')
        ->join('student', 'student.ID', '=', 'report.student_id')
        ->where('student.ID','=',$id)
        ->select('student.ID as SID','report.*')
        ->get();

        $user = DB::table('student')
        ->where('student.ID','=',$id)
        ->join('users', 'users.id', '=', 'student.user_id')
        ->select('student.*', 'users.*')
        ->get();

        return view('university.report.view', [
            'reports' => $reports,
            'user' => $user[0]
        ]);
    }

    
}
