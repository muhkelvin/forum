@extends('layouts.app')

@section('content')
    <h1 class="text-center mb-6 text-2xl font-bold">Create Post</h1>
    <form action="{{ route('posts.store') }}" method="POST" class="max-w-md mx-auto bg-white p-6 shadow-md rounded-lg">
        @csrf
        <div class="grid gap-6">
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Post Title</label>
                <input type="text" id="title" name="title" placeholder="Post Title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            </div>
            <div>
                <label for="content" class="block mb-2 text-sm font-medium text-gray-900">Post Content</label>
                <textarea name="content" id="content" placeholder="Post Content" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 h-32 resize-none" required></textarea>
            </div>
            <div>
                <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                <select name="category_id" id="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="mt-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full py-2.5 text-center">Create</button>
    </form>
@endsection
