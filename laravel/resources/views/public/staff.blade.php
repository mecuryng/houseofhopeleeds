@extends('layouts.app')

@section('title', 'Staff Directory')
@section('content')

<!-- Hero Section -->
    <section class="hero position-relative" style="background-image:url('/images/church-bg.png');">
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100" style="background:rgba(0,0,0,0.5);pointer-events:none;z-index:1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-3">House of Hope Church Leeds</h1>
                <p class="lead mb-4">Meet our dedicated staff team serving our community.</p>
                <div class="d-flex flex-wrap gap-5 justify-content-center">
                    <a href="{{ url('/contact') }}" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-envelope me-2"></i> Contact Us
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
            <h2 class="section-title">Our Staff</h2>
            <p class="text-muted">Get to know the team behind House of Hope Church Leeds</p>
        </div>

        @if(count($staff ?? []) > 0)
        <div class="row g-4">
            @foreach($staff as $member)
            <div class="col-md-6 col-lg-4">
                <div class="card staff-card h-100 text-center">
                    <div class="card-body">
                        <div class="avatar-circle mx-auto mb-3">
                            <span class="avatar-text">{{ $member->initials() }}</span>
                        </div>
                        <h5 class="card-title">{{ $member->name }}</h5>
                        <p class="card-text text-muted">{{ ucfirst($member->role) }}</p>
                        <p class="card-text small text-muted">{{ $member->email }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center">
            <p>No staff information available at the moment.</p>
        </div>
        @endif
    </div>
</section>
@endsection