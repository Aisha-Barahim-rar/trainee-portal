<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class HRLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $students = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->select('student.*', 'users.email', 'users.name')
        ->get();
        return view('hr.layouts.app',['students'=>$students]);
    }
}
