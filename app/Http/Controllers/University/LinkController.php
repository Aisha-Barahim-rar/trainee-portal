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
class LinkController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index($id,Request $request): View
    {
    

        $links = DB::table('student')
        ->join('student_link', 'student_link.student_id', '=', 'student.ID')
        ->join('important_links', 'important_links.ID', '=', 'student_link.link_id')
        ->where('student.ID','=',$id)
        ->get();

        $user = DB::table('student')
        ->where('student.ID','=',$id)
        ->join('users', 'users.id', '=', 'student.user_id')
        ->select('student.*', 'users.*')
        ->get();

        return view('university.links.view', [
            'links' => $links,
            'user' => $user[0]
        ]);
    }

    
}
