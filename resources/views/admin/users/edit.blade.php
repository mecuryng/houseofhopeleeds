@extends('layouts.admin')

@section('title', 'Edit User')
@section('content')
    <div class="admin-header">
        <h1>Edit User: {{ $user->name }}</h1>
    </div>

    @if ($errors->any())
        <div class="admin-alert" style="background:#fee2e2;border:1px solid #fecaca;color:#dc2626;margin-bottom:2rem;">
            <ul style="margin:0;padding-left:1rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="max-width:600px;">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" style="background:white;padding:2rem;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,0.05);">
            @csrf
            @method('PUT')

            <div style="margin-bottom:1.5rem;">
                <label for="name" style="display:block;margin-bottom:0.5rem;font-weight:600;color:#374151;">Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:6px;" required>
            </div>

            <div style="margin-bottom:1.5rem;">
                <label for="email" style="display:block;margin-bottom:0.5rem;font-weight:600;color:#374151;">Email *</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:6px;" required>
            </div>

            <div style="margin-bottom:1.5rem;">
                <label for="role" style="display:block;margin-bottom:0.5rem;font-weight:600;color:#374151;">Role *</label>
                <select id="role" name="role" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:6px;" required>
                    <option value="">Select Role</option>
                    <option value="member" {{ old('role', $user->role) === 'member' ? 'selected' : '' }}>Member</option>
                    <option value="pastor" {{ old('role', $user->role) === 'pastor' ? 'selected' : '' }}>Pastor</option>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div style="margin-bottom:1.5rem;">
                <label for="password" style="display:block;margin-bottom:0.5rem;font-weight:600;color:#374151;">New Password (leave blank to keep current)</label>
                <input type="password" id="password" name="password" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:6px;">
                <small style="color:#6b7280;">Only fill this if you want to change the password</small>
            </div>

            <div style="margin-bottom:2rem;">
                <label for="password_confirmation" style="display:block;margin-bottom:0.5rem;font-weight:600;color:#374151;">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:6px;">
            </div>

            <div style="display:flex;gap:1rem;">
                <button type="submit" class="admin-btn-primary">Update User</button>
                <a href="{{ route('admin.users.index') }}" class="admin-btn-primary" style="background:#6b7280;">Cancel</a>
            </div>
        </form>
    </div>
@endsection