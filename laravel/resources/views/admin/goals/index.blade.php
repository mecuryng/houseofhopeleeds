@extends('layouts.admin')

@section('title', 'Donation Goals')
@section('content')
    <div class="admin-header">
        <div style="display:flex;justify-content:space-between;align-items:center;">
            <h1>Donation Goals</h1>
            <a href="{{ route('admin.goals.create') }}" class="admin-btn-primary">+ Add Goal</a>
        </div>
    </div>

    @if (session('success'))
        <div class="admin-alert admin-alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="admin-alert" style="background:#fee2e2;border:1px solid #fecaca;color:#dc2626;">
            {{ session('error') }}
        </div>
    @endif

    <div class="admin-table">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Progress</th>
                    <th>Target</th>
                    <th>Current</th>
                    <th>Period</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($goals as $goal)
                    <tr>
                        <td>
                            <span style="font-weight:500;">{{ $goal->name }}</span>
                            @if($goal->description)
                                <br><span style="color:#6b7280;font-size:0.875rem;">{{ Str::limit($goal->description, 50) }}</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex;align-items:center;gap:8px;">
                                <div style="width:100px;height:8px;background:#e5e7eb;border-radius:4px;overflow:hidden;">
                                    <div style="width:{{ min(100, $goal->progress_percentage) }}%;height:100%;background:{{ $goal->color ?? '#3b82f6' }};"></div>
                                </div>
                                <span style="font-size:0.875rem;color:#6b7280;">{{ $goal->progress_percentage }}%</span>
                            </div>
                        </td>
                        <td>${{ number_format($goal->target_amount, 2) }}</td>
                        <td>${{ number_format($goal->current_amount, 2) }}</td>
                        <td>
                            @if($goal->start_date)
                                {{ $goal->start_date->format('M d') }} - {{ $goal->end_date?->format('M d, Y') ?? 'Ongoing' }}
                            @else
                                Ongoing
                            @endif
                        </td>
                        <td>
                            @if($goal->is_active)
                                <span style="background:#dcfce7;color:#166534;padding:0.25rem 0.5rem;border-radius:4px;font-size:0.875rem;">Active</span>
                            @else
                                <span style="background:#f3f4f6;color:#374151;padding:0.25rem 0.5rem;border-radius:4px;font-size:0.875rem;">Inactive</span>
                            @endif
                            @if($goal->show_progress)
                                <span style="background:#dbeafe;color:#1e40af;padding:0.25rem 0.5rem;border-radius:4px;font-size:0.875rem;margin-left:4px;">Visible</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.goals.edit', $goal) }}" style="color:#3b82f6;text-decoration:none;margin-right:1rem;">Edit</a>
                            <form action="{{ route('admin.goals.destroy', $goal) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this goal?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="admin-btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding:2rem;text-align:center;color:#6B7280;">No donation goals found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($goals->hasPages())
        <div style="margin-top:2rem;">
            {{ $goals->links() }}
        </div>
    @endif
@endsection
