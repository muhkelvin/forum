@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Create Category</h1>
        <form action="{{ route('categories.store') }}" method="POST" class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                <input type="text" id="name" name="name" placeholder="Category Name" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300">Create</button>
        </form>
    </div>
@endsection
