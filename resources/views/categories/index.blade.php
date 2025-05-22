@extends('layouts.app')

@section('content')
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-900">My Categories</h2>
                <a href="{{ route('categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                    Create New Category
                </a>
            </div>
        </div>

        <div class="p-6">
            @if($categories->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($categories as $category)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h3 class="font-medium text-gray-900 mb-2">{{ $category->name }}</h3>

                            @if($category->description)
                                <p class="text-gray-600 text-sm mb-3">{{ Str::limit($category->description, 100) }}</p>
                            @endif

                            <p class="text-gray-500 text-sm mb-3">{{ $category->instruments->count() }} instruments</p>

                            <div class="flex justify-between text-sm">
                                <a href="{{ route('categories.show', $category) }}" class="text-blue-600 hover:text-blue-800">View</a>
                                <div class="space-x-2">
                                    <a href="{{ route('categories.edit', $category) }}" class="text-purple-600 hover:text-purple-800">Edit</a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-500 mb-4">You haven't created any categories yet.</p>
                    <a href="{{ route('categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Create New Category
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
