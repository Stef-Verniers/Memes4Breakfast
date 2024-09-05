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
        $defaults = Avatar::where('is_exclusive', 0)->where('is_premium', 0)->where('is_admin', 0)->get();
        $premiums = Avatar::where('is_premium', 1)->orderBy('price', 'asc')->get();
        $exclusives = Avatar::where('is_exclusive', 1)->get();

        return view('profile.edit', [
            'user' => $request->user(),
        ], compact('defaults', 'premiums', 'exclusives'));

    }

    /**
     * Allows users to update their avatar
     */
    public function choose(Request $request) 
    {   

        $user = Auth::user();
        $newAvatar = intval($request->get('avatarId'));
        $price = Avatar::where('id', $newAvatar)->pluck('price')->first();

        if ($user->score >= $price) {

            DB::table('users')
            ->where('id', $user->id)
            ->update(array(
                'avatar_id' => $newAvatar,
                'avatar_fallback' => $newAvatar
            ));
            return Redirect::route('profile.edit')->with('status', 'profile-updated');

        } else {

            return back();

        }
    
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

    public function awardAvatar() {

        $topFive = User::all()->orderBy('score', 'desc')->limit(6);
        dd($topFive);

    }
}
