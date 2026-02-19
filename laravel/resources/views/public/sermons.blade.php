@extends('layouts.app')

@section('title', 'Sermons') {{-- or Sermons / Give --}}
@section('content')
<!-- Hero Section -->
    <section class="hero position-relative" style="background-image:url('/images/church-bg.png');">
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100" style="background:rgba(0,0,0,0.5);pointer-events:none;z-index:1;"></div>
        <div class="container position-relative" style="z-index:2;">
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
            <h2 class="section-title">Our Sermons</h2>
            <p class="text-muted">Experience inspiring messages and biblical teaching</p>
        </div>

        @if(count($sermons ?? []) > 0)
        <div class="row g-4">
            @foreach($sermons as $sermon)
            <div class="col-md-6 col-lg-4">
                <div class="card sermon-card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-book-open text-primary me-2"></i>
                            <span class="text-muted small">{{ $sermon->date->format('F j, Y') }}</span>
                        </div>
                        <h4 class="card-title">{{ $sermon->title }}</h4>
                        @if($sermon->pastor)
                        <div class="d-flex align-items-center text-muted mb-3">
                            <i class="fas fa-user me-2"></i>
                            <span>{{ $sermon->pastor->name }}</span>
                        </div>
                        @endif
                        <p class="card-text">
                            {{ Str::limit($sermon->description, 100) }}
                        </p>
                        <div class="mt-4">
                            <a href="{{ route('sermons.show', $sermon->id) }}" class="btn btn-primary btn-sm">Listen Now</a>
                            @if($sermon->video_url)
                                <a href="{{ $sermon->video_url }}" target="_blank" class="ms-2 small text-muted">(video)</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center">
            <p>No sermons available at the moment. Please check back later.</p>
        </div>
        @endif
    </div>
</section>
@endsection