@extends('layouts.pastor')

@section('content')
    <div class="pastor-header">
        <h1>Edit Sermon</h1>
        <p>Update your sermon: {{ $sermon->title }}</p>
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
        <form action="{{ route('pastor.sermons.update', $sermon) }}" method="POST" style="background:white;padding:2rem;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,0.05);" enctype="multipart/form-data">

            <div style="margin-bottom:1.5rem;">
                <label for="title" style="display:block;margin-bottom:0.5rem;font-weight:600;color:#374151;">Title *</label>
                <input type="text" id="title" name="title" value="{{ old('title', $sermon->title) }}" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:6px;" required>
            </div>

            <div style="margin-bottom:1.5rem;">
                <label for="content" style="display:block;margin-bottom:0.5rem;font-weight:600;color:#374151;">Description</label>
                <textarea id="content" name="content" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:6px;" rows="6">{{ old('content', $sermon->description) }}</textarea>
            </div>

            <div style="margin-bottom:1.5rem;">
                <label for="date_preached" style="display:block;margin-bottom:0.5rem;font-weight:600;color:#374151;">Date Preached *</label>
                <input type="date" id="date_preached" name="date_preached" value="{{ old('date_preached', $sermon->date->format('Y-m-d')) }}" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:6px;" required>
            </div>

            <div style="margin-bottom:2rem;">
                <label for="video_url" style="display:block;margin-bottom:0.5rem;font-weight:600;color:#374151;">Video/Audio URL</label>
                <input type="text" id="video_url" name="video_url" value="{{ old('video_url', $sermon->video_url) }}" placeholder="https://youtube.com/... or https://vimeo.com/... or direct media URL" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:6px;">
                <small style="color:#6b7280;">Optional: Add a video or audio link for this sermon</small>
            </div>

            <div style="margin-bottom:2rem;">
                <label for="image" style="display:block;margin-bottom:0.5rem;font-weight:600;color:#374151;">Sermon Image (optional)</label>
                @if($sermon->image_path)
                    <div style="margin-bottom:12px;">
                        <img src="{{ asset('storage/' . $sermon->image_path) }}" style="max-width:100%;max-height:150px;border-radius:6px;">
                        <div style="margin-top:8px;">
                            <label style="display:inline-flex;align-items:center;cursor:pointer;">
                                <input type="checkbox" name="remove_image" style="margin-right:8px;">
                                <span style="font-size:14px;">Remove current image</span>
                            </label>
                        </div>
                    </div>
                @endif
                <input type="file" id="image" name="image" style="width:100%;padding:0.75rem;border:1px solid #d1d5db;border-radius:6px;">
                <small style="color:#6b7280;">Upload an image to display above the sermon title</small>
            </div>

            <div style="display:flex;gap:1rem;align-items:center;">
                <button type="submit" class="pastor-btn-primary">Update Sermon</button>
                <a href="{{ route('pastor.sermons.index') }}" class="pastor-btn-secondary">Cancel</a>
            </div>
        </form>

        <div style="margin-top:2rem;padding:2rem;background:white;border-radius:10px;box-shadow:0 2px 10px rgba(0,0,0,0.05);">
            <h3 style="color:#dc2626;margin-bottom:1rem;">Danger Zone</h3>
            <p style="color:#6b7280;margin-bottom:1rem;">Once you delete this sermon, there is no going back. Please be certain.</p>
            <form action="{{ route('pastor.sermons.destroy', $sermon) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this sermon? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="pastor-btn-danger" style="font-weight:600;">🗑️ Delete Sermon</button>
            </form>
        </div>
    </div>
@endsection