<?php

namespace App\Http\Controllers\HR;
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
        ->join('hr_admin', 'users.ID', '=', 'hr_admin.user_id')
        ->select('hr_admin.*', 'users.*')
        ->get();
        return view('hr.profile.edit', [
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
        DB::table('hr_admin')
        ->where('user_id', Auth::user()->id)
        ->update([
            'mobile' => $request->mobile,
    ]);

        return Redirect::route('hr.profile.edit')->with('status', 'profile-updated');
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
