<!-- resources/views/authors/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-6">Posts by {{ $user->name }}</h1>
        @if($posts->isEmpty())
            <p class="text-gray-700">No posts found for this author.</p>
        @else
            <div class="grid gap-6 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1">
                @foreach($posts as $post)
                    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                        <a href="{{ route('posts.show', $post) }}" class="block mb-2">
                            <h2 class="text-xl font-bold text-gray-900 hover:text-blue-600 transition-colors">{{ $post->title }}</h2>
                        </a>
                        <p class="text-gray-700 mb-3">{{ Str::limit($post->content, 100) }}</p>
                        <div class="flex items-center text-sm text-gray-600 mb-3">
                            <span>{{ $post->created_at->diffForHumans() }}</span>
                            <span class="ml-auto">
                                <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $post->category->name }}</span>
                            </span>
                        </div>
                        <div class="mt-4 flex items-center space-x-4">
                            <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                Read more
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-6">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection
