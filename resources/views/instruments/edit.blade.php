@extends('layouts.app')

@section('content')
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Edit Instrument: {{ $instrument->name }}</h2>
        </div>

        <div class="p-6">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded mb-6">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('instruments.update', $instrument) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700">Instrument Name *</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $instrument->name) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors duration-200">
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Type *</label>
                        <select name="type" id="type" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors duration-200">
                            @foreach($types as $type)
                                <option value="{{ $type }}" {{ old('type', $instrument->type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="brand" class="block text-sm font-medium text-gray-700">Brand *</label>
                        <input type="text" name="brand" id="brand" value="{{ old('brand', $instrument->brand) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors duration-200">
                    </div>

                    <div>
                        <label for="year_acquired" class="block text-sm font-medium text-gray-700">Year Acquired *</label>
                        <input type="number" name="year_acquired" id="year_acquired" min="1900" max="{{ date('Y') }}"
                               value="{{ old('year_acquired', $instrument->year_acquired) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors duration-200">
                    </div>

                    <div>
                        <label for="purchase_price" class="block text-sm font-medium text-gray-700">Purchase Price (£)</label>
                        <input type="number" name="purchase_price" id="purchase_price" min="0" step="0.01"
                               value="{{ old('purchase_price', $instrument->purchase_price) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors duration-200">
                    </div>

                    <div>
                        <label for="condition" class="block text-sm font-medium text-gray-700">Condition *</label>
                        <select name="condition" id="condition" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors duration-200">
                            @foreach($conditions as $condition)
                                <option value="{{ $condition }}" {{ old('condition', $instrument->condition) == $condition ? 'selected' : '' }}>{{ $condition }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="4"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors duration-200">{{ old('description', $instrument->description) }}</textarea>
                    </div>

                    <div class="md:col-span-2">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_favorite" id="is_favorite" value="1"
                                   {{ old('is_favorite', $instrument->is_favorite) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors duration-200">
                            <label for="is_favorite" class="ml-2 text-sm text-gray-700">Mark as favorite</label>
                        </div>
                    </div>

                    @if($categories->count() > 0)
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Categories</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                                @foreach($categories as $category)
                                    <div class="flex items-center p-2 rounded hover:bg-gray-100 transition-colors duration-200">
                                        <input type="checkbox" name="categories[]" id="category-{{ $category->id }}"
                                               value="{{ $category->id }}"
                                               {{ in_array($category->id, old('categories', $instrument->categories->pluck('id')->toArray())) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors duration-200">
                                        <label for="category-{{ $category->id }}" class="ml-2 text-sm text-gray-700 cursor-pointer">{{ $category->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Select one or more categories for this instrument</p>
                        </div>
                    @endif
                </div>

                <!-- Styled Action Buttons -->
                <div class="mt-8 flex justify-between items-center">
                    <!-- Back Link -->
                    <a href="{{ route('instruments.show', $instrument) }}"
                       class="inline-flex items-center text-gray-600 hover:text-gray-800 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Details
                    </a>

                    <!-- Action Buttons -->
                    <div class="flex space-x-3">
                        <a href="{{ route('instruments.index') }}"
                           class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Cancel
                        </a>

                        <button type="submit"
                                class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-105">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Update Instrument
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Additional styling for better UX -->
    <style>
        /* Custom focus styles for better accessibility */
        input:focus, select:focus, textarea:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Hover effects for checkboxes */
        input[type="checkbox"]:hover {
            transform: scale(1.05);
        }

        /* Custom button animations */
        button:hover, .inline-flex:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Form section styling */
        .grid > div {
            position: relative;
        }

        /* Label animations */
        label {
            transition: color 0.2s ease-in-out;
        }

        input:focus + label,
        select:focus + label,
        textarea:focus + label {
            color: #3B82F6;
        }
    </style>
@endsection
