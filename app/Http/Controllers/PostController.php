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
             'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $imagePath = null;

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('posts', 'public');
            }

        Post::create([
            'user_id' => Auth::id(),
            'body' => $request->body,
            'image' => $imagePath
        ]);

        return back()->with('success', 'Post shared succesfully');
    }

    public function update(Request $request,Post $post){
            if($post->user_id !== Auth::id()){
                abort(403);
            }

            $request->validate([
            'body' => ['required', 'string', 'max:300'],
              ]);

            $post->update([
                'body' => $request->body,
            ]);

            return back()->with('Success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
        {
            if ($post->user_id !== Auth::id()) {
                abort(403);
            }

            $post->delete();

            return back()->with('Success', 'Post deleted successfully.');
        }
}
