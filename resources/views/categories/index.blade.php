@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Categories</h1>

    <!-- Button to add new category -->
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>

    <!-- Categories table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Courts Count</th> <!-- Number of courts in this category -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td> <!-- Displaying loop iteration -->
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description ?? 'No Description' }}</td> <!-- Display default message if description is empty -->
                    <td>{{ $category->courts->count() }}</td> <!-- Display number of courts associated with the category -->
                    <td>
                        <!-- Edit button -->
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning">Edit</a>

                        <!-- Delete button -->
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No categories available.</td> <!-- Display message if no categories are available -->
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
