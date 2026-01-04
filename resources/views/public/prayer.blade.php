@extends('layouts.app')

@section('title', 'Prayer Requests')
@section('content')

<!-- Hero Section -->
    <section class="hero" style="background-image:url('/images/church-bg.png');">
        <div class="container">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-3">House of Hope Church Leeds</h1>
                <p class="lead mb-4">Share your prayer requests with us. We believe in the power of prayer and community support.</p>
                <div class="d-flex flex-wrap gap-5 justify-content-center">
                    <a href="{{ url('/about') }}" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-info-circle me-2"></i> Learn More
                    </a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline-light btn-lg px-4">
                        <i class="fas fa-envelope me-2"></i> Contact Us
                    </a>
                </div>
            </div>
        </div>
    </section>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h2 class="section-title">Submit a Prayer Request</h2>
                    <p class="text-muted">Your prayer requests are confidential and will be prayed over by our prayer team.</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('prayer.store') }}" method="POST" class="card p-4 shadow">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone (Optional)</label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="request" class="form-label">Prayer Request *</label>
                        <textarea class="form-control @error('request') is-invalid @enderror" id="request" name="request" rows="5" placeholder="Please share your prayer request..." required>{{ old('request') }}</textarea>
                        @error('request')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_anonymous" name="is_anonymous" value="1" {{ old('is_anonymous') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_anonymous">
                            Submit anonymously (your name and contact info will not be shared)
                        </label>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            <i class="fas fa-paper-plane me-2"></i> Submit Prayer Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection