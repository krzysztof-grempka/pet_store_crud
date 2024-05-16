@extends('layout')

@section('title', 'Add New Pet')

@section('content')
    <h1>Add New Pet</h1>
    <form method="post" action="{{ route('pet.store') }}">
        @csrf
        <div class="form-group">
            <label for="category">Category:</label>
            <select id="category" name="category" class="form-control" required>
                <option value="" disabled selected>Select category</option>
                @foreach(\App\Domain\Enum\PetCategory::allCategories() as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Enter name" required>
        </div>
        <div class="form-group">
            <label for="tags">Tags:</label>
            <input type="text" id="tags" name="tags" class="form-control" placeholder="Enter tags">
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" name="status" class="form-control" required>
                <option value="" disabled selected>Select status</option>
                @foreach(\App\Domain\Enum\PetStatus::allStatuses() as $status)
                    <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
            </select>
        </div>
        <a href="{{ route('pet.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
