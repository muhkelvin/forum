@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-5">

        {{-- Container untuk membuat layout horizontal --}}
        <div class="flex flex-wrap gap-4 justify-center">
            @forelse($savedPosts as $savedPost)
                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-lg mb-4">
                    <div class="p-6">
                        <a href="{{ route('posts.show', $savedPost->id) }}">
                            <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $savedPost->title }}</h2>
                        </a>
                        <div class="flex items-center mb-2">
                            <span class="badge badge-secondary mr-2">{{ $savedPost->category->name }}</span>
                            <span class="badge badge-info">{{ $savedPost->user->name }}</span>
                        </div>
                        <p class="text-gray-700">{{ $savedPost->content }}</p>
                        <a href="{{ route('posts.show', $savedPost->id) }}" class="inline-flex items-center mt-4 px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Read more
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                    </div>
                    {{-- Tombol Simpan --}}
                    @if(auth()->check())
                        @if(auth()->user()->savedPosts->contains($savedPost))
                            <form action="{{ route('unsave.post') }}" method="POST" class="p-4 bg-gray-100 border-t border-gray-200">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $savedPost->id }}">
                                <button type="submit" class="btn btn-danger w-full">Unsave</button>
                            </form>
                        @else
                            <form action="{{ route('save.post') }}" method="POST" class="p-4 bg-gray-100 border-t border-gray-200">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $savedPost->id }}">
                                <button type="submit" class="btn btn-primary w-full">Save</button>
                            </form>
                        @endif
                    @endif
                </div>
            @empty
                <p class="mx-auto">You haven't saved any posts yet.</p>
            @endforelse
        </div>
    </div>
@endsection
