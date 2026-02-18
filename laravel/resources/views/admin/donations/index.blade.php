@extends('layouts.app')

@section('title', 'Donations - Admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Donations</h2>
        <a href="{{ route('admin.donations.export') }}" class="btn btn-secondary">
            <i class="fas fa-download me-2"></i> Export CSV
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Provider</th>
                        <th>Amount</th>
                        <th>Frequency</th>
                        <th>Status</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($donations as $donation)
                        <tr>
                            <td>#{{ $donation->id }}</td>
                            <td>
                                <span class="badge bg-{{ $donation->provider === 'stripe' ? 'primary' : 'info' }}">
                                    {{ ucfirst($donation->provider) }}
                                </span>
                            </td>
                            <td>${{ number_format($donation->amount / 100, 2) }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $donation->frequency)) }}</td>
                            <td>
                                <span class="badge bg-{{ $donation->status === 'succeeded' ? 'success' : ($donation->status === 'failed' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($donation->status) }}
                                </span>
                            </td>
                            <td>{{ $donation->email ?? '—' }}</td>
                            <td>{{ $donation->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.donations.show', $donation) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.donations.destroy', $donation) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">No donations yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{ $donations->links() }}
</div>
@endsection
