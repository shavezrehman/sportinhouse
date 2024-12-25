@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Courts List</h1>

    <!-- Button to add a new court -->
    <a href="{{ route('admin.courts.create') }}" class="btn btn-success mb-3">Add New Court</a>

    <!-- Success message for actions -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Courts table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Location</th>
                <th>Capacity</th>
                <th>Price Per Hour</th>
                <th>Category</th> <!-- New column for Category -->
                <th>Image</th> <!-- Column for Image -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop through each court -->
            @forelse($courts as $court)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $court->court_name ?? 'N/A' }}</td> <!-- Check for empty field -->
                    <td>{{ $court->location ?? 'N/A' }}</td> <!-- Check for empty field -->
                    <td>{{ $court->capacity ?? 'N/A' }}</td> <!-- Check for empty field -->
                    <td>${{ number_format($court->price_per_hour, 2) ?? 'N/A' }}</td> <!-- Format price -->
                    <td>{{ $court->category->name ?? 'N/A' }}</td> <!-- Display category name -->
                    <td>
                        <!-- Display the image if available -->
                        @if($court->image)
                            <img src="{{ asset($court->image) }}" alt="Court Image" class="img-fluid table-img" width="100" height="100">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>
                        <!-- Edit button -->
                        <a href="{{ route('admin.courts.edit', $court->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <!-- Delete form -->
                        <form action="{{ route('admin.courts.destroy', $court->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No courts available.</td> <!-- Display message if no data -->
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
