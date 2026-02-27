@extends('layouts.admin')

@section('title', 'Analytics Dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Analytics Dashboard</h1>
        <form method="GET" class="d-flex gap-2">
            <select name="period" class="form-select" onchange="this.form.submit()">
                <option value="7" {{ $period === '7' ? 'selected' : '' }}>Last 7 days</option>
                <option value="30" {{ $period === '30' ? 'selected' : '' }}>Last 30 days</option>
                <option value="90" {{ $period === '90' ? 'selected' : '' }}>Last 90 days</option>
                <option value="365" {{ $period === '365' ? 'selected' : '' }}>Last year</option>
            </select>
        </form>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="fas fa-pound-sign text-primary fs-4"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-0 small">Total Donations</p>
                            <h3 class="mb-0">£{{ number_format($donationStats['total'], 2) }}</h3>
                            <small class="text-muted">{{ $donationStats['count'] }} transactions</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                            <i class="fas fa-calendar text-success fs-4"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-0 small">Events</p>
                            <h3 class="mb-0">{{ $eventStats['total'] }}</h3>
                            <small class="text-muted">{{ $eventStats['rsvps'] }} RSVPs</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                            <i class="fas fa-book-open text-info fs-4"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-0 small">Sermons</p>
                            <h3 class="mb-0">{{ $sermonStats['total'] }}</h3>
                            <small class="text-muted">{{ $sermonStats['likes'] }} likes, {{ $sermonStats['comments'] }} comments</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                            <i class="fas fa-envelope text-warning fs-4"></i>
                        </div>
                        <div>
                            <p class="text-muted mb-0 small">Newsletter</p>
                            <h3 class="mb-0">{{ $subscriberStats['total_active'] }}</h3>
                            <small class="text-success">+{{ $subscriberStats['new'] }} new</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Donations by Provider</h5>
                </div>
                <div class="card-body">
                    @if($donationsByProvider->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Provider</th>
                                    <th>Transactions</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($donationsByProvider as $row)
                                <tr>
                                    <td class="text-capitalize">{{ $row->provider }}</td>
                                    <td>{{ $row->count }}</td>
                                    <td>£{{ number_format($row->total / 100, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-muted text-center py-4">No donation data for this period.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Donations by Frequency</h5>
                </div>
                <div class="card-body">
                    @if($donationsByFrequency->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Frequency</th>
                                    <th>Transactions</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($donationsByFrequency as $row)
                                <tr>
                                    <td class="text-capitalize">{{ str_replace('_', ' ', $row->frequency) }}</td>
                                    <td>{{ $row->count }}</td>
                                    <td>£{{ number_format($row->total / 100, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-muted text-center py-4">No donation data for this period.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Member Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <h2 class="text-primary">{{ $memberStats['total'] }}</h2>
                            <p class="text-muted mb-0">Total Members</p>
                        </div>
                        <div class="col-6">
                            <h2 class="text-success">+{{ $memberStats['new'] }}</h2>
                            <p class="text-muted mb-0">New Members</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Average Donation</h5>
                </div>
                <div class="card-body text-center">
                    <h2 class="text-primary">£{{ number_format($donationStats['average'], 2) }}</h2>
                    <p class="text-muted mb-0">Per transaction in selected period</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
