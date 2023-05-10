<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class UniversityLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $mentor = DB::table('university_mentor')
        ->where('user_id','=',Auth::user()->id)
        ->get();
        
        $students = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->join('student_university','student.ID','=','student_university.student_id')
        ->where('student_university.mentor_id','=',$mentor[0]->ID)
        ->select('student.*', 'users.email', 'users.name')
        ->get();
        return view('university.layouts.app',['students'=>$students]);
    }
}
