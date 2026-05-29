<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    //
    public function store(Request $request){
        $request->validate([
            'body' => ['required','string','max:500'],
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'body' => $request->body
        ]);

        return back()->with('success', 'Post shared succesfully');
    }
}
