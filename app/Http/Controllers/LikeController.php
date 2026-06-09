<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PostLikedNotification;

class LikeController extends Controller
{
    public function toggle(Post $post)
    {
        $existingLike = Like::where('user_id', Auth::id())
            ->where('post_id', $post->id)
            ->first();

        if ($existingLike) {
            $existingLike->delete();

            return back();
        }

        Like::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
        ]);

        // Don't notify yourself
    if ($post->user_id !== Auth::id()) {

    //dd('before notify');
        $post->user->notify(
            new PostLikedNotification(
                Auth::user(),
                $post
            )
        );

        //dd('after notify');
    }

    //dd($post->user_id, Auth::id());
        return back();
    }
}