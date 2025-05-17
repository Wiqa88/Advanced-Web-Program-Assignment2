@extends('layouts.app')

@section('content')
    <div class="top-section">
        <h2>My Music Gear</h2>

        <div class="search-box">
            <form action="{{ route('instruments.index') }}" method="GET">
                <input type="text" name="search" placeholder="Find something..." value="{{ request('search') }}">
                <button type="submit" class="btn main-btn">Search</button>
            </form>
            @if(request()->has('search'))
                <a href="{{ route('instruments.index') }}" class="btn alt-btn">Clear</a>
            @endif
        </div>
    </div>

    @if($instruments->count() > 0)
        <table class="gear-list">
            <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Brand</th>
                <th>Year</th>
                <th>Condition</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
            @foreach($instruments as $gear)
                <tr>
                    <td>{{ $gear->name }}</td>
                    <td>{{ $gear->type }}</td>
                    <td>{{ $gear->brand }}</td>
                    <td>{{ $gear->year_acquired }}</td>
                    <td>{{ $gear->condition }}</td>
                    <td class="action-btns">
                        <a href="{{ route('instruments.show', $gear) }}" class="btn main-btn">Details</a>
                        <a href="{{ route('instruments.edit', $gear) }}" class="btn alt-btn">Change</a>
                        <form action="{{ route('instruments.destroy', $gear) }}" method="POST" onsubmit="return confirm('Sure you want to get rid of this?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn danger-btn">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="page-links">
            {{ $instruments->appends(request()->except('page'))->links() }}
        </div>
    @else
        <div class="empty-message">
            <p>No gear found. {{ request()->has('search') ? 'Try a different search.' : 'Add your first piece to get started!' }}</p>
            <a href="{{ route('instruments.create') }}" class="btn main-btn">Add New Gear</a>
        </div>
    @endif
@endsection
