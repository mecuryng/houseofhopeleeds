
@extends('layouts.app')

@section('title', 'Events') {{-- or Sermons / Give --}}
@section('content')
    
<!-- Hero Section -->
    <section class="hero" style="background-image:url('/images/church-bg.png');">
        <div class="container">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-3">Welcome to Grace Community Church Leeds</h1>
                <p class="lead mb-4">A place to belong, grow, and shine.</p>
                <div class="d-flex flex-wrap gap-5 justify-content-center">
                    <a href="{{ url('/donate') }}" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-calendar me-2"></i> Support Our Work
                    </a>
                    <a href="{{ url('/about') }}" class="btn btn-outline-light btn-lg px-4">
                        <i class="fas fa-info-circle me-2"></i> Learn More
                    </a>
                </div>
            </div>
        </div>
    </section>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Our Events</h2>
            <p class="text-muted">Join us for special services, community outreach, and fellowship opportunities</p>
        </div>

        @if(count($events ?? []) > 0)
        <div class="row g-4">
            @foreach($events as $event)
            <div class="col-md-6 col-lg-4">
                <div class="card event-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-calendar text-primary me-2"></i>
                            <span class="text-muted small">{{ \Carbon\Carbon::parse($event->date)->toFormattedDateString() }}</span>
                        </div>
                        <h4 class="card-title">{{ $event->title }}</h4>
                        <div class="d-flex align-items-center text-muted mb-3">
                            <i class="fas fa-clock me-2"></i>
                            <span>{{ $event->time }}</span>
                        </div>
                        <p class="card-text">
                            {{ Str::limit($event->description, 100) }}
                        </p>
                        <div class="mt-4">
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary btn-sm">View Details</a>
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($event->location) }}" target="_blank" class="ms-2 small text-muted">Map</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center">
            <p>No upcoming events at the moment. Please check back later.</p>
        </div>
        @endif
    </div>
</section>
@endsection