@extends('layouts.app')

@section('title', $sermon->title ?? 'Sermon')

@section('content')
<!-- Hero Section -->
    <section class="hero" style="background-image:url('/images/church-bg.png');">
        <div class="container">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-3">Welcome to House of Hope Leeds</h1>
                <p class="lead mb-4">A place to belong, grow, and shine.</p>
                <div class="d-flex flex-wrap gap-5 justify-content-center">
                    <a href="{{ url('/donate') }}" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-calendar me-2"></i> Support Our Work
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
                <h1 class="mb-2">{{ $sermon->title }}</h1>
                @if($sermon->pastor)
                    <p class="text-muted">By {{ $sermon->pastor->name }}</p>
                @endif
                <p class="text-muted">{{ optional($sermon->date)->format('F j, Y') }}</p>

                <div class="my-3">
                    @php
                        $media = $sermon->video_url ?? null;
                        $isYouTube = $media && (str_contains($media, 'youtube.com') || str_contains($media, 'youtu.be'));
                        $isVimeo = $media && str_contains($media, 'vimeo.com');
                        $isAudio = $media && preg_match('/\.(mp3|wav|ogg)$/i', $media);
                        $isVideoFile = $media && preg_match('/\.(mp4|webm|ogg)$/i', $media);
                    @endphp

                    @if($isYouTube)
                        {{-- Embed YouTube --}}
                        @php
                            // Extract YouTube ID
                            if (preg_match('/(v=|\/)([A-Za-z0-9_-]{11})/', $media, $m)) {
                                $ytId = $m[2];
                            } else {
                                // fallback: try last path segment
                                $parts = explode('/', rtrim($media, '/'));
                                $ytId = end($parts);
                            }
                        @endphp
                        <div class="embed-responsive embed-responsive-16by9 mb-3">
                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $ytId }}" allowfullscreen style="width:100%;height:420px;border:0"></iframe>
                        </div>
                    @elseif($isVimeo)
                        {{-- Embed Vimeo --}}
                        <div class="embed-responsive embed-responsive-16by9 mb-3">
                            <iframe src="{{ $media }}" style="width:100%;height:420px;border:0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                        </div>
                    @elseif($isVideoFile)
                        <video id="sermonVideo" controls style="width:100%;max-height:520px;"> 
                            <source src="{{ $media }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <div class="mt-2">
                            <label for="speed">Speed:</label>
                            <select id="speed" class="form-select form-select-sm d-inline-block" style="width:auto;margin-left:8px;">
                                <option value="1">1x</option>
                                <option value="1.25">1.25x</option>
                                <option value="1.5">1.5x</option>
                                <option value="2">2x</option>
                            </select>
                        </div>
                    @elseif($isAudio)
                        <audio id="sermonAudio" controls style="width:100%;">
                            <source src="{{ $media }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                        <div class="mt-2">
                            <label for="speedAudio">Speed:</label>
                            <select id="speedAudio" class="form-select form-select-sm d-inline-block" style="width:auto;margin-left:8px;">
                                <option value="1">1x</option>
                                <option value="1.25">1.25x</option>
                                <option value="1.5">1.5x</option>
                                <option value="2">2x</option>
                            </select>
                        </div>
                    @else
                        <p class="text-muted">No media attached for this sermon. You can still read the notes below.</p>
                    @endif
                </div>

                <div class="mt-4">
                    <h4>Notes</h4>
                    <div>{!! nl2br(e($sermon->description)) !!}</div>
                </div>
                
                {{-- Like / Share / Comments toolbar --}}
                @php
                    $userId = auth()->id();
                    $sessionId = session()->getId();
                    $liked = \App\Models\SermonLike::where('sermon_id', $sermon->id)
                        ->when($userId, fn($q) => $q->where('user_id', $userId), fn($q) => $q->where('session_id', $sessionId))
                        ->exists();
                    $likeCount = \App\Models\SermonLike::where('sermon_id', $sermon->id)->count();
                    $pageUrl = url()->current();
                    $shareTitle = urlencode($sermon->title);
                    $shareUrl = urlencode($pageUrl);
                @endphp

                <div class="mt-4 d-flex align-items-center gap-2">
                    <button id="likeBtn" class="btn btn-sm {{ $liked ? 'btn-success' : 'btn-outline-primary' }}"> 
                        <span id="likeText">{{ $liked ? 'Unlike' : 'Like' }}</span>
                        <span id="likeCount" class="ms-2">({{ $likeCount }})</span>
                    </button>

                    {{-- Share buttons --}}
                    <a href="https://twitter.com/intent/tweet?text={{ $shareTitle }}&url={{ $shareUrl }}" target="_blank" class="btn btn-sm btn-outline-info">Share</a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" class="btn btn-sm btn-outline-primary">Facebook</a>
                    <a href="mailto:?subject={{ $shareTitle }}&body=Check%20this%20sermon:%20{{ $shareUrl }}" class="btn btn-sm btn-outline-secondary">Email</a>
                </div>

                {{-- Comments list --}}
                <div class="mt-4">
                    <h4>Comments</h4>

                    @if(session('comment_success'))
                        <div class="alert alert-success">{{ session('comment_success') }}</div>
                    @endif

                    @php $comments = $sermon->comments()->where('approved', true)->latest()->get(); @endphp
                    @if($comments->count())
                        <div class="list-group mb-3">
                            @foreach($comments as $c)
                                <div class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <strong>{{ $c->user?->name ?? $c->name ?? 'Guest' }}</strong>
                                            <div class="small text-muted">{{ optional($c->created_at)->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                    <div class="mt-2">{!! nl2br(e($c->content)) !!}</div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No comments yet — be the first to comment.</p>
                    @endif

                    {{-- Comment form --}}
                    <form action="{{ route('sermons.comments.store', $sermon->id) }}" method="POST">
                        @csrf
                        @guest
                        <div class="mb-2">
                            <input name="name" placeholder="Your name" value="{{ old('name') }}" class="form-control" />
                        </div>
                        <div class="mb-2">
                            <input name="email" placeholder="Your email (optional)" value="{{ old('email') }}" class="form-control" />
                        </div>
                        @endguest
                        <div class="mb-2">
                            <textarea name="content" required class="form-control" rows="4" placeholder="Write your comment...">{{ old('content') }}</textarea>
                        </div>
                        <button class="btn btn-primary btn-sm" type="submit">Post Comment</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 mb-3">
                <h5>More Sermons</h5>
                <ul class="list-unstyled">
                    @foreach(App\Models\Sermon::where('id', '!=', $sermon->id)->latest()->take(6)->get() as $s)
                        <li class="py-2 border-bottom">
                            <a href="{{ route('sermons.show', $s->id) }}">{{ $s->title }}</a>
                            <div class="text-muted small">{{ optional($s->date)->format('M j, Y') }}</div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="card p-3">
                <h5>Actions</h5>
                <p class="small text-muted">Download or share this sermon</p>
                @if($sermon->video_url)
                    <a href="{{ $sermon->video_url }}" class="btn btn-sm btn-primary" target="_blank">Open Media</a>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const v = document.getElementById('sermonVideo');
        const a = document.getElementById('sermonAudio');
        const speed = document.getElementById('speed');
        const speedAudio = document.getElementById('speedAudio');

        if (v && speed) {
            speed.addEventListener('change', function () { v.playbackRate = parseFloat(this.value); });
        }
        if (a && speedAudio) {
            speedAudio.addEventListener('change', function () { a.playbackRate = parseFloat(this.value); });
        }
        // Like button
        const likeBtn = document.getElementById('likeBtn');
        if (likeBtn) {
            likeBtn.addEventListener('click', function () {
                const url = "{{ route('sermons.like.toggle', $sermon->id) }}";
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({})
                }).then(r => r.json()).then(data => {
                    document.getElementById('likeCount').textContent = '('+data.count+')';
                    document.getElementById('likeText').textContent = data.liked ? 'Unlike' : 'Like';
                    likeBtn.classList.toggle('btn-success', data.liked);
                    likeBtn.classList.toggle('btn-outline-primary', !data.liked);
                }).catch(()=> alert('Failed to update like'));
            });
        }
    });
</script>
@endpush

@endsection
