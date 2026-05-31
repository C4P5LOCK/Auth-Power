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

        return back()->with('success','Comment added succesfully.');
    }
}
