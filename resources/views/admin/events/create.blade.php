@extends('layouts.admin')

@section('content')
    <h1>Add Event</h1>

    @if ($errors->any())
        <div style="padding:10px;background:#fee2e2;border:1px solid #fca5a5;margin-bottom:16px;color:#7f1d1d;">
            <ul style="margin:0;padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.events.store') }}" method="POST">
        @csrf

        <div style="margin-bottom:8px;">
            <label>Title</label><br>
            <input type="text" name="title" value="{{ old('title') }}" style="width:100%;padding:8px;" required>
        </div>

        <div style="margin-bottom:8px;">
            <label>Description</label><br>
            <textarea name="description" style="width:100%;padding:8px;" rows="4">{{ old('description') }}</textarea>
        </div>

        <div style="margin-bottom:8px;">
            <label>Date</label><br>
            <input type="date" name="event_date" value="{{ old('date') }}" style="padding:8px;" required>
        </div>

        <div style="margin-bottom:8px;">
            <label>Time</label><br>
            <input type="time" name="time" value="{{ old('time') }}" style="padding:8px;">
        </div>

        <div style="margin-bottom:8px;">
            <label>Location</label><br>
            <input type="text" name="location" value="{{ old('location') }}" style="width:100%;padding:8px;">
        </div>

        <div>
            <button type="submit" style="padding:8px 12px;background:#1e293b;color:#fff;border:none;">Create Event</button>
            <a href="{{ route('admin.events.index') }}" style="margin-left:12px;">Cancel</a>
        </div>
    </form>
@endsection
