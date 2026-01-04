@extends('layouts.admin')

@section('title', 'Sermon Comments')
@section('content')
    <div class="admin-header">
        <h1>Sermon Comments</h1>
    </div>

    @if(session('success'))
        <div class="admin-alert admin-alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" style="margin-bottom:2rem;display:flex;gap:1rem;flex-wrap:wrap;">
        <input type="text" name="q" style="padding:0.5rem;border:1px solid #d1d5db;border-radius:6px;flex:1;min-width:200px;" placeholder="Search name, email or content" value="{{ request('q') }}">
        <select name="sermon_id" style="padding:0.5rem;border:1px solid #d1d5db;border-radius:6px;min-width:150px;">
            <option value="">All sermons</option>
            @foreach(App\Models\Sermon::orderBy('date','desc')->pluck('title','id') as $id => $title)
                <option value="{{ $id }}" {{ request('sermon_id') == $id ? 'selected' : '' }}>{{ $title }}</option>
            @endforeach
        </select>
        <button class="admin-btn-primary" type="submit">Filter</button>
    </form>

    <div class="admin-table">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sermon</th>
                    <th>Author</th>
                    <th>Email</th>
                    <th>Content</th>
                    <th>Approved</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td><a href="{{ route('sermons.show', $comment->sermon_id) }}" style="color:#3b82f6;text-decoration:none;">{{ $comment->sermon->title ?? '—' }}</a></td>
                    <td>{{ $comment->user?->name ?? $comment->name ?? 'Guest' }}</td>
                    <td>{{ $comment->email }}</td>
                    <td style="max-width:300px;word-wrap:break-word;">{{ \Illuminate\Support\Str::limit($comment->content, 120) }}</td>
                    <td>{{ $comment->approved ? 'Yes' : 'No' }}</td>
                    <td>{{ $comment->created_at->format('M d, Y H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.sermon-comments.approve', $comment->id) }}" method="POST" style="display:inline;margin-right:0.5rem;">
                            @csrf
                            <button class="admin-btn-primary" style="background:{{ $comment->approved ? '#f59e0b' : '#10b981' }};font-size:0.875rem;">{{ $comment->approved ? 'Unapprove' : 'Approve' }}</button>
                        </form>
                        <form action="{{ route('admin.sermon-comments.destroy', $comment->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this comment?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="padding:2rem;text-align:center;color:#6B7280;">No comments found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($comments->hasPages())
        <div style="margin-top:2rem;">
            {{ $comments->links() }}
        </div>
    @endif
@endsection
