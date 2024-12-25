@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Add New Court</h1>

    <!-- Form to add a new court with image upload -->
    <form action="{{ route('admin.courts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="court_name">Court Name</label>
            <input type="text" class="form-control" id="court_name" name="court_name" required>
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>

        <div class="form-group">
            <label for="capacity">Capacity</label>
            <input type="number" class="form-control" id="capacity" name="capacity" required>
        </div>

        <div class="form-group">
            <label for="price_per_hour">Price Per Hour</label>
            <input type="number" class="form-control" id="price_per_hour" name="price_per_hour" required>
        </div>

        <!-- Category Dropdown -->
        <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">Court Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Add Court</button>
    </form>
</div>
@endsection
