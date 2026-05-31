<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

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

        return back();
    }
}