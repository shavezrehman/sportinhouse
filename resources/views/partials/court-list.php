@foreach ($courts as $court)
    <div class="col-md-4 mb-4 recipe-card" data-category="{{ $court->category_id }}" data-court-name="{{ strtolower($court->court_name) }}">
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
