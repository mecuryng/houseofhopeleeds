@extends('layouts.admin')

@section('content')
    <h1>Add Revelation or Vision</h1>

    <form method="POST" action="{{ route('admin.dreams.store') }}" enctype="multipart/form-data">
        @csrf
    @if ($errors->any())
        <div style="padding:10px;background:#fee2e2;border:1px solid #fca5a5;margin-bottom:16px;color:#7f1d1d;">
            <ul style="margin:0;padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="margin-bottom:8px;">
        <label>Title</label><br>
        <input type="text" name="title" value="{{ old('title') }}" style="width:100%;padding:8px;" required>
    </div>

    <div style="margin-bottom:8px;">
        <label>Content</label><br>
        <textarea name="content" style="width:100%;padding:8px;" rows="5" required>{{ old('content') }}</textarea>
    </div>

    <div style="margin-bottom:8px;">
        <label>Attachment (image or PDF)</label><br>
        <input type="file" name="attachment" style="padding:8px;">
    </div>

    <div>
        <button type="submit" style="padding:8px 12px;background:#1e293b;color:#fff;border:none;">Create Revelation</button>
        <a href="{{ route('admin.dreams.index') }}" style="margin-left:12px;">Cancel</a>
    </div>
    </form>
@endsection
