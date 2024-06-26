@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Categories</h1>
        <a href="{{ route('categories.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600">Create Category</a>
        <ul class="bg-white rounded-lg shadow-md p-4">
            @forelse($categories as $category)
                <li class="mb-2">{{ $category->name }}</li>
            @empty
                <li>No categories found.</li>
            @endforelse
        </ul>
    </div>
@endsection
