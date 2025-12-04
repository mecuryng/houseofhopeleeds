@extends('layouts.admin')

@section('content')
<x-page-title>Sermon Comments</x-page-title>

<div class="card p-3">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" class="d-flex gap-2 mb-3" style="flex-wrap:wrap;">
        <input type="text" name="q" class="form-control form-control-sm" placeholder="Search name, email or content" value="{{ request('q') }}">
        <select name="sermon_id" class="form-select form-select-sm">
            <option value="">All sermons</option>
            @foreach(App\Models\Sermon::orderBy('date','desc')->pluck('title','id') as $id => $title)
                <option value="{{ $id }}" {{ request('sermon_id') == $id ? 'selected' : '' }}>{{ $title }}</option>
            @endforeach
        </select>
        <button class="btn btn-sm btn-primary" type="submit">Filter</button>
    </form>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Sermon</th>
                    <th>Author</th>
                    <th>Email</th>
                    <th>Content</th>
                    <th>Approved</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td><a href="{{ route('sermons.show', $comment->sermon_id) }}">{{ $comment->sermon->title ?? '—' }}</a></td>
                    <td>{{ $comment->user?->name ?? $comment->name ?? 'Guest' }}</td>
                    <td>{{ $comment->email }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($comment->content, 120) }}</td>
                    <td>{{ $comment->approved ? 'Yes' : 'No' }}</td>
                    <td>{{ $comment->created_at->format('Y-m-d H:i') }}</td>
                    <td class="d-flex gap-2">
                        <form action="{{ route('admin.sermon-comments.approve', $comment->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-outline-{{ $comment->approved ? 'warning' : 'success' }}">{{ $comment->approved ? 'Unapprove' : 'Approve' }}</button>
                        </form>
                        <form action="{{ route('admin.sermon-comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Delete this comment?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $comments->links() }}
    </div>
</div>

@endsection
