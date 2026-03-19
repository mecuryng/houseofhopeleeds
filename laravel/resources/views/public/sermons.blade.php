@extends('layouts.app')

@section('title', 'Sermons')
@section('content')
    <section class="hero position-relative" style="background-image:url('/images/church-bg.png');">
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100" style="background:rgba(0,0,0,0.5);pointer-events:none;z-index:1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-3">Sermons at House of Hope Church Leeds</h1>
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

    <section class="py-5" id="sermons-list">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Our Sermons</h2>
                <p class="text-muted">Experience inspiring messages and biblical teaching</p>
                {{-- <a href="{{ route('sermons.rss') }}" class="btn btn-sm btn-outline-primary mt-2">
                    <i class="fas fa-rss me-1" aria-hidden="true"></i> Subscribe to Podcast RSS
                </a> --}}
            </div>

            <form method="GET" action="{{ route('sermons') }}" class="mb-4" role="search" aria-label="Search sermons">
                <div class="input-group input-group-lg mx-auto" style="max-width: 500px;">
                    <label for="sermon-search" class="visually-hidden">Search sermons</label>
                    <input 
                        type="search" 
                        id="sermon-search"
                        name="search" 
                        class="form-control" 
                        placeholder="Search sermons by title or description..." 
                        value="{{ request('search') }}"
                        aria-describedby="search-help"
                    >
                    <button class="btn btn-primary" type="submit" aria-label="Search">
                        <i class="fas fa-search" aria-hidden="true"></i>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('sermons') }}" class="btn btn-outline-secondary" aria-label="Clear search">
                            <i class="fas fa-times" aria-hidden="true"></i>
                        </a>
                    @endif
                </div>
                <p id="search-help" class="form-text text-center mt-2">Search by sermon title or description</p>
            </form>

            @if($sermons->count() > 0)
            <div class="row g-4">
                @foreach($sermons as $sermon)
                <article class="col-md-6 col-lg-4">
                    <div class="card sermon-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-book-open text-primary me-2" aria-hidden="true"></i>
                                <time class="text-muted small" datetime="{{ $sermon->date->format('Y-m-d') }}">
                                    {{ $sermon->date->format('F j, Y') }}
                                </time>
                            </div>
                            <h3 class="card-title h5">
                                <a href="{{ route('sermons.show', $sermon->id) }}" class="text-decoration-none stretched-link">
                                    {{ $sermon->title }}
                                </a>
                            </h3>
                            @if($sermon->pastor)
                            <div class="d-flex align-items-center text-muted mb-3">
                                <i class="fas fa-user me-2" aria-hidden="true"></i>
                                <span>{{ $sermon->pastor->name }}</span>
                            </div>
                            @endif
                            <p class="card-text">
                                {{ Str::limit($sermon->description, 100) }}
                            </p>
                            <div class="mt-auto pt-3">
                                <span class="btn btn-primary btn-sm" aria-label="Listen to {{ $sermon->title }}">Listen Now</span>
                                @if($sermon->video_url)
                                    <a href="{{ $sermon->video_url }}" target="_blank" rel="noopener noreferrer" class="ms-2 small text-muted" aria-label="Watch video of {{ $sermon->title }}">
                                        <i class="fas fa-video me-1" aria-hidden="true"></i>Video
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <nav class="mt-5" aria-label="Sermons pagination">
                {{ $sermons->links('pagination::bootstrap-5') }}
            </nav>
            @else
            <div class="text-center py-5" role="status">
                <i class="fas fa-search text-muted mb-3" style="font-size: 3rem;" aria-hidden="true"></i>
                <p class="lead">No sermons found{{ request('search') ? ' for "' . e(request('search')) . '"' : '' }}.</p>
                @if(request('search'))
                    <a href="{{ route('sermons') }}" class="btn btn-outline-primary mt-3">View all sermons</a>
                @endif
            </div>
            @endif
        </div>
    </section>
@endsection