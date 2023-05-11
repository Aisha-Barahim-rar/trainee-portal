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
class HREvaluationController extends Controller
{
    public function index($id, Request $request): View
    {
        $user = DB::table('student')
            ->where('student.ID', '=', $id)
            ->join('users', 'users.id', '=', 'student.user_id')
            ->leftJoin('company_evaluation', 'company_evaluation.student_id', '=', 'student.ID')
            ->select('student.*', 'student.ID as SID', 'users.email as semail', 'users.*', 'company_evaluation.*')
            ->get();

        $criterias = DB::table('criteria')
        ->leftJoin('scores', 'scores.criteria_id', '=', 'criteria.ID')
        ->leftJoin('company_evaluation', 'company_evaluation.ID', '=', 'scores.companye_id')
        ->get();


        $practical_evaluations = DB::table('company_evaluation')
            ->leftJoin('practical_evaluation', 'practical_evaluation.companye_id', '=', 'company_evaluation.ID')
            ->where('company_evaluation.student_id', '=', $id)
            ->get();

        return view(
            'hr.hr-evaluation.view',

            ['user' => $user[0], 'criterias' => $criterias, 'practical_evaluations' => $practical_evaluations]
        );
    }

}
