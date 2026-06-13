<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function toggle(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('success', 'You cannot follow yourself.');
        }

        $authUser = Auth::user();

        if ($authUser->following()->where('following_id', $user->id)->exists()) {
            $authUser->following()->detach($user->id);

            return back()->with('success', 'User unfollowed.');
        }

        $authUser->following()->attach($user->id);

        return back()->with('success', 'User followed.');
    }
}