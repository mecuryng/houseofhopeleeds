@extends('layouts.admin')

@section('content')
<x-page-title>Events Management</x-page-title>

<a href="{{ route('admin.events.create') }}">+ Add Event</a><br><br>

@if(session('success'))
<div style="background:#d1fae5;padding:10px;">{{ session('success') }}</div><br>
@endif

<table border="1" width="100%" cellpadding="10">
<tr style="background:#1e293b;color:white;">
<th>Title</th><th>Date</th><th>Venue</th><th>Action</th>
</tr>
@foreach($events as $event)
<tr>
<td>{{ $event->title }}</td>
<td>{{ $event->event_date }}</td>
<td>{{ $event->venue }}</td>
<td>
<a href="{{ route('admin.events.edit', $event->id) }}">Edit</a> |
<form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="display:inline;">
@csrf @method('DELETE')
<button type="submit" onclick="return confirm('Delete this event?')">Delete</button>
</form>
</td>
</tr>
@endforeach
</table>
{{ $events->links() }}
@endsection
