@extends('layouts.admin')

@section('title', 'Users Management')
@section('content')
    <div class="admin-header">
        <div style="display:flex;justify-content:space-between;align-items:center;">
            <h1>Users</h1>
            <a href="{{ route('admin.users.create') }}" class="admin-btn-primary">+ Add User</a>
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
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Email Verified</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span style="text-transform:capitalize;padding:0.25rem 0.5rem;border-radius:4px;font-size:0.875rem;
                                {{ $user->role === 'admin' ? 'background:#dbeafe;color:#1e40af;' : '' }}
                                {{ $user->role === 'pastor' ? 'background:#dcfce7;color:#166534;' : '' }}
                                {{ $user->role === 'member' ? 'background:#f3f4f6;color:#374151;' : '' }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td>{{ $user->email_verified_at ? 'Yes' : 'No' }}</td>
                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user) }}" style="color:#3b82f6;text-decoration:none;margin-right:1rem;">Edit</a>
                            @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-btn-danger">Delete</button>
                                </form>
                            @else
                                <span style="color:#9ca3af;font-size:0.875rem;">(You)</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding:2rem;text-align:center;color:#6B7280;">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
        <div style="margin-top:2rem;">
            {{ $users->links() }}
        </div>
    @endif
@endsection