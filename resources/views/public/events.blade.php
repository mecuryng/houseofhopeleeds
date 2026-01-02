
@extends('layouts.app')

@section('title', 'Events') {{-- or Sermons / Give --}}
@section('content')
    
<!-- Hero Section -->
    <section class="hero" style="background-image:url('/images/church-bg.png');">
        <div class="container">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-3">Welcome to Grace Community Church Leeds</h1>
                <p class="lead mb-4">A place where you can belong, believe, and become all that God created you to be.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ url('/donate') }}" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-calendar me-2"></i> Join Us This Sunday
                    </a>
                    <a href="{{ url('/about') }}" class="btn btn-outline-light btn-lg px-4">
                        <i class="fas fa-info-circle me-2"></i> Learn More
                    </a>
                </div>
            </div>
        </div>
    </section>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold mb-8 text-center">Our Events</h1>

    @if(count($events ?? []) > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($events as $event)
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold mb-2">{{ $event->title }}</h3>
            <p class="text-gray-600 mb-4">{{ $event->description }}</p>
            <div class="text-sm text-gray-500">
                <p>Date: {{ $event->date->format('F j, Y') }}</p>
                <p>Time: {{ $event->time }}</p>
                <p>Location: {{ $event->location }}</p>
            </div>
            <div class="mt-4">
                <a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-primary">View</a>
                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($event->location) }}" target="_blank" class="ms-2 small text-muted">Map</a>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center text-gray-600">
        <p>No upcoming events at the moment. Please check back later.</p>
    </div>
    @endif
</div>
@endsection