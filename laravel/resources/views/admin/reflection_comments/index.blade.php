@extends('layouts.admin')

@section('content')
    <div class="admin-header">
        <h1>Reflection Comments</h1>
    </div>

    @if(session('success'))
        <div class="admin-alert admin-alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" style="margin-bottom:2rem;display:flex;gap:1rem;flex-wrap:wrap;">
        <input type="text" name="q" style="padding:0.5rem;border:1px solid #d1d5db;border-radius:6px;flex:1;min-width:200px;" placeholder="Search name, email or content" value="{{ request('q') }}">
        <select name="reflection_id" style="padding:0.5rem;border:1px solid #d1d5db;border-radius:6px;min-width:150px;">
            <option value="">All reflections</option>
            @foreach(App\Models\Reflection::orderBy('created_at','desc')->pluck('title','id') as $id => $title)
                <option value="{{ $id }}" {{ request('reflection_id') == $id ? 'selected' : '' }}>{{ $title }}</option>
            @endforeach
        </select>
        <button class="admin-btn-primary" type="submit">Filter</button>
    </form>

    <div class="admin-table">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Reflection</th>
                    <th>Author</th>
                    <th>Email</th>
                    <th>Content</th>
                    <th>Approved</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($comments as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td><a href="{{ route('reflections.show', $c->reflection_id) }}" style="color:#3b82f6;text-decoration:none;">{{ $c->reflection->title ?? '—' }}</a></td>
                    <td>{{ $c->user?->name ?? $c->name ?? 'Guest' }}</td>
                    <td>{{ $c->email }}</td>
                    <td style="max-width:300px;word-wrap:break-word;">{{ \Illuminate\Support\Str::limit($c->content, 120) }}</td>
                    <td>{{ $c->approved ? 'Yes' : 'No' }}</td>
                    <td>{{ $c->created_at->format('M d, Y H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.reflection-comments.approve', $c->id) }}" method="POST" style="display:inline;margin-right:0.5rem;">
                            @csrf
                            <button class="admin-btn-primary" style="background:{{ $c->approved ? '#f59e0b' : '#10b981' }};font-size:0.875rem;">{{ $c->approved ? 'Unapprove' : 'Approve' }}</button>
                        </form>
                        <form action="{{ route('admin.reflection-comments.destroy', $c->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this comment?');">
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
