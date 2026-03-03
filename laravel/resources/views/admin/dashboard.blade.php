@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="mb-4">
        <h1 class="h3 mb-0">Welcome, {{ auth()->user()->name }}</h1>
        <p class="text-muted mb-0">Role: <strong>{{ ucfirst(auth()->user()->role) }}</strong></p>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-2">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <h2 class="text-primary mb-0">{{ $stats['members'] }}</h2>
                    <small class="text-muted">Members</small>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-2">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <h2 class="text-success mb-0">£{{ number_format($stats['total_donations'], 0) }}</h2>
                    <small class="text-muted">Donations</small>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-2">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <h2 class="text-info mb-0">{{ $stats['upcoming_events'] }}</h2>
                    <small class="text-muted">Upcoming Events</small>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-2">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <h2 class="text-warning mb-0">{{ $stats['recent_sermons'] }}</h2>
                    <small class="text-muted">Sermons</small>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-2">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <h2 class="text-purple-500 mb-0">{{ $stats['dreams'] }}</h2>
                    <small class="text-muted">Revelations</small>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-2">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <h2 class="text-danger mb-0">{{ $stats['newsletter_subscribers'] }}</h2>
                    <small class="text-muted">Newsletter</small>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-2">
            <div class="card h-100 text-center bg-primary text-white">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <a href="{{ route('admin.analytics') }}" class="text-white text-decoration-none">
                        <i class="fas fa-chart-line fs-4"></i>
                        <div><small>Analytics</small></div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Donations</h5>
                    <a href="{{ route('admin.donations.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body p-0">
                    @if($recent_donations->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent_donations as $donation)
                                <tr>
                                    <td>{{ $donation->email ?? 'Anonymous' }}</td>
                                    <td>£{{ number_format($donation->amount / 100, 2) }}</td>
                                    <td>{{ $donation->created_at->format('M j') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-muted text-center py-4 mb-0">No recent donations.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Upcoming Events</h5>
                    <a href="{{ route('admin.events.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body p-0">
                    @if($upcoming_events->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Event</th>
                                    <th>Date</th>
                                    <th>RSVPs</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($upcoming_events as $event)
                                <tr>
                                    <td>{{ $event->title }}</td>
                                    <td>{{ $event->date->format('M j, Y') }}</td>
                                    <td>{{ $event->rsvps->count() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-muted text-center py-4 mb-0">No upcoming events.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="{{ route('admin.events.create') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-calendar-plus me-2"></i> Add Event
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.sermons.create') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-book me-2"></i> Add Sermon
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.users.create') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-user-plus me-2"></i> Add User
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.newsletter.index') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-envelope me-2"></i> Newsletter
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.dreams.create') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-bed me-2"></i> Add Dream
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
