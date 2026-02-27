@extends('layouts.admin')

@section('title', 'Edit Donation Goal')
@section('content')
    <div class="admin-header">
        <h1>Edit Donation Goal</h1>
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

    <form action="{{ route('admin.goals.update', $goal) }}" method="POST" style="max-width:600px;">
        @csrf
        @method('PUT')

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:4px;font-weight:500;">Name *</label>
            <input type="text" name="name" value="{{ old('name', $goal->name) }}" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:4px;" required>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:4px;font-weight:500;">Description</label>
            <textarea name="description" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:4px;" rows="3">{{ old('description', $goal->description) }}</textarea>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:4px;font-weight:500;">Target Amount *</label>
            <div style="display:flex;align-items:center;">
                <span style="padding:8px;background:#f3f4f6;border:1px solid #d1d5db;border-right:none;border-radius:4px 0 0 4px;">$</span>
                <input type="number" name="target_amount" value="{{ old('target_amount', $goal->target_amount) }}" step="0.01" min="1" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:0 4px 4px 0;" required>
            </div>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:4px;font-weight:500;">Current Amount</label>
            <div style="display:flex;align-items:center;">
                <span style="padding:8px;background:#f3f4f6;border:1px solid #d1d5db;border-right:none;border-radius:4px 0 0 4px;">$</span>
                <input type="number" name="current_amount" value="{{ old('current_amount', $goal->current_amount) }}" step="0.01" min="0" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:0 4px 4px 0;">
            </div>
            <p style="font-size:0.875rem;color:#6b7280;margin-top:4px;">This is automatically updated when donations are made, but you can manually adjust it.</p>
        </div>

        <div style="display:flex;gap:16px;margin-bottom:16px;">
            <div style="flex:1;">
                <label style="display:block;margin-bottom:4px;font-weight:500;">Start Date</label>
                <input type="date" name="start_date" value="{{ old('start_date', $goal->start_date?->format('Y-m-d')) }}" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:4px;">
            </div>
            <div style="flex:1;">
                <label style="display:block;margin-bottom:4px;font-weight:500;">End Date</label>
                <input type="date" name="end_date" value="{{ old('end_date', $goal->end_date?->format('Y-m-d')) }}" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:4px;">
            </div>
        </div>

        <div style="margin-bottom:16px;">
            <label style="display:block;margin-bottom:4px;font-weight:500;">Progress Bar Color</label>
            <div style="display:flex;gap:8px;flex-wrap:wrap;">
                @php $colors = ['#3b82f6' => 'Blue', '#10b981' => 'Green', '#f59e0b' => 'Orange', '#ef4444' => 'Red', '#8b5cf6' => 'Purple', '#ec4899' => 'Pink']; @endphp
                @foreach ($colors as $color => $label)
                    <label style="display:flex;align-items:center;gap:4px;cursor:pointer;padding:4px 8px;border:1px solid #e5e7eb;border-radius:4px;{{ old('color', $goal->color) === $color ? 'background:#f3f4f6;' : '' }}">
                        <input type="radio" name="color" value="{{ $color }}" {{ old('color', $goal->color) === $color ? 'checked' : '' }} style="display:none;">
                        <span style="width:16px;height:16px;background:{{ $color }};border-radius:4px;"></span>
                        <span>{{ $label }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div style="margin-bottom:24px;">
            <label style="display:flex;align-items:center;gap:8px;cursor:pointer;margin-bottom:8px;">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $goal->is_active) ? 'checked' : '' }} style="width:18px;height:18px;">
                <span>Active (accepting donations toward this goal)</span>
            </label>
            <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                <input type="checkbox" name="show_progress" value="1" {{ old('show_progress', $goal->show_progress) ? 'checked' : '' }} style="width:18px;height:18px;">
                <span>Show progress bar on public donation page</span>
            </label>
        </div>

        <div style="display:flex;gap:12px;">
            <button type="submit" style="padding:10px 20px;background:#1e293b;color:#fff;border:none;border-radius:4px;cursor:pointer;">Update Goal</button>
            <a href="{{ route('admin.goals.index') }}" style="padding:10px 20px;background:#f3f4f6;color:#374151;border-radius:4px;text-decoration:none;">Cancel</a>
        </div>
    </form>

    <div style="margin-top:32px;padding:16px;background:#f9fafb;border-radius:8px;">
        <h3 style="margin-bottom:8px;">Progress Preview</h3>
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:8px;">
            <div style="flex:1;height:20px;background:#e5e7eb;border-radius:4px;overflow:hidden;">
                <div style="width:{{ min(100, $goal->progress_percentage) }}%;height:100%;background:{{ $goal->color ?? '#3b82f6' }};"></div>
            </div>
            <span style="font-weight:500;">{{ $goal->progress_percentage }}%</span>
        </div>
        <p style="font-size:0.875rem;color:#6b7280;">
            ${{ number_format($goal->current_amount, 2) }} raised of ${{ number_format($goal->target_amount, 2) }} goal
            @if($goal->remaining_amount > 0)
                — ${{ number_format($goal->remaining_amount, 2) }} remaining
            @else
                — Goal reached!
            @endif
        </p>
    </div>
@endsection
