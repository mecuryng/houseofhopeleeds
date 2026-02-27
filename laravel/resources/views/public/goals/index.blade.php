@extends('layouts.app')

@section('title', 'Donation Goals')

@section('content')
    <section class="hero position-relative" style="background-image:url('/images/church-bg.png');">
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100" style="background:rgba(0,0,0,0.5);pointer-events:none;z-index:1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-3">Giving Goals</h1>
                <p class="lead mb-4">Help us reach our ministry goals</p>
                <a href="{{ route('donate') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-heart me-2" aria-hidden="true"></i> Give Now
                </a>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            @if($goals->count() > 0)
            <div class="row g-4">
                @foreach($goals as $goal)
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title h5">{{ $goal->name }}</h3>
                            @if($goal->description)
                            <p class="card-text">{{ $goal->description }}</p>
                            @endif

                            <div class="my-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Progress</span>
                                    <span>{{ $goal->progress_percentage }}%</span>
                                </div>
                                <div class="progress" style="height: 20px;" role="progressbar" aria-valuenow="{{ $goal->progress_percentage }}" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-{{ $goal->color ?? 'primary' }}" style="width: {{ $goal->progress_percentage }}%">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <div>
                                    <small class="text-muted d-block">Raised</small>
                                    <strong>£{{ number_format($goal->current_amount, 0) }}</strong>
                                </div>
                                <div class="text-end">
                                    <small class="text-muted d-block">Goal</small>
                                    <strong>£{{ number_format($goal->target_amount, 0) }}</strong>
                                </div>
                            </div>

                            @if($goal->is_completed)
                            <div class="alert alert-success mt-3 mb-0">
                                <i class="fas fa-check-circle me-2" aria-hidden="true"></i> Goal reached!
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-bullseye text-muted mb-3" style="font-size: 3rem;" aria-hidden="true"></i>
                <p class="lead">No active donation goals at this time.</p>
                <a href="{{ route('donate') }}" class="btn btn-primary">Make a Donation</a>
            </div>
            @endif
        </div>
    </section>
@endsection
