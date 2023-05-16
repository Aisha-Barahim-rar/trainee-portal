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

        $mentor = DB::table('users')
            ->join('company_mentor', 'users.ID', '=', 'company_mentor.user_id')
            ->join('student_company', 'company_mentor.ID', '=', 'student_company.mentor_id')
            ->select('student_company.*','company_mentor.*', 'users.email', 'users.name')
            ->where('student_company.student_id', '=', $id)
            ->first();

        $criterias = DB::table('criteria')
            ->leftJoin('scores', 'scores.criteria_id', '=', 'criteria.ID')
            ->leftJoin('company_evaluation', 'company_evaluation.ID', '=', 'scores.companye_id')
            ->get();

        $practical_evaluations = DB::table('company_evaluation')
            ->leftJoin('practical_evaluation', 'practical_evaluation.companye_id', '=', 'company_evaluation.ID')
            ->where('company_evaluation.student_id', '=', $id)
            ->get();

        # dd($user);
        return view(
            'company.hr-evaluation.view',

            ['user' => $user[0], 'criterias' => $criterias, 'practical_evaluations' => $practical_evaluations,'mentor'=>$mentor]
        );
    }

    public function store($id, Request $request): RedirectResponse
    {
        $user = DB::table('company_mentor')
            ->where('user_id', '=', Auth::user()->id)
            ->first();
        DB::table('company_evaluation')->updateOrInsert(
            ['company_evaluation.student_id' => $id],
            [
                'date' => $request->date,
                'phone' => $request->phone,
                'fax' => $request->fax,
                'email' => $request->email,
                'recommendation' => $request->recommendation,
                'head_of_training' => $request->head_of_training,
                'mentor_id' => $user->ID,
                'total_score' => $request->total_score,
                'percentage' => $request->percentage,
                'student_name' => $request->student_name,
                'student_identification' => $request->student_identification,
                'student_university' => $request->student_university,
                'student_major' => $request->student_major,
                'student_telephone' => $request->student_telephone,
                'student_mobile' => $request->student_mobile,
                'student_email' => $request->student_email,
                'mentor_name' => $request->mentor_name,
                'mentor_department' => $request->mentor_department,
                'mentor_telephone' => $request->mentor_telephone,
                'mentor_mobile' => $request->mentor_mobile,
                'mentor_email' => $request->mentor_email,
            ]
        );
        $practical_evaluations = DB::table('company_evaluation')
            ->where('company_evaluation.student_id', '=', $id)
            ->first();

        foreach ($request->score as $key => $score) {
            if ($score) {
                DB::table('scores')->updateOrInsert(
                    ['criteria_id' => $key + 1, 'companye_id' => $practical_evaluations->ID,'student_id'=>$id],
                    [
                        'score' => $score,
                    ]
                );
            } else {
                DB::table('scores')
                    ->where([
                        'criteria_id' => $key + 1,
                        'companye_id' => $practical_evaluations->ID,
                    ])
                    ->delete();
            }
        }

        DB::table('practical_evaluation')->where('companye_id', $practical_evaluations->ID)->delete();
            
            
                foreach ($request->practical_evaluation as $index => $practical_evaluation) {

                    if(array_filter($practical_evaluation)){
                        DB::table('practical_evaluation')
                        ->insert([
                            'start_date' => $practical_evaluation[1],
                            'end_date' => $practical_evaluation[2],
                            'employee' => $practical_evaluation[3],
                            'department' => $practical_evaluation[4],
                            'score' => $practical_evaluation[5],
                            'topic' => $practical_evaluation[0],
                            'companye_id' => $practical_evaluations->ID
                    ]);
                    }
                    
                }
            
        return Redirect::route('hr.evaluation.index', $id)->with('status', 'evaluation-updated');
    }
}
