@extends('layouts.admin')

@section('title', 'Sermons Management')
@section('content')
    <div class="admin-header">
        <div style="display:flex;justify-content:space-between;align-items:center;">
            <h1>Sermons</h1>
            <a href="{{ route('admin.sermons.create') }}" class="admin-btn-primary">+ Add Sermon</a>
        </div>
    </div>

    <form method="GET" style="margin-bottom:2rem;">
        <select name="pastor_filter" onchange="this.form.submit()" style="padding:0.5rem;border:1px solid #d1d5db;border-radius:6px;">
            <option value="">All Pastors</option>
            @foreach(\App\Models\User::where('role', 'pastor')->get() as $pastor)
                <option value="{{ $pastor->id }}" {{ request('pastor_filter') == $pastor->id ? 'selected' : '' }}>
                    {{ $pastor->name }}
                </option>
            @endforeach
        </select>
    </form>

    @if (session('success'))
        <div class="admin-alert admin-alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="admin-table">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Pastor</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sermons as $sermon)
                    <tr>
                        <td>{{ $sermon->title }}</td>
                        <td>{{ $sermon->pastor ? $sermon->pastor->name : 'N/A' }}</td>
                        <td>{{ $sermon->date->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('admin.sermons.edit', $sermon) }}" style="color:#3b82f6;text-decoration:none;margin-right:1rem;">Edit</a>
                            <form action="{{ route('admin.sermons.destroy', $sermon) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="admin-btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding:2rem;text-align:center;color:#6B7280;">No sermons found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($sermons->hasPages())
        <div style="margin-top:2rem;">
            {{ $sermons->links() }}
        </div>
    @endif
@endsection
