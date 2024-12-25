@extends('layouts.master')

@section('content')
<div class="container py-5 bg-light rounded shadow-sm">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <h1 class="text-center mb-4 text-primary">Contact Us</h1>
            <p class="text-center text-muted mb-5">Have questions? We are here to help! Reach out to us and we will get back to you as soon as possible.</p>

            <!-- Contact Form -->
            <form>
                <!-- Name Field -->
                <div class="mb-4">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" id="name" class="form-control form-control-lg" placeholder="Enter your name" required>
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="form-label">Your Email</label>
                    <input type="email" id="email" class="form-control form-control-lg" placeholder="Enter your email" required>
                </div>

                <!-- Message Field -->
                <div class="mb-4">
                    <label for="message" class="form-label">Your Message</label>
                    <textarea id="message" class="form-control form-control-lg" rows="6" placeholder="Write your message here..." required></textarea>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg w-100">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
