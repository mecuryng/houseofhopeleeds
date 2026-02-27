@extends('layouts.app')

@section('title', 'Sermon Series')

@section('content')
    <section class="hero position-relative" style="background-image:url('/images/church-bg.png');">
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100" style="background:rgba(0,0,0,0.5);pointer-events:none;z-index:1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-3">Sermon Series</h1>
                <p class="lead mb-4">Explore our sermon collections by theme</p>
                <a href="{{ route('sermons') }}" class="btn btn-outline-light btn-lg px-4">
                    <i class="fas fa-book-open me-2" aria-hidden="true"></i> View All Sermons
                </a>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            @if($series->count() > 0)
            <div class="row g-4">
                @foreach($series as $s)
                <article class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        @if($s->image_url)
                        <img src="{{ $s->image_url }}" class="card-img-top" alt="{{ $s->title }}" style="height: 200px; object-fit: cover;">
                        @else
                        <div class="card-img-top bg-primary d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="fas fa-book-open text-white" style="font-size: 3rem;"></i>
                        </div>
                        @endif
                        <div class="card-body">
                            <h3 class="card-title h5">
                                <a href="{{ route('series.show', $s) }}" class="text-decoration-none">
                                    {{ $s->title }}
                                </a>
                            </h3>
                            @if($s->description)
                            <p class="card-text">{{ Str::limit($s->description, 120) }}</p>
                            @endif
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="badge bg-primary">{{ $s->sermons_count }} sermons</span>
                                @if($s->start_date)
                                <small class="text-muted">{{ $s->start_date->format('M Y') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="{{ route('series.show', $s) }}" class="btn btn-outline-primary btn-sm w-100">
                                View Series
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <nav class="mt-5" aria-label="Series pagination">
                {{ $series->links('pagination::bootstrap-5') }}
            </nav>
            @else
            <div class="text-center py-5" role="status">
                <i class="fas fa-book text-muted mb-3" style="font-size: 3rem;" aria-hidden="true"></i>
                <p class="lead">No sermon series available yet.</p>
                <a href="{{ route('sermons') }}" class="btn btn-primary">View All Sermons</a>
            </div>
            @endif
        </div>
    </section>
@endsection
