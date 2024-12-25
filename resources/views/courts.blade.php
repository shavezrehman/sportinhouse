@extends('layouts.master')

@section('title', 'All Courts')

@section('content')
<div class="container my-5 bg-light p-4 rounded">
    <h1 class="text-center mb-4">All Courts</h1>

    <!-- Search and Filter Form -->
    <div class="row mb-4">
        <!-- Search Input -->
        <div class="col-md-5 mb-3">
            <input type="text" class="form-control" id="searchInput" placeholder="Search for courts...">
        </div>

        <!-- Category Filter -->
        <div class="col-md-5 mb-3">
            <select class="form-select" id="categoryFilter">
                <option value="all">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div id="searchResults" class="mt-3"></div>

    <div class="row" id="courtContainer">
        @foreach ($categories as $category)
            <h2 class="text-center mb-4">{{ $category->name }}</h2>
            
            @if ($category->courts->isEmpty())
                <p class="text-center">No courts available in this category.</p>
            @else
                <div class="row">
                    @foreach ($category->courts as $court)
                        <div class="col-md-4 mb-4 recipe-card" data-category="{{ $category->id }}" data-court-name="{{ strtolower($court->court_name) }}">
                            <div class="card">
                                @if ($court->image)
                                    <img src="{{ asset($court->image) }}" alt="Court Image" class="card-img-top img-fluid">
                                @else
                                    <div class="card-img-top d-flex justify-content-center align-items-center" style="height: 200px; background-color: #f0f0f0;">
                                        <p>No image available</p>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $court->court_name }}</h5>
                                    <p class="card-text">
                                        <strong>Location:</strong> {{ $court->location }}<br>
                                        <strong>Capacity:</strong> {{ $court->capacity }} people<br>
                                        <strong>Price per Hour:</strong> $ {{ $court->price_per_hour }} per hour
                                    </p>
                                    <!-- Modal Trigger Button -->
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookingModal{{ $court->id }}">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>
</div>

<!-- Modal Template -->
@foreach ($categories as $category)
    @foreach ($category->courts as $court)
        <div class="modal fade" id="bookingModal{{ $court->id }}" tabindex="-1" aria-labelledby="bookingModalLabel{{ $court->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bookingModalLabel{{ $court->id }}">Booking Court: {{ $court->court_name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('booking', ['courtId' => $court->id]) }}" method="GET">
                            <div class="mb-3">
                                <label for="bookingDate" class="form-label">Select Date and Time</label>
                                <input type="datetime-local" id="bookingDate" name="bookingDate" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="userName" class="form-label">Your Name</label>
                                <input type="text" id="userName" name="userName" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="userEmail" class="form-label">Your Email</label>
                                <input type="email" id="userEmail" name="userEmail" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="userPhone" class="form-label">Your Phone</label>
                                <input type="text" id="userPhone" name="userPhone" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <p><strong>Price per Hour:</strong> $ {{ $court->price_per_hour }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endforeach

@endsection
