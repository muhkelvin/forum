<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['content' => 'required', 'post_id' => 'required']);
        $request->merge(['user_id' => auth()->id()]);
        Comment::create($request->all());
        return back();
    }
}
