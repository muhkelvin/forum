<?php

namespace App\Http\Controllers;

use App\Models\SavedPost;
use Illuminate\Http\Request;

class SavedPostController extends Controller
{
    public function save(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);

        $savedPost = SavedPost::firstOrCreate([
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,
        ]);

        return back()->with('success', 'Post saved successfully!');
    }

    public function unsave(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:saved_posts,post_id',
        ]);

        SavedPost::where('user_id', auth()->id())
            ->where('post_id', $request->post_id)
            ->delete();

        return back()->with('success', 'Post unsaved successfully!');
    }

    public function savedPosts()
    {
        $savedPosts = auth()->user()->savedPosts()->with('category', 'user')->get();

        return view('saved-posts.index', compact('savedPosts'));
    }
}
