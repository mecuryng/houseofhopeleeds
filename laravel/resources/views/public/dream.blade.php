@extends('layouts.app')

@section('title', $dream->title)

@section('content')
    <section class="py-5">
        <div class="container">
            <h1 class="mb-4">{{ $dream->title }}</h1>
            <p class="text-muted small mb-4">Posted {{ $dream->created_at->format('F j, Y') }} by {{ $dream->user?->name }}</p>
            <div class="content">
                {!! nl2br(e($dream->content)) !!}
            </div>
            @if($dream->attachment_path)
                <div class="mb-4">
                    <a href="{{ asset('storage/' . $dream->attachment_path) }}" class="btn btn-outline-secondary" target="_blank">
                        <i class="fas fa-file-download me-1"></i> Download attachment
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection
