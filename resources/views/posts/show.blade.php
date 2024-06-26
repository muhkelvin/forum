@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <p class="text-gray-700">{{ $post->content }}</p>
            <div class="mt-4 flex justify-between text-sm text-gray-500">
                <p>Category: {{ $post->category->name }}</p>
                <p>Author: {{ $post->user->name }}</p>
            </div>
        </div>

        <h2 class="text-xl font-bold mb-2">Comments</h2>
        <ul class="bg-white rounded-lg shadow-md p-4 mb-6">
            @forelse($post->comments as $comment)
                <li class="mb-2">
                    <p class="text-gray-700">{{ $comment->content }}</p>
                    <p class="text-sm text-gray-500">By {{ $comment->user->name }}</p>
                </li>
            @empty
                <li>No comments yet.</li>
            @endforelse
        </ul>

        <form action="{{ route('comments.store') }}" method="POST" class="bg-white rounded-lg shadow-md p-6">
            @csrf
            <textarea name="content" placeholder="Add a comment" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300">Comment</button>
        </form>
    </div>
@endsection
