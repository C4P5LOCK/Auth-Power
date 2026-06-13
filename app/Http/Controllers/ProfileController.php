<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
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

    public function show(User $user)
{
    $posts = $user->posts()->latest()->get();

    return view('profile.show', compact('user', 'posts'));
}

    public function editprofile()
    {
        return view('profile.edit');
    }

    public function updateprofile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:500'],
            'location' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $avatarPath = Auth::user()->avatar;

        if ($request->hasFile('avatar')) {

            $avatarPath = $request->file('avatar')
                ->store('avatars', 'public');
        }
        Auth::user()->update([
            'name' => $request->name,
            'bio' => $request->bio,
            'location' => $request->location,
            'website' => $request->website,
            'avatar' => $avatarPath,
        ]);

        return redirect()
            ->route('profile.show', Auth::user())
            ->with('success', 'Profile updated successfully.');
    }

    public function followers(User $user)
        {
            $followers = $user->followers()->latest()->get();

            return view('profile.followers', compact('user', 'followers'));
        }

    public function following(User $user)
        {
            $following = $user->following()->latest()->get();

            return view('profile.following', compact('user', 'following'));
        }

}

