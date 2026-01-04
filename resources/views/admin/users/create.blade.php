@extends('layouts.admin')

@section('title', 'Create User')
@section('content')
    <div class="admin-header">
        <h1>Create New User</h1>
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
        <form action="{{ route('admin.users.store') }}" method="POST" style="background:white;padding:2rem;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,0.05);">
            @csrf

            <div style="margin-bottom:1.5rem;">
                <label for="name" style="display:block;margin-bottom:0.5rem;font-weight:600;color:#374151;">Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:6px;" required>
            </div>

            <div style="margin-bottom:1.5rem;">
                <label for="email" style="display:block;margin-bottom:0.5rem;font-weight:600;color:#374151;">Email *</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:6px;" required>
            </div>

            <div style="margin-bottom:1.5rem;">
                <label for="role" style="display:block;margin-bottom:0.5rem;font-weight:600;color:#374151;">Role *</label>
                <select id="role" name="role" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:6px;" required>
                    <option value="">Select Role</option>
                    <option value="member" {{ old('role') === 'member' ? 'selected' : '' }}>Member</option>
                    <option value="pastor" {{ old('role') === 'pastor' ? 'selected' : '' }}>Pastor</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div style="margin-bottom:1.5rem;">
                <label for="password" style="display:block;margin-bottom:0.5rem;font-weight:600;color:#374151;">Password *</label>
                <input type="password" id="password" name="password" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:6px;" required>
            </div>

            <div style="margin-bottom:2rem;">
                <label for="password_confirmation" style="display:block;margin-bottom:0.5rem;font-weight:600;color:#374151;">Confirm Password *</label>
                <input type="password" id="password_confirmation" name="password_confirmation" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:6px;" required>
            </div>

            <div style="display:flex;gap:1rem;">
                <button type="submit" class="admin-btn-primary">Create User</button>
                <a href="{{ route('admin.users.index') }}" class="admin-btn-primary" style="background:#6b7280;">Cancel</a>
            </div>
        </form>
    </div>
@endsection