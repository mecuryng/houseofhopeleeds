@extends('layouts.admin')

@section('title', 'Members Management')
@section('content')
    <div class="admin-header">
        <div style="display:flex;justify-content:space-between;align-items:center;">
            <h1>Members</h1>
            <a href="{{ route('admin.members.create') }}" class="admin-btn-primary">Add Member</a>
        </div>
    </div>

    @if (session('success'))
        <div class="admin-alert admin-alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-table">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($members as $member)
                    <tr>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->phone }}</td>
                        <td>
                            <a href="{{ route('admin.members.edit', $member) }}" style="color:#3b82f6;text-decoration:none;margin-right:1rem;">Edit</a>
                            <form action="{{ route('admin.members.destroy', $member) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="admin-btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding:2rem;text-align:center;color:#6B7280;">No members found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($members->hasPages())
        <div style="margin-top:2rem;">
            {{ $members->links() }}
        </div>
    @endif
@endsection