<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PostCommentedNotification;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => ['required', 'string', 'max:300'],
        ]);

        
        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'body' => $request->body,
        ]);

        if ($post->user_id !== Auth::id()) {
            $post->user->notify(
                new PostCommentedNotification(Auth::user(), $post)
            );
            // dd($post->user->id, Auth::id(), 'comment notification sent');
        }
    

        return back()->with('success', 'Comment added successfully.');
    }

    public function update(Request $request, Comment $comment)
    {
        if ($comment->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'body' => ['required', 'string', 'max:300'],
        ]);

        $comment->update([
            'body' => $request->body,
        ]);

        return back()->with('success', 'Comment updated successfully.');
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== Auth::id()) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted successfully.');
    }
}