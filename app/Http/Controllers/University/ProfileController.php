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
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        //get full user
        $user = DB::table('users')
        ->where('users.ID','=',Auth::user()->id)
        ->join('university_mentor', 'users.ID', '=', 'university_mentor.user_id')
        ->select('university_mentor.*', 'users.*')
        ->get();
        return view('university.profile.edit', [
            'user' => $user[0],
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        // add all data
        DB::table('university_mentor')
        ->where('user_id', Auth::user()->id)
        ->update([
            'mobile' => $request->mobile,
            'university' => $request->university,
    ]);

        return Redirect::route('university.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
