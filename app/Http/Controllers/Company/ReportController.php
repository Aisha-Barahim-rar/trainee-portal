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

        return view('company.report.view', [
            'reports' => $reports,
            'user' => $user[0]
        ]);
    }

    public function store($id,Request $request): RedirectResponse
    {

        $link = $request->file('report');
        $filename = $link->getClientOriginalName();

        if($link->move(('reports/' . $id . '/'), $filename)){
            $report = DB::table('report')->insertGetId([
                'file' => $filename,
                'student_id' => $id
            ]);
        }

        return Redirect::route('company.report.index',[$id])->with('status', 'report-created');
    }

    public function destroy($id,Request $request): RedirectResponse
    {
        $report = DB::table('report')->find($id);
        File::deleteDirectory(('reports/' . $report->student_id));
        DB::table('report')
       ->where('ID','=',$id)->delete();

        return Redirect::route('company.report.index',[$id])->with('status', 'report-deleted');
    }
    
    public function edit($id,$std,Request $request): View
    {
        $report = DB::table('report')
        ->find($id);

        $user = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->select('student.*', 'users.email', 'users.name')
        ->where('student.ID',$std)
        ->get();

        return view('company.report.edit', [
            'report' => $report,
            'user' => $user[0],
        ]);
    }

    public function update($id,Request $request): RedirectResponse
    {
        $student_id = DB::table('report') ->find($id);
        
        $std = $student_id->student_id;

        File::delete(('reports/' . $std.'/'.$student_id->file));

        $report = $request->file('report');
        $filename = $report->getClientOriginalName();

        if($report->move(('reports/' . $std . '/'), $filename)){
            DB::table('report')
            ->where('ID', $id)
            ->update([
                'file' => $filename,
        ]);

        }

        

    return Redirect::route('company.report.index',[$id])->with('status', 'report-updated');
}
}
