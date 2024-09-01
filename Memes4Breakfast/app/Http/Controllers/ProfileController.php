<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Avatar;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // Select all avatars with corresponding categories and push them to the view
        $defaults = Avatar::where('is_exclusive', 0)->where('is_premium', 0)->get();
        $premiums = Avatar::where('is_premium', 1)->get();
        $exclusives = Avatar::where('is_exclusive', 1)->get();

        // $currentAvatar = User::where('avatar_id')->get

        return view('profile.edit', [
            'user' => $request->user(),
        ], compact('defaults', 'premiums', 'exclusives'));
    }

    public function choose(Request $request) 
    {   
        $user = Auth::user();
        $newAvatar = intval($request->get('avatarId'));

        DB::table('users')
              ->where('id', $user->id)
              ->update(['avatar_id' => $newAvatar]);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
