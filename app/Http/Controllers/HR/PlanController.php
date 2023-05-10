<?php

namespace App\Http\Controllers\HR;
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
    public function index($id,Request $request): View
    {
        //get full user
        $plans = DB::table('training_plan')
        ->join('student', 'student.ID', '=', 'training_plan.student_id')
        ->where('student.ID','=',$id)
        ->select('student.ID as SID','training_plan.*')
        ->get();

        $user = DB::table('student')
        ->where('student.ID','=',$id)
        ->join('users', 'users.id', '=', 'student.user_id')
        ->select('student.*', 'users.*')
        ->get();

        return view('hr.plan.view', [
            'plans' => $plans,
            'user' => $user[0]
        ]);
    }


}
