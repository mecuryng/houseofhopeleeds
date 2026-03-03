@extends('layouts.app')

@section('title', $reflection->title)

@section('content')
    <section class="py-5">
        <div class="container">
            <h1 class="mb-4">{{ $reflection->title }}</h1>
            @if($reflection->date)
                <p class="text-muted small mb-4">{{ $reflection->date->format('F j, Y') }}</p>
            @endif
            @if($reflection->image_path)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $reflection->image_path) }}" alt="{{ $reflection->title }}" class="img-fluid">
                </div>
            @endif
            <div class="content">
                {!! nl2br(e($reflection->content)) !!}
            </div>
        </div>
    </section>
@endsection
