@extends('layouts.app')

@section('title', 'Edit ' . $instrument->name)

@section('content')
    <div class="form-container">
        <h2>Edit Instrument</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('instruments.update', $instrument) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name*</label>
                <input type="text" name="name" id="name" value="{{ old('name', $instrument->name) }}" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="type">Type*</label>
                    <select name="type" id="type" required>
                        {{-- Remove the "Select Type" option to avoid "please select" issue --}}
                        @foreach($types as $type)
                            <option value="{{ $type }}" {{ old('type', $instrument->type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="brand">Brand*</label>
                    <input type="text" name="brand" id="brand" value="{{ old('brand', $instrument->brand) }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="year_acquired">Year Acquired*</label>
                    <input type="number" name="year_acquired" id="year_acquired" min="1900" max="{{ date('Y') }}" value="{{ old('year_acquired', $instrument->year_acquired) }}" required>
                </div>

                <div class="form-group">
                    <label for="purchase_price">Purchase Price (£)</label>
                    <input type="number" name="purchase_price" id="purchase_price" min="0" step="0.01" value="{{ old('purchase_price', $instrument->purchase_price) }}">
                </div>
            </div>

            <div class="form-group">
                <label for="condition">Condition*</label>
                <select name="condition" id="condition" required>
                    {{-- Remove the "Select Condition" option to avoid "please select" issue --}}
                    @foreach($conditions as $condition)
                        <option value="{{ $condition }}" {{ old('condition', $instrument->condition) == $condition ? 'selected' : '' }}>{{ $condition }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="4">{{ old('description', $instrument->description) }}</textarea>
            </div>

            <div class="form-group checkbox-group">
                <input type="checkbox" name="is_favorite" id="is_favorite" value="1" {{ old('is_favorite', $instrument->is_favorite) ? 'checked' : '' }}>
                <label for="is_favorite">Mark as favorite</label>
            </div>

            <div class="form-buttons">
                <button type="submit" class="submit-btn">Update Instrument</button>
                <a href="{{ route('instruments.index') }}" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
@endsection
