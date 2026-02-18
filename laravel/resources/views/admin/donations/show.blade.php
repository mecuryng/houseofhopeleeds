@extends('layouts.app')

@section('title', 'Donation Details - Admin')

@section('content')
<div class="container my-5">
    <div class="mb-4">
        <a href="{{ route('admin.donations.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Donation #{{ $donation->id }}</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Provider</h6>
                            <p class="mb-0">
                                <span class="badge bg-{{ $donation->provider === 'stripe' ? 'primary' : 'info' }}">
                                    {{ ucfirst($donation->provider) }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Status</h6>
                            <p class="mb-0">
                                <span class="badge bg-{{ $donation->status === 'succeeded' ? 'success' : ($donation->status === 'failed' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($donation->status) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Amount</h6>
                            <p class="fs-5 fw-bold mb-0">${{ number_format($donation->amount / 100, 2) }} {{ strtoupper($donation->currency) }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Frequency</h6>
                            <p class="mb-0">{{ ucfirst(str_replace('_', ' ', $donation->frequency)) }}</p>
                        </div>
                    </div>

                    <hr>

                    <h6 class="text-muted mb-2">Donor Information</h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Email</h6>
                            <p class="mb-0">{{ $donation->email ?? '—' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">User</h6>
                            <p class="mb-0">
                                @if($donation->user)
                                    <a href="{{ route('admin.users.show', $donation->user) }}">{{ $donation->user->name }}</a>
                                @else
                                    Guest Donor
                                @endif
                            </p>
                        </div>
                    </div>

                    <hr>

                    <h6 class="text-muted mb-2">Provider Details</h6>
                    <div class="mb-3">
                        <h6 class="text-muted mb-2">Provider ID</h6>
                        <p class="mb-0 font-monospace text-truncate">{{ $donation->provider_id ?? '—' }}</p>
                    </div>

                    @if($donation->metadata)
                        <div class="mb-3">
                            <h6 class="text-muted mb-2">Metadata</h6>
                            <pre class="bg-light p-3">{{ json_encode($donation->metadata, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                        </div>
                    @endif

                    <hr>

                    <h6 class="text-muted mb-2">Dates</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Created</h6>
                            <p class="mb-0">{{ $donation->created_at->format('M d, Y \a\t H:i A') }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Updated</h6>
                            <p class="mb-0">{{ $donation->updated_at->format('M d, Y \a\t H:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Actions</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.donations.destroy', $donation) }}" class="d-grid gap-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this donation record?')">
                            <i class="fas fa-trash me-2"></i> Delete Record
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
