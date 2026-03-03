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
            
            {{-- Like / Share / Comments toolbar similar to sermons --}}
            @php
                $userId = auth()->id();
                $sessionId = session()->getId();
                $liked = \App\Models\ReflectionLike::where('reflection_id', $reflection->id)
                    ->when($userId, fn($q) => $q->where('user_id', $userId), fn($q) => $q->where('session_id', $sessionId))
                    ->exists();
                $likeCount = \App\Models\ReflectionLike::where('reflection_id', $reflection->id)->count();
                $pageUrl = url()->current();
                $shareTitle = urlencode($reflection->title);
                $shareUrl = urlencode($pageUrl);
            @endphp

            <div class="mt-4 d-flex align-items-center gap-2">
                <button id="likeBtn" class="btn btn-sm {{ $liked ? 'btn-success' : 'btn-outline-primary' }}">
                    <span id="likeText">{{ $liked ? 'Unlike' : 'Like' }}</span>
                    <span id="likeCount" class="ms-2">({{ $likeCount }})</span>
                </button>
                <a href="https://twitter.com/intent/tweet?text={{ $shareTitle }}&url={{ $shareUrl }}" target="_blank" class="btn btn-sm btn-outline-info">Share</a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" class="btn btn-sm btn-outline-primary">Facebook</a>
                <a href="mailto:?subject={{ $shareTitle }}&body=Check%20this%20reflection:%20{{ $shareUrl }}" class="btn btn-sm btn-outline-secondary">Email</a>
            </div>

            {{-- Comments list --}}
            @php $comments = $reflection->comments()->where('approved', true)->latest()->get(); @endphp
            <div class="mt-4">
                <h4>Comments</h4>
                @if($comments->count())
                    @foreach($comments as $c)
                        <div class="mb-3">
                            <strong>{{ $c->name ?? $c->user?->name ?? 'Anonymous' }}</strong>
                            <small class="text-muted ms-2">{{ $c->created_at->diffForHumans() }}</small>
                            <p>{{ $c->content }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">No comments yet — be the first to comment.</p>
                @endif

                <form action="{{ route('reflections.comments.store', $reflection->id) }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Comment</label>
                        <textarea name="content" class="form-control" rows="3" required>{{ old('content') }}</textarea>
                    </div>
                    <button class="btn btn-primary btn-sm" type="submit">Post Comment</button>
                </form>
            </div>

            <script>
            document.getElementById('likeBtn').addEventListener('click', function () {
                fetch("{{ url('/reflections/' . $reflection->id . '/like') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                }).then(res => res.json()).then(data => {
                    document.getElementById('likeText').textContent = data.liked ? 'Unlike' : 'Like';
                    document.getElementById('likeCount').textContent = '(' + data.count + ')';
                    document.getElementById('likeBtn').classList.toggle('btn-success', data.liked);
                    document.getElementById('likeBtn').classList.toggle('btn-outline-primary', !data.liked);
                });
            });
            </script>
        </div>
    </section>
@endsection
