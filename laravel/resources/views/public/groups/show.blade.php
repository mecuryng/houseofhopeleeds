@extends('layouts.app')

@section('title', $group->name)

@section('content')
    <section class="py-5">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('groups.index') }}">Small Groups</a></li>
                    <li class="breadcrumb-item active">{{ $group->name }}</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-lg-8">
                    <h1 class="mb-3">{{ $group->name }}</h1>
                    
                    @if($group->description)
                    <p class="lead">{{ $group->description }}</p>
                    @endif

                    <div class="row g-3 mb-4">
                        @if($group->location)
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-map-marker-alt text-primary me-2" aria-hidden="true"></i>
                                <span>{{ $group->location }}</span>
                            </div>
                        </div>
                        @endif
                        @if($group->meeting_day)
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-calendar text-primary me-2" aria-hidden="true"></i>
                                <span>{{ $group->meeting_day }}{{ $group->meeting_time ? ' at ' . $group->meeting_time : '' }}</span>
                            </div>
                        </div>
                        @endif
                    </div>

                    @if($group->leader)
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Group Leader</h5>
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle me-3" aria-hidden="true">
                                    {{ $group->leader->initials ?? substr($group->leader->name, 0, 1) }}
                                </div>
                                <span>{{ $group->leader->name }}</span>
                            </div>
                        </div>
                    </div>
                    @endif

                    @auth
                    <div class="mb-4">
                        @if($group->hasMember(auth()->id()))
                        <form method="POST" action="{{ route('groups.leave', $group) }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="fas fa-sign-out-alt me-2" aria-hidden="true"></i> Leave Group
                            </button>
                        </form>
                        @elseif(!$group->is_full && $group->is_open)
                        <form method="POST" action="{{ route('groups.join', $group) }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt me-2" aria-hidden="true"></i> Join Group
                            </button>
                        </form>
                        @elseif($group->is_full)
                        <span class="text-muted">This group is full</span>
                        @else
                        <span class="text-muted">This group is not accepting new members</span>
                        @endif
                    </div>
                    @endauth

                    <h4 class="mb-3">Members ({{ $group->members->count() }})</h4>
                    @if($group->members->count() > 0)
                    <div class="row g-3">
                        @foreach($group->members as $member)
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-2 border rounded">
                                <div class="avatar-circle me-2" style="width:40px;height:40px;font-size:0.9rem;" aria-hidden="true">
                                    {{ $member->initials ?? substr($member->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="fw-medium">{{ $member->name }}</div>
                                    @if($member->pivot->role !== 'member')
                                    <small class="text-muted text-capitalize">{{ $member->pivot->role }}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-muted">No members yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
