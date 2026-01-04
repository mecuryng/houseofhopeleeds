@extends('layouts.pastor')

@section('content')
    <div class="pastor-header">
        <h1>Welcome Pastor {{ auth()->user()->name }}</h1>
        <p>Manage your sermons and ministry content</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:2rem;margin-bottom:2rem;">
        <div class="pastor-content" style="text-align:center;">
            <h3 style="margin:0 0 1rem 0;">Your Sermons</h3>
            <div style="font-size:3rem;font-weight:bold;color:#3b82f6;margin-bottom:0.5rem;">
                {{ auth()->user()->sermons()->count() }}
            </div>
            <p style="margin:0;color:#6b7280;">Total sermons preached</p>
        </div>

        <div class="pastor-content" style="text-align:center;">
            <h3 style="margin:0 0 1rem 0;">Recent Activity</h3>
            <div style="display:flex;flex-direction:column;gap:0.5rem;">
                <div><small>Latest sermon: {{ auth()->user()->sermons()->latest()->first()?->title ?? 'None' }}</small></div>
                <div><small>This month: {{ auth()->user()->sermons()->whereMonth('created_at', now()->month)->count() }} sermons</small></div>
            </div>
        </div>

        <div class="pastor-content" style="text-align:center;">
            <h3 style="margin:0 0 1rem 0;">Quick Actions</h3>
            <div style="display:flex;flex-direction:column;gap:1rem;">
                <a href="{{ route('pastor.sermons.create') }}" class="pastor-btn-primary" style="font-size:0.875rem;">+ New Sermon</a>
                <a href="{{ route('pastor.sermons.index') }}" class="pastor-btn-secondary" style="font-size:0.875rem;">View All Sermons</a>
            </div>
        </div>
    </div>

    <div class="pastor-content">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;">
            <h2 style="margin:0;">Recent Sermons</h2>
            <a href="{{ route('pastor.sermons.index') }}" class="pastor-btn-primary">View All Sermons</a>
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
                    @forelse (auth()->user()->sermons()->with(['comments', 'likes'])->latest()->take(5)->get() as $sermon)
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
                                <a href="{{ route('pastor.sermons.edit', $sermon) }}" style="color:#3b82f6;text-decoration:none;">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="padding:3rem;text-align:center;color:#6B7280;">
                                <div style="margin-bottom:1rem;">You haven't created any sermons yet.</div>
                                <a href="{{ route('pastor.sermons.create') }}" class="pastor-btn-primary">Create Your First Sermon</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
