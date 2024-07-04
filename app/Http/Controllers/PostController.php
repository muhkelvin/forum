<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('category', 'user');

        // Pencarian berdasarkan judul atau konten
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('body', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan urutan terbaru atau terlama
        if ($request->has('filter')) {
            if ($request->filter == 'latest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($request->filter == 'new') {
                $query->orderBy('created_at', 'asc');
            }
        }

        $posts = $query->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request,Post $post)
    {
        $request->validate(['title' => 'required', 'body' => 'required', 'category_id' => 'required']);
        $request->merge(['user_id' => auth()->id()]);
//        Post::create($request->all());
        $post->create($request->all());
        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }


}
