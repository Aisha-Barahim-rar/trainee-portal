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

        return view('company.evaluation.view', [
            'evaluation' => $evaluation,
            'user' => $user[0]
        ]);
    }

    public function create($id): View
    {
        $user = DB::table('student')
        ->where('student.ID','=',$id)
        ->join('users', 'users.id', '=', 'student.user_id')
        ->select('student.*', 'users.email','users.name')
        ->get();
        return view('company.evaluation.insert',[
            'user' => $user[0],
        ]);
    }

    public function store($id,Request $request): RedirectResponse
    {

        $link = $request->file('evaluation');
        $filename = $link->getClientOriginalName();

        if($link->move(('evaluation/' . $id . '/'), $filename)){
            $evaluation = DB::table('evaluation')->insertGetId([
                'file' => $filename,
                'student_id' => $id
            ]);
        }

        

        return Redirect::route('company.evaluation.index',[$id])->with('status', 'evaluation-created');
    }

    public function destroy($id,Request $request): RedirectResponse
    {
        $plan = DB::table('training_plan')->find($id);
        File::deleteDirectory(('plans/' . $plan->student_id));
        DB::table('training_plan')
       ->where('ID','=',$id)->delete();

        return Redirect::route('company.plan.index',[$id])->with('status', 'plan-deleted');
    }

    public function edit($id,$std,Request $request): View
    {
        $link = DB::table('important_links')
        ->find($id);

        $user = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->select('student.*', 'users.email', 'users.name')
        ->where('student.ID',$std)
        ->get();

        return view('company.links.edit', [
            'link' => $link,
            'user' => $user[0],
        ]);
    }

    public function update($id,Request $request): RedirectResponse
    {
        $student_id = DB::table('student_link') ->where('link_id','=',$id)->get();
        DB::table('important_links')
        ->where('ID', $id)
        ->update([
            'link' => $request->link,
    ]);

    $id = $student_id[0]->student_id;

    return Redirect::route('company.links.index',[$id])->with('status', 'link-updated');
}
    
}
