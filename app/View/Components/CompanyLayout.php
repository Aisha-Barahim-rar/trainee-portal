<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CompanyLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $mentor = DB::table('company_mentor')
        ->where('user_id','=',Auth::user()->id)
        ->get();
        
        $students = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->join('student_company','student.ID','=','student_company.student_id')
        ->where('student_company.mentor_id','=',$mentor[0]->ID)
        ->select('student.*', 'users.email', 'users.name')
        ->get();
        return view('company.layouts.app',['students'=>$students]);
    }
}
