@extends('layouts.app')

@section('title','Give - Grace Community Church')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
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

    <!-- (Remaining giving page content) -->
    @include('partials.giving-content')

@endsection
