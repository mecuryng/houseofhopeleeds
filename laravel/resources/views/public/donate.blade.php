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

    @if($goals->count() > 0)
        <!-- Active Fundraising Goals -->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="section-title">Current Giving Goals</h2>
                    <p class="text-muted">Help us reach our fundraising targets</p>
                </div>

                <div class="row g-4">
                    @foreach($goals as $goal)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $goal->name }}</h5>
                                    @if($goal->description)
                                        <p class="card-text text-muted small">{{ Str::limit($goal->description, 100) }}</p>
                                    @endif

                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span class="fw-bold">${{ number_format($goal->current_amount, 0) }}</span>
                                            <span class="text-muted">of ${{ number_format($goal->target_amount, 0) }}</span>
                                        </div>
                                        <div class="progress" style="height: 10px;">
                                            <div class="progress-bar" role="progressbar" 
                                                style="width: {{ min(100, $goal->progress_percentage) }}%; background-color: {{ $goal->color ?? '#3b82f6' }};"
                                                aria-valuenow="{{ $goal->progress_percentage }}" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-1">
                                            <small class="text-muted">{{ $goal->progress_percentage }}% reached</small>
                                            @if($goal->remaining_amount > 0)
                                                <small class="text-muted">${{ number_format($goal->remaining_amount, 0) }} to go</small>
                                            @else
                                                <small class="text-success fw-bold">Goal reached!</small>
                                            @endif
                                        </div>
                                    </div>

                                    @if($goal->end_date)
                                        <small class="text-muted d-block mb-3">
                                            <i class="fas fa-calendar me-1"></i>
                                            Ends {{ $goal->end_date->format('M d, Y') }}
                                        </small>
                                    @endif

                                    <a href="#online-giving" class="btn btn-outline-primary btn-sm w-100" onclick="selectGoal({{ $goal->id }})">
                                        Give to this Goal
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Donation form -->
    

    <!-- Include giving-content partial (FAQ, impact, etc.) -->
    @include('partials.giving-content')

@endsection

@push('scripts')
<script>
function selectGoal(goalId) {
    // This can be expanded to pre-select the goal in the donation form
    // For now, just scroll to the giving section
    document.getElementById('online-giving').scrollIntoView({ behavior: 'smooth' });
}
</script>
@endpush
