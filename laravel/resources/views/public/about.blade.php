@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<!-- Hero Section -->
    <section class="hero" style="background-image:url('/images/church-bg.png');">
        <div class="container">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-3">Welcome to House of Hope Church Leeds</h1>
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
<section class="py-5" id="services">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">About Our Church</h2>
                <p class="text-muted">House of Hope is a place to belong before it is a building.
Since 2024, we have been meeting in homes, around tables, and in prayer. Through Bible studies and cell groups, we teach God’s Word down to the cross-root level, helping everyone understand and live it daily.

We are built one stone at a time, growing through Scripture, fellowship, and the faithful work of God among ordinary people.
(1 Peter 2).</p>
            </div>
        </div>
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Our Mission</h2>
                <p class="text-muted">To nurture spiritual growth through instruction and fellowship, and to reach out with the good news, fostering truth, love, and obedience in our community.</p>
            </div>
        </div>
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Our Vision</h2>
                <p class="text-muted">To be a welcoming place of safety, hope, and encouragement, shining Christ's light simply and faithfully to strengthen our community.</p>
            </div>
        </div>
</section>

@endsection
