@extends('layouts.app')

@section('content')
    <div class="grid gap-6 lg:grid-cols-3 md:grid-cols-2 mb-3 sm:grid-cols-1">
        @foreach($posts as $post)
            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-lg">
                <a href="{{ route('posts.show', $post) }}">
                    <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $post->title }}</h2>
                </a>
                <p class="text-gray-700 mb-3">{{ $post->content }}</p>
                <div class="flex items-center">
                    <span class="text-sm text-gray-600">{{ $post->created_at->diffForHumans() }}</span>
                    <span class="ml-auto">
                        <span class="badge badge-secondary">{{ $post->category->name }}</span>
                        <span class="badge badge-info">{{ $post->user->name }}</span>
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
@endsection
