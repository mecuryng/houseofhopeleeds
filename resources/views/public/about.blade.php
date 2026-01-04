@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<!-- Hero Section -->
    <section class="hero" style="background-image:url('/images/church-bg.png');">
        <div class="container">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-3">Welcome to Grace Community Church Leeds</h1>
                <p class="lead mb-4">A place where you can belong, believe, and become all that God created you to be.</p>
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
<section class="py-5" id="services">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">About Our Church</h2>
                <p class="text-muted">Our church is a community of believers dedicated to spreading love, faith, and hope.
    We believe in creating a family that grows together spiritually and supports each other.</p>
            </div>
        </div>
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Our Mission</h2>
                <p class="text-muted">To lead people into a growing relationship with Jesus Christ.</p>
            </div>
        </div>
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Our Vision</h2>
                <p class="text-muted">TTo be a light in the community and beyond.</p>
            </div>
        </div>
</section>

@endsection
