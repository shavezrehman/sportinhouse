@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Edit Court</h1>
    <form action="{{ route('admin.courts.update', $court->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="court_name" class="form-label">Court Name</label>
            <input type="text" name="court_name" class="form-control" value="{{ $court->court_name }}" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" class="form-control" value="{{ $court->location }}" required>
        </div>
        <div class="mb-3">
            <label for="capacity" class="form-label">Capacity</label>
            <input type="number" name="capacity" class="form-control" value="{{ $court->capacity }}" required>
        </div>
        <div class="mb-3">
            <label for="price_per_hour" class="form-label">Price Per Hour</label>
            <input type="number" step="0.01" name="price_per_hour" class="form-control" value="{{ $court->price_per_hour }}" required>
        </div>
        
        <!-- Category Dropdown -->
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $court->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Court Image</label>
            <input type="file" name="image" class="form-control">
            
            @if($court->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $court->image) }}" alt="Court Image" width="200">
                </div>
            @endif
        </div>        
        <button type="submit" class="btn btn-primary">Update Court</button>
    </form>
</div>
@endsection
