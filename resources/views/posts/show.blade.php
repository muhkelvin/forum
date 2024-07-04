@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-8">
        <div class="mb-6">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>
            <div class="flex items-center text-gray-500 mb-4">
                <span class="mr-2">{{ $post->created_at->diffForHumans() }}</span>
                <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">category : {{ $post->category->name }}</span>
                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Author : {{ $post->user->name }}</span>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <p class="text-gray-700 leading-relaxed">{{ $post->body }}</p>
        </div>

        <h2 class="text-2xl font-bold text-gray-900 mb-4">Comments</h2>
        <div class="bg-white rounded-lg shadow-lg p-4 mb-6">
            @forelse($post->comments as $comment)
                <div class="mb-4 pb-4 border-b border-gray-200">
                    <p class="text-gray-700">{{ $comment->content }}</p>
                    <p class="text-sm text-gray-500 mt-2">By {{ $comment->user->name }} &bull; {{ $comment->created_at->diffForHumans() }}</p>
                </div>
            @empty
                <p class="text-gray-700">No comments yet.</p>
            @endforelse
        </div>

        <h2 class="text-2xl font-bold text-gray-900 mb-4">Add a Comment</h2>
        <form action="{{ route('comments.store') }}" method="POST" class="bg-white rounded-lg shadow-lg p-6">
            @csrf
            <textarea name="content" placeholder="Add a comment" class="w-full h-32 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 mb-4"></textarea>
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300">Comment</button>
        </form>
    </div>
@endsection
