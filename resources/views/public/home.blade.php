@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="text-center">
        <h1 class="text-4xl font-bold mb-4">Welcome to House of Hope Leeds</h1>
        <p class="text-lg mb-8">A place of worship, hope, and community</p>
    </div>

    @if(count($events ?? []) > 0)
    <div class="mb-12">
        <h2 class="text-2xl font-semibold mb-4">Upcoming Events</h2>
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
    </div>
    @endif

    @if(count($sermons ?? []) > 0)
    <div class="mb-12">
        <h2 class="text-2xl font-semibold mb-4">Latest Sermons</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($sermons as $sermon)
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold mb-2">{{ $sermon->title }}</h3>
                <p class="text-gray-600 mb-4">{{ $sermon->description }}</p>
                <div class="text-sm text-gray-500">
                    <p>Date: {{ $sermon->date->format('F j, Y') }}</p>
                    @if($sermon->pastor)
                    <p>Pastor: {{ $sermon->pastor->name }}</p>
                    @endif
                </div>
                @if($sermon->video_url)
                <a href="{{ $sermon->video_url }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800">
                    Watch Sermon
                </a>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <div class="text-center">
        <a href="{{ route('about') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
            Learn More About Us
        </a>
    </div>
</div>
@endsection