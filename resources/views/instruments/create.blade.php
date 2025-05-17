@extends('layouts.app')

@section('content')
    <div class="form-container">
        <h2>Add New Instrument</h2>

        @if ($errors->any())
            <div class="alert danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('instruments.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Instrument Name *</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="type">Type *</label>
                <select name="type" id="type" required>
                    <option value="">Select Type</option>
                    @foreach($types as $type)
                        <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="brand">Brand *</label>
                <input type="text" name="brand" id="brand" value="{{ old('brand') }}" required>
            </div>

            <div class="form-group">
                <label for="year_acquired">Year Acquired *</label>
                <input type="number" name="year_acquired" id="year_acquired" min="1900" max="{{ date('Y') }}" value="{{ old('year_acquired', date('Y')) }}" required>
            </div>

            <div class="form-group">
                <label for="purchase_price">Purchase Price (£)</label>
                <input type="number" name="purchase_price" id="purchase_price" min="0" step="0.01" value="{{ old('purchase_price') }}">
            </div>

            <div class="form-group">
                <label for="condition">Condition *</label>
                <select name="condition" id="condition" required>
                    <option value="">Select Condition</option>
                    @foreach($conditions as $condition)
                        <option value="{{ $condition }}" {{ old('condition') == $condition ? 'selected' : '' }}>{{ $condition }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="4">{{ old('description') }}</textarea>
            </div>

            <div class="form-group checkbox-group">
                <input type="checkbox" name="is_favorite" id="is_favorite" value="1" {{ old('is_favorite') ? 'checked' : '' }}>
                <label for="is_favorite">Mark as favorite</label>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn btn-success">Add Instrument</button>
                <a href="{{ route('instruments.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
