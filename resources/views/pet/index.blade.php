@extends('layout')

@section('title', 'List of Pets')

@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif

@if(Session::has('success_delete'))
    <div class="alert alert-success">
        {{ Session::get('success_delete') }}
    </div>
@endif

@if(Session::has('exception'))
    <div class="alert alert-exception">
        {{ Session::get('exception') }}
    </div>
@endif

@section('content')
    @include('pet.filter')

    <h1>List of Pets</h1>
    <div style="margin-bottom: 20px;">
        <a href="{{ route('pet.create') }}" class="btn btn-primary">Add New Pet</a>
    </div>

    <table style="border-collapse: collapse; width: 100%;">
        <thead>
        <tr>
            <th style="border: 1px solid black; padding: 8px;">ID</th>
            <th style="border: 1px solid black; padding: 8px;">Name</th>
            <th style="border: 1px solid black; padding: 8px;">Category</th>
            <th style="border: 1px solid black; padding: 8px;">Tags</th>
            <th style="border: 1px solid black; padding: 8px;">Status</th>
            <th style="border: 1px solid black; padding: 8px;">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($pets as $pet)
            <tr>
                <td style="border: 1px solid black; padding: 8px;">{{ $pet->id }}</td>
                <td style="border: 1px solid black; padding: 8px;">{{ $pet->name ?? 'N/A' }}</td>
                <td style="border: 1px solid black; padding: 8px;">{{ $pet->category ? $pet->category->name : 'N/A' }}</td>
                <td style="border: 1px solid black; padding: 8px;">
                    @foreach($pet->tags as $tag)
                        {{ $tag->name ?? 'N/A' }}@if (!$loop->last), @endif
                    @endforeach
                </td>
                <td style="border: 1px solid black; padding: 8px;">{{ $pet->status }}</td>
                <td style="border: 1px solid black; padding: 8px;" class="actions">
                    <form method="post" action="{{ route('pet.delete', ['id' => $pet->id]) }}" onsubmit="return confirm('Are you sure you want to delete this pet?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="{{ route('pet.edit', ['id' => $pet->id]) }}" class="btn btn-primary" style="display: inline-block;">Edit</a>
                </td>
            </tr>
            <tr><td colspan="6" style="border: 1px solid black;"><hr style="border: none; height: 1px; background-color: black;"></td></tr>
        @empty
            <tr>
                <td colspan="6" style="border: 1px solid black; padding: 8px; text-align: center;">No results found</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
