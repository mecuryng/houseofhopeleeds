@extends('layouts.app')

@section('title', 'Events')
@section('content')
    <section class="hero position-relative" style="background-image:url('/images/church-bg.png');">
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100" style="background:rgba(0,0,0,0.5);pointer-events:none;z-index:1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-3">Events at House of Hope Church Leeds</h1>
                <p class="lead mb-4">A place to belong, grow, and shine.</p>
                <div class="d-flex flex-wrap gap-5 justify-content-center">
                    <a href="{{ url('/donate') }}" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-calendar me-2" aria-hidden="true"></i> Support Our Work
                    </a>
                    <a href="{{ url('/about') }}" class="btn btn-outline-light btn-lg px-4">
                        <i class="fas fa-info-circle me-2" aria-hidden="true"></i> Learn More
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" id="events-list">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Our Events</h2>
                <p class="text-muted">Join us for special services, community outreach, and fellowship opportunities</p>
                <a href="{{ route('events.ical') }}" class="btn btn-sm btn-outline-primary mt-2">
                    <i class="fas fa-calendar-plus me-1" aria-hidden="true"></i> Add to Calendar (iCal)
                </a>
            </div>

            <form method="GET" action="{{ route('events') }}" class="mb-4" role="search" aria-label="Search events">
                <div class="input-group input-group-lg mx-auto" style="max-width: 500px;">
                    <label for="event-search" class="visually-hidden">Search events</label>
                    <input 
                        type="search" 
                        id="event-search"
                        name="search" 
                        class="form-control" 
                        placeholder="Search events by title, description or location..." 
                        value="{{ request('search') }}"
                        aria-describedby="event-search-help"
                    >
                    <button class="btn btn-primary" type="submit" aria-label="Search">
                        <i class="fas fa-search" aria-hidden="true"></i>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('events') }}" class="btn btn-outline-secondary" aria-label="Clear search">
                            <i class="fas fa-times" aria-hidden="true"></i>
                        </a>
                    @endif
                </div>
                <p id="event-search-help" class="form-text text-center mt-2">Search by event title, description or location</p>
            </form>

            @if($events->count() > 0)
            <div class="row g-4">
                @foreach($events as $event)
                <article class="col-md-6 col-lg-4">
                    <div class="card event-card h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-calendar text-primary me-2" aria-hidden="true"></i>
                                <time class="text-muted small" datetime="{{ $event->date->format('Y-m-d') }}">
                                    {{ $event->date->toFormattedDateString() }}
                                </time>
                            </div>
                            <h3 class="card-title h5">
                                <a href="{{ route('events.show', $event->id) }}" class="text-decoration-none stretched-link">
                                    {{ $event->title }}
                                </a>
                            </h3>
                            <div class="d-flex align-items-center text-muted mb-3">
                                <i class="fas fa-clock me-2" aria-hidden="true"></i>
                                <span>{{ $event->time }}</span>
                            </div>
                            @if($event->location)
                            <div class="d-flex align-items-center text-muted mb-3">
                                <i class="fas fa-map-marker-alt me-2" aria-hidden="true"></i>
                                <span>{{ $event->location }}</span>
                            </div>
                            @endif
                            <p class="card-text flex-grow-1">
                                {{ Str::limit($event->description, 100) }}
                            </p>
                            <div class="mt-auto pt-3 d-flex align-items-center">
                                <span class="btn btn-primary btn-sm" aria-label="View details for {{ $event->title }}">View Details</span>
                                @if($event->location)
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($event->location) }}" 
                                       target="_blank" 
                                       rel="noopener noreferrer" 
                                       class="ms-2 small text-muted"
                                       aria-label="View {{ $event->location }} on Google Maps">
                                        <i class="fas fa-map-marker-alt me-1" aria-hidden="true"></i>Map
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <nav class="mt-5" aria-label="Events pagination">
                {{ $events->links('pagination::bootstrap-5') }}
            </nav>
            @else
            <div class="text-center py-5" role="status">
                <i class="fas fa-calendar-times text-muted mb-3" style="font-size: 3rem;" aria-hidden="true"></i>
                <p class="lead">No events found{{ request('search') ? ' for "' . e(request('search')) . '"' : '' }}.</p>
                @if(request('search'))
                    <a href="{{ route('events') }}" class="btn btn-outline-primary mt-3">View all events</a>
                @endif
            </div>
            @endif
        </div>
    </section>
@endsection