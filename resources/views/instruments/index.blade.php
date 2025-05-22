@extends('layouts.app')

@section('content')
    <div class="header-section">
        <h2>My Instruments</h2>
        <a href="{{ route('instruments.create') }}" class="btn">Add New Instrument</a>
    </div>

    <div class="search-form">
        <form action="{{ route('instruments.index') }}" method="GET" style="display: flex; gap: 0.5rem; width: 100%;">
            <input type="text" name="search" placeholder="Search instruments..." value="{{ request('search') }}">
            <button type="submit" class="btn">Search</button>
            @if(request('search'))
                <a href="{{ route('instruments.index') }}" class="btn btn-secondary">Clear</a>
            @endif
        </form>
    </div>

    @if($instruments->count() > 0)
        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Brand</th>
                <th>Year</th>
                <th>Condition</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($instruments as $instrument)
                <tr>
                    <td>
                        @if($instrument->is_favorite) ⭐ @endif
                        {{ $instrument->name }}
                    </td>
                    <td>{{ $instrument->type }}</td>
                    <td>{{ $instrument->brand }}</td>
                    <td>{{ $instrument->year_acquired }}</td>
                    <td>{{ $instrument->condition }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('instruments.show', $instrument) }}">View</a>
                            <a href="{{ route('instruments.edit', $instrument) }}">Edit</a>
                            <form action="{{ route('instruments.destroy', $instrument) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div style="margin-top: 1rem;">
            {{ $instruments->appends(request()->query())->links() }}
        </div>
    @else
        <div class="text-center py-8">
            <p class="text-gray-500 mb-4">
                @if(request('search'))
                    No instruments found matching "{{ request('search') }}".
                @else
                    No instruments in your collection yet.
                @endif
            </p>
            <a href="{{ route('instruments.create') }}" class="btn">Add New Instrument</a>
        </div>
    @endif
@endsection
