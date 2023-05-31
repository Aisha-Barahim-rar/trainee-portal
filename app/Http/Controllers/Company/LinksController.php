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
class LinksController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index($id, Request $request): View
    {
        //get full user
        $links = DB::table('student')
            ->join('student_link', 'student_link.student_id', '=', 'student.ID')
            ->join('important_links', 'important_links.ID', '=', 'student_link.link_id')
            ->where('student.ID', '=', $id)
            ->get();

        $user = DB::table('student')
            ->where('student.ID', '=', $id)
            ->join('users', 'users.id', '=', 'student.user_id')
            ->select('student.*', 'users.*')
            ->get();

        return view('company.links.view', [
            'links' => $links,
            'user' => $user[0],
        ]);
    }

    public function create($id): View
    {
        $user = DB::table('student')
            ->where('student.ID', '=', $id)
            ->join('users', 'users.id', '=', 'student.user_id')
            ->select('student.*', 'users.email', 'users.name')
            ->get();
        return view('company.links.insert', [
            'user' => $user[0],
        ]);
    }

    public function store($id, Request $request): RedirectResponse
    {
        if ($request->type == 'File') {
            $link = $request->file('file');
            $filename = $link->getClientOriginalName();

            if ($link->move('files/' . $id . '/', $filename)) {
                $link = DB::table('important_links')->insertGetId([
                    'link' => $filename,
                    'type' => $request->type,
                ]);
            }
        } else {
            $link = DB::table('important_links')->insertGetId([
                'link' => $request->link,
                'type' => $request->type,
            ]);
        }

        $student_link = DB::table('student_link')->insert([
            'student_id' => $id,
            'link_id' => $link,
        ]);

        return Redirect::route('company.links.index', [$id])->with('status', 'link-created');
    }

    public function destroy($id, Request $request): RedirectResponse
    {
        $student_id = DB::table('student_link')
            ->where('link_id', '=', $id)
            ->first();
        
        $link = DB::table('important_links') ->find($id);
        DB::table('student_link')
            ->where('link_id', '=', $id)
            ->delete();
        DB::table('important_links')
            ->where('ID', '=', $id)
            ->delete();
        if($link->type == "File"){
            File::delete(('files/' . $student_id->student_id.'/'.$link->link));
        }
        

        $id = $student_id->student_id;
        return Redirect::route('company.links.index', [$id])->with('status', 'link-deleted');
    }

    public function edit($id, $std, Request $request): View
    {
        $link = DB::table('important_links')->find($id);

        $user = DB::table('users')
            ->join('student', 'users.ID', '=', 'student.user_id')
            ->select('student.*', 'users.email', 'users.name')
            ->where('student.ID', $std)
            ->get();

        return view('company.links.edit', [
            'link' => $link,
            'user' => $user[0],
        ]);
    }

    public function update($id, Request $request): RedirectResponse
    {
        $student_id = DB::table('student_link')
            ->where('link_id', '=', $id)
            ->first();

        if ($request->type == 'File') {
            $file = DB::table('important_links') ->find($id);
            File::delete(('files/' . $student_id->student_id.'/'.$file->link));
            $link = $request->file('file');
            $filename = $link->getClientOriginalName();

            if ($link->move('files/' . $student_id->student_id . '/', $filename)) {
                DB::table('important_links')
                    ->where('ID', $id)
                    ->update([
                        'link' => $filename,
                        'type' => $request->type,
                    ]);
            }
        } else {
            DB::table('important_links')
                ->where('ID', $id)
                ->update([
                    'link' => $request->link,
                    'type' => $request->type,
                ]);
        }

        $id = $student_id->student_id;

        return Redirect::route('company.links.index', [$id])->with('status', 'link-updated');
    }
}
