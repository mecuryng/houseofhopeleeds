@extends('layouts.app')

@section('title', 'Sermons') {{-- or Sermons / Give --}}
@section('content')
    
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold mb-8 text-center">Our Sermons</h1>

    @if(count($sermons ?? []) > 0)
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
            <div class="mt-4">
                <a href="{{ route('sermons.show', $sermon->id) }}" class="btn btn-sm btn-primary">Open</a>
                @if($sermon->video_url)
                    <a href="{{ $sermon->video_url }}" target="_blank" class="ms-2 small text-muted">(raw)</a>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center text-gray-600">
        <p>No sermons available at the moment. Please check back later.</p>
    </div>
    @endif
</div>
@endsection