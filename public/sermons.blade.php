<h1>Upcoming Events</h1>
@foreach($events as $event)
    <div style="border:1px solid #ccc;padding:10px;margin:10px;">
        <h3>{{ $event->title }}</h3>
        <p>{{ $event->event_date }} @ {{ $event->venue }}</p>
        <p>{{ $event->description }}</p>
    </div>
@endforeach
