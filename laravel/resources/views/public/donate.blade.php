@extends('layouts.app')

@section('title','Give - House of Hope Church')

@section('content')
    <!-- Hero Section -->
    <section class="hero position-relative" style="background-image:url('/images/church-bg.png');">
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100" style="background:rgba(0,0,0,0.5);pointer-events:none;z-index:1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="text-center">
                <h1 class="display-4 fw-bold mb-3">Giving</h1>
                <p class="lead mb-4">Your generosity helps us fulfill our mission to love God, love people, and make disciples.</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="#give-form" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-hand-holding-heart me-2"></i> Give Now
                    </a>
                    <a href="#impact" class="btn btn-outline-light btn-lg px-4">
                        <i class="fas fa-chart-line me-2"></i> See Impact
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Info Bar -->
    <div class="quick-info py-2">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <i class="fas fa-shield-alt me-2"></i>
                    <span>Secure & Encrypted</span>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-receipt me-2"></i>
                    <span>Tax-Deductible Gifts</span>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-sync-alt me-2"></i>
                    <span>One-Time or Recurring</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Donation form -->
    

    <!-- Include giving-content partial (FAQ, impact, etc.) -->
    @include('partials.giving-content')

@endsection
