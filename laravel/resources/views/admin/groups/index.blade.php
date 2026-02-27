@extends('layouts.admin')

@section('title', 'Small Groups Management')
@section('content')
    <div class="admin-header">
        <div style="display:flex;justify-content:space-between;align-items:center;">
            <h1>Small Groups</h1>
            <a href="{{ route('admin.groups.create') }}" class="admin-btn-primary">+ Add Group</a>
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
                    <th>Category</th>
                    <th>Leader</th>
                    <th>Meeting</th>
                    <th>Members</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($groups as $group)
                    <tr>
                        <td>
                            <a href="{{ route('admin.groups.show', $group) }}" style="color:#3b82f6;text-decoration:none;font-weight:500;">
                                {{ $group->name }}
                            </a>
                        </td>
                        <td>{{ $group->category ?? '-' }}</td>
                        <td>{{ $group->leader?->name ?? 'Unassigned' }}</td>
                        <td>
                            @if($group->meeting_day)
                                {{ $group->meeting_day }}{{ $group->meeting_time ? ' at ' . $group->meeting_time : '' }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $group->members_count }} / {{ $group->max_members ?? '∞' }}</td>
                        <td>
                            @if($group->is_open)
                                <span style="background:#dcfce7;color:#166534;padding:0.25rem 0.5rem;border-radius:4px;font-size:0.875rem;">Open</span>
                            @else
                                <span style="background:#fee2e2;color:#dc2626;padding:0.25rem 0.5rem;border-radius:4px;font-size:0.875rem;">Closed</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.groups.edit', $group) }}" style="color:#3b82f6;text-decoration:none;margin-right:1rem;">Edit</a>
                            <form action="{{ route('admin.groups.destroy', $group) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this group?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="admin-btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding:2rem;text-align:center;color:#6B7280;">No small groups found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($groups->hasPages())
        <div style="margin-top:2rem;">
            {{ $groups->links() }}
        </div>
    @endif
@endsection
