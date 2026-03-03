@extends('layouts.admin')

@section('title', 'Reflections Management')
@section('content')
    <div class="admin-header">
        <div style="display:flex;justify-content:space-between;align-items:center;">
            <h1>Reflections</h1>
            <a href="{{ route('admin.reflections.create') }}" class="admin-btn-primary">+ Add Reflection</a>
        </div>
    </div>

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
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reflections as $reflection)
                    <tr>
                        <td>{{ $reflection->title }}</td>
                        <td>{{ $reflection->date ? $reflection->date->format('M d, Y') : '-' }}</td>
                        <td>
                            <a href="{{ route('admin.reflections.edit', $reflection) }}" style="color:#3b82f6;text-decoration:none;margin-right:1rem;">Edit</a>
                            <form action="{{ route('admin.reflections.destroy', $reflection) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="admin-btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="padding:2rem;text-align:center;color:#6B7280;">No reflections found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($reflections->hasPages())
        <div style="margin-top:2rem;">
            {{ $reflections->links() }}
        </div>
    @endif
@endsection
