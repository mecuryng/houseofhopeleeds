@extends('layouts.admin')

@section('title', 'Dashboard')
@section('content')
    <div class="admin-header">
        <h1>Welcome, {{ auth()->user()->name }}</h1>
        <p>Role: <strong>{{ ucfirst(auth()->user()->role) }}</strong></p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:2rem;">
        <div class="admin-table" style="padding:2rem;text-align:center;">
            <h3 style="margin:0 0 1rem 0;">Quick Stats</h3>
            <div style="display:flex;flex-direction:column;gap:1rem;">
                <div>
                    <strong>Total Members:</strong> {{ \App\Models\User::where('role', 'member')->count() }}
                </div>
                <div>
                    <strong>Upcoming Events:</strong> {{ \App\Models\Event::where('date', '>=', now())->count() }}
                </div>
                <div>
                    <strong>Total Sermons:</strong> {{ \App\Models\Sermon::count() }}
                </div>
                <div>
                    <strong>Prayer Requests:</strong> {{ \App\Models\PrayerRequest::count() }}
                </div>
            </div>
        </div>

        <div class="admin-table" style="padding:2rem;">
            <h3 style="margin:0 0 1rem 0;">Recent Activity</h3>
            <div style="display:flex;flex-direction:column;gap:0.5rem;">
                <div><small>Latest sermon: {{ \App\Models\Sermon::latest()->first()?->title ?? 'None' }}</small></div>
                <div><small>Next event: {{ \App\Models\Event::where('date', '>=', now())->orderBy('date')->first()?->title ?? 'None' }}</small></div>
                <div><small>New prayer requests: {{ \App\Models\PrayerRequest::where('created_at', '>=', now()->subDays(7))->count() }}</small></div>
            </div>
        </div>
    </div>
@endsection
