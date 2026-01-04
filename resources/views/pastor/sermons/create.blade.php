@extends('layouts.pastor')

@section('content')
    <div class="pastor-header">
        <h1>Create New Sermon</h1>
        <p>Add a new sermon to your collection</p>
    </div>

    @if ($errors->any())
        <div class="pastor-alert pastor-alert-error" style="margin-bottom:2rem;">
            <ul style="margin:0;padding-left:1rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="pastor-content" style="max-width:600px;margin:0 auto;">
        <form action="{{ route('pastor.sermons.store') }}" method="POST" style="background:white;padding:2rem;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,0.05);">
            @csrf

            <div style="margin-bottom:1.5rem;">
                <label for="title" style="display:block;margin-bottom:0.5rem;font-weight:600;color:#374151;">Title *</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:6px;" required>
            </div>

            <div style="margin-bottom:1.5rem;">
                <label for="content" style="display:block;margin-bottom:0.5rem;font-weight:600;color:#374151;">Description</label>
                <textarea id="content" name="content" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:6px;" rows="6">{{ old('content') }}</textarea>
            </div>

            <div style="margin-bottom:1.5rem;">
                <label for="date_preached" style="display:block;margin-bottom:0.5rem;font-weight:600;color:#374151;">Date Preached *</label>
                <input type="date" id="date_preached" name="date_preached" value="{{ old('date_preached', date('Y-m-d')) }}" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:6px;" required>
            </div>

            <div style="margin-bottom:2rem;">
                <label for="video_url" style="display:block;margin-bottom:0.5rem;font-weight:600;color:#374151;">Video/Audio URL</label>
                <input type="text" id="video_url" name="video_url" value="{{ old('video_url') }}" placeholder="https://youtube.com/... or https://vimeo.com/... or direct media URL" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:6px;">
                <small style="color:#6b7280;">Optional: Add a video or audio link for this sermon</small>
            </div>

            <div style="display:flex;gap:1rem;">
                <button type="submit" class="pastor-btn-primary">Create Sermon</button>
                <a href="{{ route('pastor.sermons.index') }}" class="pastor-btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection