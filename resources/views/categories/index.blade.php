@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-6">Categories</h1>
        <a href="{{ route('categories.create') }}" class="inline-block mb-6 px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
            Create Category
        </a>
        <div class="bg-white rounded-lg shadow-lg p-6">
            @if($categories->isEmpty())
                <p class="text-gray-700">No categories found.</p>
            @else
                <ul class="space-y-4">
                    @foreach($categories as $category)
                        <li class="flex justify-between items-center">
                            <a href="{{ route('categories.show', $category->id) }}" class="text-gray-900 font-medium hover:text-blue-600">{{ $category->name }}</a>
                            <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
