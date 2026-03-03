@extends('layouts.admin')

@section('content')
    <h1>Edit Reflection</h1>

    @if ($errors->any())
        <div style="padding:10px;background:#fee2e2;border:1px solid #fca5a5;margin-bottom:16px;color:#7f1d1d;">
            <ul style="margin:0;padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.reflections.update', $reflection) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="margin-bottom:8px;">
            <label>Title</label><br>
            <input type="text" name="title" value="{{ old('title', $reflection->title) }}" style="width:100%;padding:8px;" required>
        </div>

        <div style="margin-bottom:8px;">
            <label>Content</label><br>
            <textarea name="content" style="width:100%;padding:8px;" rows="5">{{ old('content', $reflection->content) }}</textarea>
        </div>

        <div style="margin-bottom:8px;">
            <label>Date</label><br>
            <input type="date" name="date" value="{{ old('date', $reflection->date ? $reflection->date->format('Y-m-d') : '') }}" style="padding:8px;">
        </div>

        <div style="margin-bottom:8px;">
            <label>Image (optional)</label><br>
            @if($reflection->image_path)
                <div style="margin-bottom:4px;"><a href="{{ asset('storage/' . $reflection->image_path) }}" target="_blank">Current image</a></div>
            @endif
            <input type="file" name="image" style="padding:8px;">
        </div>

        <div>
            <button type="submit" style="padding:8px 12px;background:#1e293b;color:#fff;border:none;">Update Reflection</button>
            <a href="{{ route('admin.reflections.index') }}" style="margin-left:12px;">Cancel</a>
        </div>
    </form>
@endsection
