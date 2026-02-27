@extends('layouts.app')

@section('title', $series->title)

@section('content')
    <section class="hero position-relative" style="background-image:url('{{ $series->image_url ?? '/images/church-bg.png' }}');">
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100" style="background:rgba(0,0,0,0.5);pointer-events:none;z-index:1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-3">{{ $series->title }}</h1>
                @if($series->description)
                <p class="lead mb-4">{{ $series->description }}</p>
                @endif
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('sermons') }}" class="text-white-50">Sermons</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">{{ $series->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h2>Sermons in This Series</h2>
                    <p class="text-muted">{{ $series->sermons->count() }} sermons</p>
                </div>
                <div class="col-md-6 text-md-end">
                    @if($series->start_date)
                    <span class="badge bg-light text-dark me-2">
                        <i class="fas fa-calendar me-1" aria-hidden="true"></i>
                        Started {{ $series->start_date->format('F Y') }}
                    </span>
                    @endif
                </div>
            </div>

            @if($series->sermons->count() > 0)
            <div class="row g-4">
                @foreach($series->sermons as $sermon)
                <article class="col-md-6 col-lg-4">
                    <div class="card sermon-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                @if($sermon->series_order)
                                <span class="badge bg-primary me-2">Part {{ $sermon->series_order }}</span>
                                @endif
                                <time class="text-muted small" datetime="{{ $sermon->date->format('Y-m-d') }}">
                                    {{ $sermon->date->format('M j, Y') }}
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
                            @if($sermon->bible_passage)
                            <div class="d-flex align-items-center text-primary mb-2">
                                <i class="fas fa-book me-2" aria-hidden="true"></i>
                                <span>{{ $sermon->bible_passage }}</span>
                            </div>
                            @endif
                            <p class="card-text">
                                {{ Str::limit($sermon->description, 100) }}
                            </p>
                            <span class="btn btn-primary btn-sm mt-auto" aria-label="Listen to {{ $sermon->title }}">Listen Now</span>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
            @else
            <div class="text-center py-5" role="status">
                <i class="fas fa-book-open text-muted mb-3" style="font-size: 3rem;" aria-hidden="true"></i>
                <p class="lead">No sermons in this series yet.</p>
            </div>
            @endif

            <div class="text-center mt-5">
                <a href="{{ route('series.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2" aria-hidden="true"></i> All Series
                </a>
            </div>
        </div>
    </section>
@endsection
