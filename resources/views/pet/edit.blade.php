@extends('layout')

@section('title', 'Edit Pet')

@section('content')
    <h1>Edit Pet</h1>
    <form method="post" action="{{ route('pet.update', ['id' => $pet['id']]) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="ID">ID:</label>
            <input type="text" id="ID" name="id" class="form-control" value="{{ $pet['id'] }}" readonly>
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <select id="category" name="category" class="form-control">
                @foreach(\App\Domain\Enum\PetCategory::allCategories() as $category)
                    <option value="{{ $category }}" {{ $pet['category']['name'] === $category ? 'selected' : '' }}>{{ $category }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $pet['name'] }}" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="tags">Tags:</label>
            <input type="text" id="tags" name="tags" class="form-control" placeholder="Enter tags">
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" name="status" class="form-control">
                @foreach(\App\Domain\Enum\PetStatus::allStatuses() as $status)
                    <option value="{{ $status }}" {{ $pet['status'] === $status ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
            </select>
        </div>
        <a href="{{ route('pet.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
