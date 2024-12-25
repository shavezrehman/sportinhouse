@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Category</h2>

    <!-- Form to update category -->
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Category Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div> <!-- Display validation errors -->
            @enderror
        </div>

        <!-- Optional Category Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div> <!-- Display validation errors -->
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>
@endsection
