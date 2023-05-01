<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class TraineesController extends Controller
{
    //
    public function index(Request $request): View
    {
        // make conditions
        $students = DB::table('users')
        ->join('student', 'users.ID', '=', 'student.user_id')
        ->select('student.*', 'users.email', 'users.name')
        ->get();
        return view('admin.trainee.list', [
            'students' => $students,
        ]);
    }
}
