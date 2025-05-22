@extends('layouts.app')

@section('content')
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-900">{{ $category->name }}</h2>

            <div class="flex space-x-2">
                <a href="{{ route('categories.edit', $category) }}"
                   class="inline-flex items-center px-4 py-2 bg-purple-600 text-white text-sm rounded hover:bg-purple-700 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline"
                      onsubmit="return confirm('Are you sure you want to delete this category?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <div class="p-6">
            @if($category->description)
                <div class="bg-blue-50 p-4 rounded-lg mb-6 border border-blue-200">
                    <h3 class="font-semibold text-blue-900 mb-2">Description</h3>
                    <p class="text-blue-800">{{ $category->description }}</p>
                </div>
            @endif

            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                Instruments in this Category
                <span class="text-sm font-normal text-gray-500">({{ $instruments->count() }} items)</span>
            </h3>

            @if($instruments->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Brand</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($instruments as $instrument)
                            <tr class="hover:bg-gray-50 {{ $instrument->is_favorite ? 'bg-yellow-50' : '' }}">
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex items-center">
                                        @if($instrument->is_favorite)
                                            <span class="mr-2 text-yellow-400">⭐</span>
                                        @endif
                                        <span class="font-medium text-gray-900">{{ $instrument->name }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $instrument->type }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $instrument->brand }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $instrument->year_acquired }}</td>
                                <td class="px-4 py-3 text-right text-sm">
                                    <a href="{{ route('instruments.show', $instrument) }}"
                                       class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8 bg-gray-50 rounded-lg border border-gray-200">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No instruments in this category</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by adding some instruments to this category.</p>
                    <div class="mt-6">
                        <a href="{{ route('instruments.create') }}"
                           class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                            Add New Instrument
                        </a>
                    </div>
                </div>
            @endif

            <div class="mt-8">
                <a href="{{ route('categories.index') }}"
                   class="inline-flex items-center text-gray-600 hover:text-gray-800 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to all categories
                </a>
            </div>
        </div>
    </div>
@endsection
