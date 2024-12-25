@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Add New Category</h1>

    <!-- Form to add new category -->
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        
        <!-- Category Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div> <!-- Display validation errors -->
            @enderror
        </div>

        <!-- Category Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div> <!-- Display validation errors -->
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">Save Category</button>
    </form>
</div>
@endsection
