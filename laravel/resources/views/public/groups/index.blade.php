@extends('layouts.app')

@section('title', 'Small Groups')

@section('content')
    <section class="hero position-relative" style="background-image:url('/images/church-bg.png');">
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100" style="background:rgba(0,0,0,0.5);pointer-events:none;z-index:1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-3">Small Groups</h1>
                <p class="lead mb-4">Connect, grow, and build lasting relationships</p>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-6">
                    <p class="text-muted">Find a group that fits your schedule and interests</p>
                </div>
            </div>

            @if($groups->count() > 0)
            <div class="row g-4">
                @foreach($groups as $group)
                <article class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title h5">
                                <a href="{{ route('groups.show', $group) }}" class="text-decoration-none">
                                    {{ $group->name }}
                                </a>
                            </h3>
                            @if($group->description)
                            <p class="card-text">{{ Str::limit($group->description, 120) }}</p>
                            @endif
                            <div class="mt-3">
                                @if($group->meeting_day)
                                <span class="badge bg-light text-dark me-1">
                                    <i class="fas fa-calendar me-1" aria-hidden="true"></i>{{ $group->meeting_day }}
                                </span>
                                @endif
                                @if($group->meeting_time)
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-clock me-1" aria-hidden="true"></i>{{ $group->meeting_time }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="fas fa-users me-1" aria-hidden="true"></i>
                                    {{ $group->members_count }}/{{ $group->max_members }} members
                                </small>
                                <a href="{{ route('groups.show', $group) }}" class="btn btn-outline-primary btn-sm">View</a>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <nav class="mt-5" aria-label="Groups pagination">
                {{ $groups->links('pagination::bootstrap-5') }}
            </nav>
            @else
            <div class="text-center py-5">
                <i class="fas fa-users text-muted mb-3" style="font-size: 3rem;" aria-hidden="true"></i>
                <p class="lead">No small groups available yet.</p>
            </div>
            @endif
        </div>
    </section>
@endsection
