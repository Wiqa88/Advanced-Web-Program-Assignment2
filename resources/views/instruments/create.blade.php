@extends('layouts.app')

@section('content')
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Add New Instrument</h2>
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

            <form action="{{ route('instruments.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700">Instrument Name *</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Type *</label>
                        <select name="type" id="type" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Select Type</option>
                            @foreach($types as $type)
                                <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="brand" class="block text-sm font-medium text-gray-700">Brand *</label>
                        <input type="text" name="brand" id="brand" value="{{ old('brand') }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="year_acquired" class="block text-sm font-medium text-gray-700">Year Acquired *</label>
                        <input type="number" name="year_acquired" id="year_acquired" min="1900" max="{{ date('Y') }}"
                               value="{{ old('year_acquired', date('Y')) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="purchase_price" class="block text-sm font-medium text-gray-700">Purchase Price (£)</label>
                        <input type="number" name="purchase_price" id="purchase_price" min="0" step="0.01"
                               value="{{ old('purchase_price') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="condition" class="block text-sm font-medium text-gray-700">Condition *</label>
                        <select name="condition" id="condition" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Select Condition</option>
                            @foreach($conditions as $condition)
                                <option value="{{ $condition }}" {{ old('condition') == $condition ? 'selected' : '' }}>{{ $condition }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="4"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
                    </div>

                    <div class="md:col-span-2">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_favorite" id="is_favorite" value="1"
                                   {{ old('is_favorite') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <label for="is_favorite" class="ml-2 text-sm text-gray-700">Mark as favorite</label>
                        </div>
                    </div>

                    @if($categories->count() > 0)
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Categories</label>
                            <div class="mt-2 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($categories as $category)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="categories[]" id="category-{{ $category->id }}"
                                               value="{{ $category->id }}"
                                               {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <label for="category-{{ $category->id }}" class="ml-2 text-sm text-gray-700">{{ $category->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="mt-8 flex justify-end space-x-3">
                    <a href="{{ route('instruments.index') }}"
                       class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition-colors">Cancel</a>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">Add Instrument</button>
                </div>
            </form>
        </div>
    </div>
@endsection
