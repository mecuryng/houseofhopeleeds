@extends('layouts.admin')

@section('content')
    <h1>Add Sermon</h1>

    @if ($errors->any())
        <div style="padding:10px;background:#fee2e2;border:1px solid #fca5a5;margin-bottom:16px;color:#7f1d1d;">
            <ul style="margin:0;padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.sermons.store') }}" method="POST">
        @csrf

        <div style="margin-bottom:8px;">
            <label>Title</label><br>
            <input type="text" name="title" value="{{ old('title') }}" style="width:100%;padding:8px;" required>
        </div>

        <div style="margin-bottom:8px;">
            <label>Content</label><br>
            <textarea name="content" style="width:100%;padding:8px;" rows="4">{{ old('content') }}</textarea>
        </div>

        <div style="margin-bottom:8px;">
            <label>Date Preached</label><br>
            <input type="date" name="date_preached" value="{{ old('date_preached') }}" style="padding:8px;" required>
        </div>

        <div style="margin-bottom:8px;">
            <label>Pastor</label><br>
            <select name="pastor_id" style="padding:8px;">
                <option value="">Select a pastor</option>
                @foreach ($pastors as $pastor)
                    <option value="{{ $pastor->id }}" {{ old('pastor_id') == $pastor->id ? 'selected' : '' }}>
                        {{ $pastor->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div style="margin-bottom:8px;">
            <label>Video URL</label><br>
            <input type="text" name="video_url" value="{{ old('video_url') }}" style="width:100%;padding:8px;">
        </div>
        <div>
            <button type="submit" style="padding:8px 12px;background:#1e293b;color:#fff;border:none;">Create Sermon</button>
            <a href="{{ route('admin.sermons.index') }}" style="margin-left:12px;">Cancel</a>
        </div>
    </form>
@endsection
