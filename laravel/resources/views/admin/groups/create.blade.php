@extends('layouts.admin')

@section('title', 'Create Small Group')
@section('content')
    <div class="admin-header">
        <h1>Create Small Group</h1>
    </div>

    @if ($errors->any())
        <div style="padding:10px;background:#fee2e2;border:1px solid #fca5a5;margin-bottom:16px;color:#7f1d1d;">
            <ul style="margin:0;padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.groups.store') }}" method="POST" style="max-width:600px;">
        @csrf

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:4px;font-weight:500;">Name *</label>
            <input type="text" name="name" value="{{ old('name') }}" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:4px;" required>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:4px;font-weight:500;">Description</label>
            <textarea name="description" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:4px;" rows="4">{{ old('description') }}</textarea>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:4px;font-weight:500;">Category</label>
            <select name="category" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:4px;">
                <option value="">Select category</option>
                <option value="bible-study" {{ old('category') === 'bible-study' ? 'selected' : '' }}>Bible Study</option>
                <option value="prayer" {{ old('category') === 'prayer' ? 'selected' : '' }}>Prayer Group</option>
                <option value="youth" {{ old('category') === 'youth' ? 'selected' : '' }}>Youth</option>
                <option value="young-adults" {{ old('category') === 'young-adults' ? 'selected' : '' }}>Young Adults</option>
                <option value="singles" {{ old('category') === 'singles' ? 'selected' : '' }}>Singles</option>
                <option value="couples" {{ old('category') === 'couples' ? 'selected' : '' }}>Couples</option>
                <option value="mens" {{ old('category') === 'mens' ? 'selected' : '' }}>Men's Group</option>
                <option value="womens" {{ old('category') === 'womens' ? 'selected' : '' }}>Women's Group</option>
                <option value="seniors" {{ old('category') === 'seniors' ? 'selected' : '' }}>Seniors</option>
                <option value="support" {{ old('category') === 'support' ? 'selected' : '' }}>Support Group</option>
                <option value="other" {{ old('category') === 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:4px;font-weight:500;">Leader</label>
            <select name="leader_id" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:4px;">
                <option value="">Select leader</option>
                @foreach ($leaders as $leader)
                    <option value="{{ $leader->id }}" {{ old('leader_id') == $leader->id ? 'selected' : '' }}>{{ $leader->name }}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:4px;font-weight:500;">Location</label>
            <input type="text" name="location" value="{{ old('location') }}" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:4px;" placeholder="e.g., Church Hall, Member's Home">
        </div>

        <div style="display:flex;gap:16px;margin-bottom:16px;">
            <div style="flex:1;">
                <label style="display:block;margin-bottom:4px;font-weight:500;">Meeting Day</label>
                <select name="meeting_day" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:4px;">
                    <option value="">Select day</option>
                    @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                        <option value="{{ $day }}" {{ old('meeting_day') === $day ? 'selected' : '' }}>{{ $day }}</option>
                    @endforeach
                </select>
            </div>
            <div style="flex:1;">
                <label style="display:block;margin-bottom:4px;font-weight:500;">Meeting Time</label>
                <input type="time" name="meeting_time" value="{{ old('meeting_time') }}" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:4px;">
            </div>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:4px;font-weight:500;">Max Members</label>
            <input type="number" name="max_members" value="{{ old('max_members') }}" min="1" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:4px;" placeholder="Leave empty for unlimited">
        </div>

        <div style="margin-bottom:24px;">
            <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                <input type="checkbox" name="is_open" value="1" {{ old('is_open') ? 'checked' : '' }} style="width:18px;height:18px;">
                <span>Open for new members</span>
            </label>
        </div>

        <div style="display:flex;gap:12px;">
            <button type="submit" style="padding:10px 20px;background:#1e293b;color:#fff;border:none;border-radius:4px;cursor:pointer;">Create Group</button>
            <a href="{{ route('admin.groups.index') }}" style="padding:10px 20px;background:#f3f4f6;color:#374151;border-radius:4px;text-decoration:none;">Cancel</a>
        </div>
    </form>
@endsection
