@extends('layouts.app')

@section('title', 'Member Directory')

@section('content')
    <section class="hero position-relative" style="background-image:url('/images/church-bg.png');">
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100" style="background:rgba(0,0,0,0.5);pointer-events:none;z-index:1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-3">Member Directory</h1>
                <p class="lead mb-4">Connect with our church family</p>
            </div>
        </div>
    </section>

    <section class="py-5" aria-labelledby="directory-heading">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 id="directory-heading" class="section-title mb-0">Church Members</h2>
                <span class="badge bg-primary">{{ $members->total() }} members</span>
            </div>

            <div class="alert alert-info" role="alert">
                <i class="fas fa-info-circle me-2" aria-hidden="true"></i>
                Only members who have opted to be visible in the directory are shown here.
                <a href="{{ route('profile') }}" class="alert-link">Update your privacy settings</a> in your profile.
            </div>

            @if($members->count() > 0)
            <div class="row g-4">
                @foreach($members as $member)
                <article class="col-md-6 col-lg-4">
                    <div class="card staff-card h-100">
                        <div class="card-body text-center">
                            <div class="avatar-circle mx-auto mb-3" aria-hidden="true">
                                {{ $member->initials() }}
                            </div>
                            <h3 class="h5 mb-1">{{ $member->name }}</h3>
                            <span class="badge bg-success">Member</span>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <nav class="mt-5" aria-label="Member directory pagination">
                {{ $members->links('pagination::bootstrap-5') }}
            </nav>
            @else
            <div class="text-center py-5" role="status">
                <i class="fas fa-users text-muted mb-3" style="font-size: 3rem;" aria-hidden="true"></i>
                <p class="lead">No members have opted to be visible in the directory yet.</p>
            </div>
            @endif
        </div>
    </section>
@endsection
