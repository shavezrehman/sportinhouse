@extends('layouts.master')

@section('content')
    <!-- Hero Section -->
    <div class="container-fluid hero-section" style="background-image: url('{{ asset('img/ronaldo.jpg') }}'); background-size: cover; background-position: center center; height: 600px;">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-8 text-center text-white">
                <h1>Welcome to SportInHouse</h1>
                <p class="lead">Your best choice for indoor sports court bookings</p>
                <a href="{{ route('courts') }}" class="cta-btn">Book a Court Now</a>
            </div>
        </div>
    </div>


    <!-- Features Section -->
    <section class="features">
        <div class="feature">
            <h2>Real-time Availability</h2>
            <p>View court availability in real-time and book instantly.</p>
        </div>
        <div class="feature">
            <h2>Affordable Pricing</h2>
            <p>Transparent pricing with no hidden charges.</p>
        </div>
        <div class="feature">
                <h2>Customer Reviews</h2>
            </a>
            <p>Check reviews from other users before booking your court.</p>
        </div>
    </section>
@endsection
