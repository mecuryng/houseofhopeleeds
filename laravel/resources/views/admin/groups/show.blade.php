@extends('layouts.admin')

@section('title', $group->name)
@section('content')
    <div class="admin-header">
        <div style="display:flex;justify-content:space-between;align-items:center;">
            <h1>{{ $group->name }}</h1>
            <div>
                <a href="{{ route('admin.groups.edit', $group) }}" style="padding:8px 16px;background:#3b82f6;color:#fff;border-radius:4px;text-decoration:none;margin-right:8px;">Edit</a>
                <a href="{{ route('admin.groups.index') }}" style="padding:8px 16px;background:#f3f4f6;color:#374151;border-radius:4px;text-decoration:none;">Back to Groups</a>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="admin-alert admin-alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div style="display:grid;grid-template-columns:1fr 2fr;gap:24px;margin-top:24px;">
        <div>
            <div style="background:#f9fafb;padding:20px;border-radius:8px;margin-bottom:24px;">
                <h3 style="margin-bottom:16px;">Group Details</h3>
                <div style="margin-bottom:12px;">
                    <span style="color:#6b7280;font-size:0.875rem;">Category</span>
                    <div style="font-weight:500;">{{ $group->category ?? 'Not set' }}</div>
                </div>
                <div style="margin-bottom:12px;">
                    <span style="color:#6b7280;font-size:0.875rem;">Leader</span>
                    <div style="font-weight:500;">{{ $group->leader?->name ?? 'Unassigned' }}</div>
                </div>
                <div style="margin-bottom:12px;">
                    <span style="color:#6b7280;font-size:0.875rem;">Location</span>
                    <div style="font-weight:500;">{{ $group->location ?? 'Not set' }}</div>
                </div>
                <div style="margin-bottom:12px;">
                    <span style="color:#6b7280;font-size:0.875rem;">Meeting</span>
                    <div style="font-weight:500;">
                        @if($group->meeting_day)
                            {{ $group->meeting_day }}{{ $group->meeting_time ? ' at ' . $group->meeting_time : '' }}
                        @else
                            Not scheduled
                        @endif
                    </div>
                </div>
                <div style="margin-bottom:12px;">
                    <span style="color:#6b7280;font-size:0.875rem;">Members</span>
                    <div style="font-weight:500;">{{ $group->members->count() }} / {{ $group->max_members ?? '∞' }}</div>
                </div>
                <div>
                    <span style="color:#6b7280;font-size:0.875rem;">Status</span>
                    <div>
                        @if($group->is_open)
                            <span style="background:#dcfce7;color:#166534;padding:0.25rem 0.5rem;border-radius:4px;font-size:0.875rem;">Open</span>
                        @else
                            <span style="background:#fee2e2;color:#dc2626;padding:0.25rem 0.5rem;border-radius:4px;font-size:0.875rem;">Closed</span>
                        @endif
                    </div>
                </div>
            </div>

            @if($group->description)
                <div style="background:#f9fafb;padding:20px;border-radius:8px;">
                    <h3 style="margin-bottom:12px;">Description</h3>
                    <p style="color:#374151;white-space:pre-wrap;">{{ $group->description }}</p>
                </div>
            @endif
        </div>

        <div>
            <div style="background:#fff;border:1px solid #e5e7eb;border-radius:8px;">
                <div style="padding:16px;border-bottom:1px solid #e5e7eb;display:flex;justify-content:space-between;align-items:center;">
                    <h3 style="margin:0;">Members ({{ $group->members->count() }})</h3>
                </div>
                @if($group->members->count() > 0)
                    <table style="width:100%;border-collapse:collapse;">
                        <thead>
                            <tr style="background:#f9fafb;">
                                <th style="padding:12px;text-align:left;border-bottom:1px solid #e5e7eb;">Name</th>
                                <th style="padding:12px;text-align:left;border-bottom:1px solid #e5e7eb;">Role</th>
                                <th style="padding:12px;text-align:left;border-bottom:1px solid #e5e7eb;">Joined</th>
                                <th style="padding:12px;text-align:right;border-bottom:1px solid #e5e7eb;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($group->members as $member)
                                <tr>
                                    <td style="padding:12px;border-bottom:1px solid #e5e7eb;">{{ $member->name }}</td>
                                    <td style="padding:12px;border-bottom:1px solid #e5e7eb;text-transform:capitalize;">{{ $member->pivot->role }}</td>
                                    <td style="padding:12px;border-bottom:1px solid #e5e7eb;">{{ $member->pivot->joined_at?->format('M d, Y') ?? '-' }}</td>
                                    <td style="padding:12px;border-bottom:1px solid #e5e7eb;text-align:right;">
                                        <form action="{{ route('admin.groups.members.remove', [$group, $member]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Remove this member?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="color:#dc2626;background:none;border:none;cursor:pointer;text-decoration:underline;">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div style="padding:24px;text-align:center;color:#6b7280;">
                        No members yet.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
