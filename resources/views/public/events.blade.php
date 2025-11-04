@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold mb-8 text-center">Our Events</h1>

    @if(count($events ?? []) > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($events as $event)
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold mb-2">{{ $event->title }}</h3>
            <p class="text-gray-600 mb-4">{{ $event->description }}</p>
            <div class="text-sm text-gray-500">
                <p>Date: {{ $event->date->format('F j, Y') }}</p>
                <p>Time: {{ $event->time }}</p>
                <p>Location: {{ $event->location }}</p>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center text-gray-600">
        <p>No upcoming events at the moment. Please check back later.</p>
    </div>
    @endif
</div>
@endsection