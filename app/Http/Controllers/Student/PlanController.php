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
use File;
class PlanController extends Controller
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

        $plans = DB::table('training_plan')
        ->join('student', 'student.ID', '=', 'training_plan.student_id')
        ->where('student.ID','=',$user[0]->ID)
        ->select('student.ID as SID','training_plan.*')
        ->get();

        return view('student.plan.view', [
            'plans' => $plans,
            'user' => $user[0]
        ]);
    }

    
}
