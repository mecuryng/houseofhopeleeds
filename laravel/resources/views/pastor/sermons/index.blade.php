@extends('layouts.pastor')

@section('content')
    <div class="pastor-header">
        <h1>My Sermons</h1>
        <p>Manage and view all your sermon content</p>
    </div>

    @if (session('success'))
        <div class="pastor-alert pastor-alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="pastor-content">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;">
            <h2 style="margin:0;">All Sermons</h2>
            <a href="{{ route('pastor.sermons.create') }}" class="pastor-btn-primary">+ Add New Sermon</a>
        </div>

        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;border:1px solid #e5e7eb;border-radius:8px;">
                <thead style="background:#f8fafc;">
                    <tr>
                        <th style="padding:1rem;text-align:left;border-bottom:1px solid #e5e7eb;">Title</th>
                        <th style="padding:1rem;text-align:left;border-bottom:1px solid #e5e7eb;">Date</th>
                        <th style="padding:1rem;text-align:left;border-bottom:1px solid #e5e7eb;">Status</th>
                        <th style="padding:1rem;text-align:left;border-bottom:1px solid #e5e7eb;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sermons as $sermon)
                        <tr style="border-bottom:1px solid #f3f4f6;">
                            <td style="padding:1rem;">{{ $sermon->title }}</td>
                            <td style="padding:1rem;">{{ $sermon->date->format('M d, Y') }}</td>
                            <td style="padding:1rem;">
                                @if($sermon->video_url)
                                    <span style="color:#10b981;font-weight:500;">✓ With Media</span>
                                @else
                                    <span style="color:#f59e0b;font-weight:500;">Draft</span>
                                @endif
                            </td>
                            <td style="padding:1rem;">
                                <a href="{{ route('sermons.show', $sermon->id) }}" style="color:#3b82f6;text-decoration:none;margin-right:1rem;">View</a>
                                <a href="{{ route('pastor.sermons.edit', $sermon) }}" style="color:#3b82f6;text-decoration:none;margin-right:1rem;">Edit</a>
                                <form action="{{ route('pastor.sermons.destroy', $sermon) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this sermon?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="pastor-btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="padding:3rem;text-align:center;color:#6B7280;">
                                <div style="margin-bottom:1rem;">No sermons found.</div>
                                <a href="{{ route('pastor.sermons.create') }}" class="pastor-btn-primary">Create Your First Sermon</a>
                            </td>
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