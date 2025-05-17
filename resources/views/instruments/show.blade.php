@extends('layouts.app')

@section('content')
    <div class="gear-details">
        <h2>{{ $instrument->name }}</h2>

        <div class="info-block">
            <h3>Basic Info</h3>
            <div class="info-row">
                <div class="info-label">Name:</div>
                <div class="info-value">{{ $instrument->name }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Type:</div>
                <div class="info-value">{{ $instrument->type }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Brand:</div>
                <div class="info-value">{{ $instrument->brand }}</div>
            </div>
        </div>

        <div class="info-block">
            <h3>Purchase Info</h3>
            <div class="info-row">
                <div class="info-label">Year Got:</div>
                <div class="info-value">{{ $instrument->year_acquired }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Price:</div>
                <div class="info-value">
                    @if($instrument->purchase_price)
                        £{{ number_format($instrument->purchase_price, 2) }}
                    @else
                        Unknown
                    @endif
                </div>
            </div>
        </div>

        <div class="info-block">
            <h3>More Details</h3>
            <div class="info-row">
                <div class="info-label">Condition:</div>
                <div class="info-value">{{ $instrument->condition }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Favorite:</div>
                <div class="info-value">{{ $instrument->is_favorite ? 'Yes' : 'No' }}</div>
            </div>
            @if($instrument->description)
                <div class="info-row">
                    <div class="info-label">Notes:</div>
                    <div class="info-value">{{ $instrument->description }}</div>
                </div>
            @endif
        </div>

        <div class="action-btns">
            <a href="{{ route('instruments.edit', $instrument) }}" class="btn main-btn">Edit</a>
            <form action="{{ route('instruments.destroy', $instrument) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn danger-btn">Delete</button>
            </form>
        </div>

        <div class="back-link">
            <a href="{{ route('instruments.index') }}">&larr; Back to my gear</a>
        </div>
    </div>
@endsection
