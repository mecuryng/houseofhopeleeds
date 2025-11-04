@extends('layouts.app')

@section('title', 'Welcome')

@section('content')

<div class="hero">
    <h1>Welcome to Our Church</h1>
    <p>We are glad you are here. Join us in worship and fellowship.</p>
    <a href="{{ url('/donate') }}" class="btn btn-warning mt-3">Give Online</a>
</div>

<h2 class="mt-5">Upcoming Events</h2>
<div class="row">
    @forelse($events as $event)
        <div class="col-md-4 mt-3">
            <div class="card">
                <div class="card-body">
                    <h5>{{ $event->title }}</h5>
                    <p><strong>{{ \Carbon\Carbon::parse($event->event_date)->toFormattedDateString() }}</strong></p>
                    <p>{{ Str::limit($event->description, 100) }}</p>
                </div>
            </div>
        </div>
    @empty
        <p>No upcoming events.</p>
    @endforelse
</div>

<h2 class="mt-5">Recent Sermons</h2>
<div class="row">
    @forelse($sermons as $sermon)
        <div class="col-md-4 mt-3">
            <div class="card">
                <div class="card-body">
                    <h5>{{ $sermon->title }}</h5>
                    <p>By {{ $sermon->pastor?->name ?? 'Guest Speaker' }}</p>
                    <p>{{ Str::limit($sermon->content, 100) }}</p>
                </div>
            </div>
        </div>
    @empty
        <p>No sermons available.</p>
    @endforelse
</div>

@endsection
