@extends('layouts.app')

@section('content')
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                {{ $instrument->name }}
                @if($instrument->is_favorite)
                    <span class="ml-2 text-yellow-400">⭐</span>
                @endif
            </h2>

            <div class="flex space-x-2">
                <a href="{{ route('instruments.edit', $instrument) }}"
                   class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition-colors">Edit</a>
                <form action="{{ route('instruments.destroy', $instrument) }}" method="POST" class="inline"
                      onsubmit="return confirm('Are you sure you want to delete this instrument?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition-colors">Delete</button>
                </form>
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-bold text-lg text-gray-700 mb-3 pb-2 border-b border-gray-200">Basic Info</h3>

                    <div class="space-y-2">
                        <div class="flex">
                            <span class="w-32 font-medium text-gray-600">Type:</span>
                            <span>{{ $instrument->type }}</span>
                        </div>

                        <div class="flex">
                            <span class="w-32 font-medium text-gray-600">Brand:</span>
                            <span>{{ $instrument->brand }}</span>
                        </div>

                        <div class="flex">
                            <span class="w-32 font-medium text-gray-600">Condition:</span>
                            <span>{{ $instrument->condition }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-bold text-lg text-gray-700 mb-3 pb-2 border-b border-gray-200">Purchase Info</h3>

                    <div class="space-y-2">
                        <div class="flex">
                            <span class="w-32 font-medium text-gray-600">Year Acquired:</span>
                            <span>{{ $instrument->year_acquired }}</span>
                        </div>

                        <div class="flex">
                            <span class="w-32 font-medium text-gray-600">Price:</span>
                            <span>
                            @if($instrument->purchase_price)
                                    £{{ number_format($instrument->purchase_price, 2) }}
                                @else
                                    Not specified
                                @endif
                        </span>
                        </div>
                    </div>
                </div>

                @if($instrument->description)
                    <div class="md:col-span-2 bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-bold text-lg text-gray-700 mb-3 pb-2 border-b border-gray-200">Description</h3>
                        <p class="whitespace-pre-line">{{ $instrument->description }}</p>
                    </div>
                @endif

                @if($instrument->categories->count() > 0)
                    <div class="md:col-span-2 bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-bold text-lg text-gray-700 mb-3 pb-2 border-b border-gray-200">Categories</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($instrument->categories as $category)
                                <a href="{{ route('categories.show', $category) }}"
                                   class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm hover:bg-blue-200">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="mt-8">
                <a href="{{ route('instruments.index') }}" class="text-blue-600 hover:text-blue-800">&larr; Back to all instruments</a>
            </div>
        </div>
    </div>
@endsection
