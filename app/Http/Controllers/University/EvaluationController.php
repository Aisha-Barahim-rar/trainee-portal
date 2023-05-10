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
class EvaluationController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index($id,Request $request): View
    {
        //get full user
        $evaluation = DB::table('evaluation')
        ->where('student_id','=',$id)
        ->get();

        $user = DB::table('student')
        ->where('student.ID','=',$id)
        ->join('users', 'users.id', '=', 'student.user_id')
        ->select('student.*', 'users.*')
        ->get();

        return view('university.evaluation.view', [
            'evaluation' => $evaluation,
            'user' => $user[0]
        ]);
    }

    
}
