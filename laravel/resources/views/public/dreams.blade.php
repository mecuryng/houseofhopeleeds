@extends('layouts.app')

@section('title','Revelations & Visions')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Revelations &amp; Visions</h2>
                <p class="text-muted">Stories and revelations shared by our leaders</p>
            </div>
            <div class="row g-4">
                @forelse($dreams as $dream)
                    <article class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <h3 class="h5"><a href="{{ route('dreams.show', $dream) }}" class="text-decoration-none">{{ $dream->title }}</a></h3>
                                <p class="text-muted small mb-2">Posted {{ $dream->created_at->diffForHumans() }} by {{ $dream->user?->name }}</p>
                                <p>{{ Str::limit($dream->content, 120) }}</p>
                                <a href="{{ route('dreams.show', $dream) }}" class="text-primary">Read more</a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No dreams or visions have been posted yet.</p>
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-4">
                {{ $dreams->links() }}
            </div>
        </div>
    </section>
@endsection
