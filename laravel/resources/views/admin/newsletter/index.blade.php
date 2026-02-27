@extends('layouts.admin')

@section('title', 'Newsletter Subscribers')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Newsletter Subscribers</h1>
        <a href="{{ route('admin.newsletter.export') }}" class="btn btn-outline-primary">
            <i class="fas fa-download me-2"></i> Export CSV
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <form method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search by email or name..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Unsubscribed</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Source</th>
                            <th>Subscribed</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subscribers as $subscriber)
                        <tr>
                            <td>{{ $subscriber->email }}</td>
                            <td>{{ $subscriber->name ?? '-' }}</td>
                            <td>
                                @if($subscriber->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Unsubscribed</span>
                                @endif
                            </td>
                            <td>{{ $subscriber->source }}</td>
                            <td>{{ $subscriber->subscribed_at?->format('M j, Y') ?? '-' }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.newsletter.destroy', $subscriber) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">No subscribers found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $subscribers->links() }}
        </div>
    </div>
</div>
@endsection
