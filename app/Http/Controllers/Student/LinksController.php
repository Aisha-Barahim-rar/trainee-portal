<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
class LinksController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request): View
    {
       
        //get full user
        #dd(Auth::user()->id);


        $user = DB::table('users')
        ->where('users.id','=',Auth::user()->id)
        ->join('student', 'users.id', '=', 'student.user_id')
        ->select('student.*', 'users.*')
        ->get();

        $links = DB::table('student')
        ->join('student_link', 'student_link.student_id', '=', 'student.ID')
        ->join('important_links', 'important_links.ID', '=', 'student_link.link_id')
        ->where('student.ID','=',$user[0]->ID)
        ->get();

        return view('student.links.view', [
            'links' => $links,
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
        return view('company.links.insert',[
            'user' => $user[0],
        ]);
    }

    public function store($id,Request $request): RedirectResponse
    {


        $link = DB::table('important_links')->insertGetId([
            'link' => $request->link,
        ]);

        $student_link = DB::table('student_link')->insert([
            'student_id' => $id,
            'link_id' => $link,
        ]);



        return Redirect::route('company.links.index',[$id])->with('status', 'link-created');
    }

    public function destroy($id,Request $request): RedirectResponse
    {
        $student_id = DB::table('student_link') ->where('link_id','=',$id)->get();
        DB::table('student_link')
       ->where('link_id','=',$id)->delete();
        DB::table('important_links')
       ->where('ID','=',$id)->delete();

$id = $student_id[0]->student_id;
        return Redirect::route('company.links.index',[$id])->with('status', 'link-deleted');
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
