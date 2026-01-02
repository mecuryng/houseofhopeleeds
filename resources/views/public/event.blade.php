@extends('layouts.app')

@section('title', $event->title ?? 'Event')

@section('content')
<!-- Hero Section -->
    <section class="hero" style="background-image:url('/images/church-bg.png');">
        <div class="container">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-3">Welcome to Grace Community Church Leeds</h1>
                <p class="lead mb-4">A place where you can belong, believe, and become all that God created you to be.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ url('/donate') }}" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-calendar me-2"></i> Join Us This Sunday
                    </a>
                    <a href="{{ url('/about') }}" class="btn btn-outline-light btn-lg px-4">
                        <i class="fas fa-info-circle me-2"></i> Learn More
                    </a>
                </div>
            </div>
        </div>
    </section>

<div class="container my-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card p-4">
                <h1 class="mb-2">{{ $event->title }}</h1>
                <p class="text-muted">{{ optional($event->date)->format('F j, Y') }} @if($event->time) • {{ $event->time }}@endif</p>
                <p class="text-muted">Location: {{ $event->location }}</p>

                <div class="my-4">
                    <h4>Details</h4>
                    <div>{!! nl2br(e($event->description)) !!}</div>
                </div>

                {{-- RSVP form --}}
                <div class="my-4">
                    <h4>RSVP</h4>

                    @if(session('rsvp_success'))
                        <div class="alert alert-success">{{ session('rsvp_success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('events.rsvp', $event->id) }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label class="form-label">Name</label>
                            <input name="name" value="{{ old('name') }}" class="form-control" required />
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Email</label>
                            <input name="email" value="{{ old('email') }}" class="form-control" type="email" required />
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Guests (including you)</label>
                            <input name="guests_count" value="{{ old('guests_count', 1) }}" class="form-control" type="number" min="1" />
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Message (optional)</label>
                            <textarea name="message" class="form-control">{{ old('message') }}</textarea>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit RSVP</button>
                    </form>
                </div>

                <div class="d-flex gap-2 mt-3">
                    {{-- Google Maps link --}}
                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($event->location) }}" target="_blank" class="btn btn-primary">Open in Maps</a>

                    {{-- Google Calendar link (pre-fill) --}}
                    @php
                        $start = optional($event->date)->format('Ymd');
                        $time = $event->time ? preg_replace('/[^0-9:]/', '', $event->time) : '';
                        // attempt to create start/end in basic form: YYYYMMDD or YYYYMMDDTHHMMSSZ
                        $dates = $start;
                        if ($start && $time) {
                            $t = explode(':', $time);
                            $h = str_pad($t[0] ?? '09', 2, '0', STR_PAD_LEFT);
                            $m = str_pad($t[1] ?? '00', 2, '0', STR_PAD_LEFT);
                            $dates = $start.'T'.$h.$m.'00Z/'.$start.'T'.str_pad((int)$h+2,2,'0',STR_PAD_LEFT).$m.'00Z';
                        }
                        $gcal = 'https://www.google.com/calendar/render?action=TEMPLATE&text='.urlencode($event->title).'&dates='.$dates.'&details='.urlencode($event->description).'&location='.urlencode($event->location);
                    @endphp
                    <a href="{{ $gcal }}" target="_blank" class="btn btn-outline-secondary">Add to Google Calendar</a>

                    {{-- Simple RSVP mailto link --}}
                    <a href="mailto:info@{{ request()->getHost() }}?subject=RSVP%20for%20{{ urlencode($event->title) }}" class="btn btn-outline-primary">RSVP</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 mb-3">
                <h5>Other Events</h5>
                <ul class="list-unstyled">
                    @foreach(App\Models\Event::where('id', '!=', $event->id)->orderBy('date','desc')->take(6)->get() as $e)
                        <li class="py-2 border-bottom">
                            <a href="{{ route('events.show', $e->id) }}">{{ $e->title }}</a>
                            <div class="text-muted small">{{ optional($e->date)->format('M j, Y') }}</div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
