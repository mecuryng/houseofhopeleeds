@extends('layouts.app')

@section('title', 'Reflections')
@section('content')
    <section class="hero position-relative" style="background-image:url('/images/church-bg.png');">
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100" style="background:rgba(0,0,0,0.5);pointer-events:none;z-index:1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-3">Reflections at House of Hope Church Leeds</h1>
                <p class="lead mb-4">Thoughts and musings from our pastors and leaders.</p>
            </div>
        </div>
    </section>

    <section class="py-5" id="reflections-list">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Our Reflections</h2>
                <p class="text-muted">A collection of short reflective pieces.</p>
            </div>

            @if($reflections->count() > 0)
            <div class="row g-4">
                @foreach($reflections as $reflection)
                <article class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        @if($reflection->image_path)
                            <img src="{{ asset('storage/' . $reflection->image_path) }}" class="card-img-top" alt="{{ $reflection->title }}">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h3 class="card-title h5">
                                <a href="{{ route('reflections.show', $reflection) }}" class="text-decoration-none stretched-link">
                                    {{ $reflection->title }}
                                </a>
                            </h3>
                            @if($reflection->date)
                            <time class="text-muted small mb-2" datetime="{{ $reflection->date->format('Y-m-d') }}">
                                {{ $reflection->date->format('F j, Y') }}
                            </time>
                            @endif
                            <p class="card-text mt-auto text-muted">
                                {{ Str::limit($reflection->content, 100) }}
                            </p>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <nav class="mt-5" aria-label="Reflections pagination">
                {{ $reflections->links('pagination::bootstrap-5') }}
            </nav>
            @else
            <div class="text-center py-5" role="status">
                <i class="fas fa-search text-muted mb-3" style="font-size: 3rem;" aria-hidden="true"></i>
                <p class="lead">No reflections have been posted yet.</p>
            </div>
            @endif
        </div>
    </section>
@endsection
