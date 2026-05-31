<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //
    public function store(Request $request, Post $post){
        $request->validate([
            'body' => ['required','string','max:300'],
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'body' =>$request->body
        ]);

        return back()->with('Success','Comment added succesfully.');
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

    public function destroy(Comment $comment){
        if ($comment->user_id !== Auth::id()){
            abort(403);
        }
        $comment->delete();

        return back()->with('Success','Comment Deleted');
    }

}
