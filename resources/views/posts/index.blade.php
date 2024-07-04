<!-- resources/views/posts/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="flex justify-center mb-3 mt-5">
        <form method="GET" action="{{ route('posts.index') }}" class="flex">
            <input type="text" name="search" class="border rounded-l-lg px-4 py-2" placeholder="Search posts" value="{{ request()->search }}">
            <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded-r-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">Search</button>
        </form>
        <div class="flex space-x-4 ms-4">
            <a href="{{ route('posts.index', ['filter' => 'latest']) }}" class="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">Latest Posts</a>
            <a href="{{ route('posts.index', ['filter' => 'new']) }}" class="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">New Posts</a>
        </div>
    </div>

    <div class="flex justify-center mb-3">
        <div class="grid gap-6 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1">
            @foreach($posts as $post)
                <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    <a href="{{ route('posts.show', $post) }}" class="block mb-2">
                        <h2 class="text-xl font-bold text-gray-900 hover:text-blue-600 transition-colors">{{ $post->title }}</h2>
                    </a>
                    <p class="text-gray-700 mb-3">{{ Str::limit($post->content, 100) }}</p>
                    <div class="flex items-center text-sm text-gray-600 mb-3">
                        <span>{{ $post->created_at->diffForHumans() }}</span>
                        <span class="ml-auto">
                            <a href="{{ route('categories.show', $post->category->id) }}" class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $post->category->name }}</a>
                            <span class="ml-auto">
                                <a href="{{ route('author.posts', $post->user) }}" class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded hover:bg-green-200">Author : {{ $post->user->name }}</a>
                            </span>
                        </span>
                    </div>
                    <div class="mt-4 flex items-center space-x-4">
                        <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Read more
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                        @if(auth()->check())
                            @if(auth()->user()->savedPosts->contains($post))
                                <form action="{{ route('unsave.post') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-500 rounded-lg hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300">
                                        Unsave
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('save.post') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <button type="submit" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                        Save
                                    </button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-6">
        {{ $posts->links() }}
    </div>
@endsection
