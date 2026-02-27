@extends('layouts.app')

@section('title', 'Welcome to House of Hope Church')

@section('content')

    <section class="hero position-relative" style="background-image:url('/images/church-bg.png');" aria-labelledby="hero-heading">
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100" style="background:rgba(0,0,0,0.5);pointer-events:none;z-index:1;"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="hero-content">
                <h1 id="hero-heading" class="display-4 fw-bold mb-3">Welcome to House of Hope Church Leeds</h1>
                <p class="lead mb-4">A place to belong, grow, and shine.</p>
                <div class="d-flex flex-wrap gap-3 gap-md-5 justify-content-center">
                    <a href="{{ url('/donate') }}" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-calendar me-2" aria-hidden="true"></i> Support Our Work
                    </a>
                    <a href="{{ url('/about') }}" class="btn btn-outline-light btn-lg px-4">
                        <i class="fas fa-info-circle me-2" aria-hidden="true"></i> Learn More
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="quick-info py-3 py-md-2" role="complementary" aria-label="Church contact information">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-2 mb-md-0">
                    <i class="fas fa-map-marker-alt me-2" aria-hidden="true"></i>
                    <address class="d-inline" style="font-style: normal;">Swarcliffe Community Centre, 65 Stanks Gardens, Leeds LS14 5LS</address>
                </div>
                <div class="col-md-4 mb-2 mb-md-0">
                    <i class="fas fa-clock me-2" aria-hidden="true"></i>
                    <span>Saturday Services: <time>7:45 AM</time></span>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-phone me-2" aria-hidden="true"></i>
                    <a href="tel:+447359459090" class="text-white text-decoration-none">+447359459090</a>
                </div>
            </div>
        </div>
    </div>

    <section class="py-5 bg-light" id="about" aria-labelledby="about-heading">
        <div class="container">
            <div class="text-center mb-5">
                <h2 id="about-heading" class="section-title">Our Story & Mission</h2>
                <p class="text-muted">Discover who we are and what we believe</p>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="position-relative">
                        <div class="position-relative">
                            <img src="https://placehold.co/600x400/1e40af/white?text=Our+Church+Building" alt="House of Hope Church building exterior" class="img-fluid rounded shadow" width="600" height="400" loading="lazy">
                            <div class="position-absolute top-0 start-0 w-100 h-100" style="background:rgba(0,0,0,0.4);border-radius:inherit;"></div>
                        </div>
                        <div class="position-absolute bottom-0 end-0 bg-white p-3 rounded shadow" style="width: 200px;">
                            <blockquote class="fst-italic text-dark mb-2">
                                "For I know the plans I have for you, declares the Lord, plans for welfare and not for evil, to give you a future and a hope."
                            </blockquote>
                            <cite class="text-primary fw-bold">Jeremiah 29:11</cite>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h3 class="h2 mb-4">Who We Are</h3>
                    <p class="lead mb-4">
                        House of Hope is a place to belong, grow, and shine. Since 2024, we have been teaching the Bible down to the cross-root level, meeting in homes and small groups, and helping people understand and live God's Word. We are committed to evangelism, sharing hope with our communities, and embracing the prophetic ministry, listening for God's guidance to encourage and strengthen those around us.
                    </p>
                    <p class="mb-4">
                        Our vision is to be a welcoming light, pointing to Christ, and carrying hope into homes, neighbourhoods, and future generations.
                    </p>

                    <ul class="row g-3 list-unstyled" aria-label="Our core values">
                        <li class="col-md-6">
                            <div class="d-flex">
                                <div class="me-3" aria-hidden="true">
                                    <i class="fas fa-heart text-danger fs-4"></i>
                                </div>
                                <div>
                                    <strong>Love God</strong>
                                    <p class="mb-0 text-muted">Worship and devotion to our Creator</p>
                                </div>
                            </div>
                        </li>
                        <li class="col-md-6">
                            <div class="d-flex">
                                <div class="me-3" aria-hidden="true">
                                    <i class="fas fa-users text-primary fs-4"></i>
                                </div>
                                <div>
                                    <strong>Love People</strong>
                                    <p class="mb-0 text-muted">Community and fellowship</p>
                                </div>
                            </div>
                        </li>
                        <li class="col-md-6">
                            <div class="d-flex">
                                <div class="me-3" aria-hidden="true">
                                    <i class="fas fa-star text-warning fs-4"></i>
                                </div>
                                <div>
                                    <strong>Make Disciples</strong>
                                    <p class="mb-0 text-muted">Share the gospel and grow together</p>
                                </div>
                            </div>
                        </li>
                        <li class="col-md-6">
                            <div class="d-flex">
                                <div class="me-3" aria-hidden="true">
                                    <i class="fas fa-hands-helping text-success fs-4"></i>
                                </div>
                                <div>
                                    <strong>Serve Others</strong>
                                    <p class="mb-0 text-muted">Local and global missions</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" id="services" aria-labelledby="services-heading">
        <div class="container">
            <div class="text-center mb-5">
                <h2 id="services-heading" class="section-title">Worship Services</h2>
                <p class="text-muted">Experience vibrant worship, biblical teaching, and genuine community</p>
            </div>

            <div class="row g-4">
                <article class="col-md-6">
                    <div class="card service-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-sun text-warning fs-2 me-3" aria-hidden="true"></i>
                                <h3 class="h4 mb-0">Saturday Services</h3>
                            </div>
                            <ul class="list-unstyled">
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-clock text-muted me-2" aria-hidden="true"></i>
                                    <span><time><strong>7:45AM</strong></time> - Traditional Worship</span>
                                </li>
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-clock text-muted me-2" aria-hidden="true"></i>
                                    <span><strong>AM</strong> - Contemporary Worship</span>
                                </li>
                            </ul>
                            <p class="text-muted">
                                Join us for inspiring worship and biblical teaching in a welcoming environment.
                            </p>
                            <div class="d-flex flex-wrap gap-2 mt-3" aria-label="Service features">
                                <span class="badge bg-primary">All Ages Welcome</span>
                                <span class="badge bg-success">Nursery Available</span>
                                <span class="badge bg-info">Live Streaming</span>
                            </div>
                        </div>
                    </div>
                </article>
                <article class="col-md-6">
                    <div class="card service-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-moon text-info fs-2 me-3" aria-hidden="true"></i>
                                <h3 class="h4 mb-0">Midweek Services</h3>
                            </div>
                            <ul class="list-unstyled">
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-clock text-muted me-2" aria-hidden="true"></i>
                                    <span><time><strong>Thursdays and Fridays 7:30 PM</strong></time> - Online Bible Study & Prayer</span>
                                </li>
                            </ul>
                            <p class="text-muted">
                                Midweek fellowship and spiritual growth through small group discussions and prayer.
                            </p>
                            <div class="d-flex flex-wrap gap-2 mt-3" aria-label="Service features">
                                <span class="badge bg-secondary">Adults</span>
                                <span class="badge bg-success">Youth Group</span>
                                <span class="badge bg-warning text-dark">Children's Program</span>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            <div class="text-center mt-5">
                <div class="bg-primary text-white p-4 rounded">
                    <div class="d-flex align-items-center justify-content-center flex-wrap gap-3">
                        <i class="fas fa-play-circle fs-1" aria-hidden="true"></i>
                        <div>
                            <h4 class="mb-1">Watch Our Latest Sermon</h4>
                            @forelse($sermons as $sermon)
                                <a href="{{ route('sermons.show', $sermon->id) }}" aria-label="View sermon: {{ $sermon->title }}" class="text-white text-decoration-none">
                                    <p class="mb-0">{{ $sermon->title }}</p>
                                </a>         
                            @empty
                                <p class="mb-0">No sermons available.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light" id="ministries" aria-labelledby="ministries-heading">
        <div class="container">
            <div class="text-center mb-5">
                <h2 id="ministries-heading" class="section-title">Our Ministries</h2>
                <p class="text-muted">Grow in faith and serve others through our diverse ministry opportunities</p>
            </div>

            <div class="row g-4">
                <article class="col-md-6 col-lg-3">
                    <div class="text-center">
                        <div class="ministry-icon bg-primary text-white" aria-hidden="true">
                            <i class="fas fa-child"></i>
                        </div>
                        <h3 class="h5">Children's Ministry</h3>
                        <p class="text-muted">Fun, safe, and engaging programs for ages 0-12</p>
                    </div>
                </article>
                <article class="col-md-6 col-lg-3">
                    <div class="text-center">
                        <div class="ministry-icon bg-success text-white" aria-hidden="true">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h3 class="h5">Youth Group</h3>
                        <p class="text-muted">Dynamic programs for middle and high school students</p>
                    </div>
                </article>
                <article class="col-md-6 col-lg-3">
                    <div class="text-center">
                        <div class="ministry-icon bg-info text-white" aria-hidden="true">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="h5">Adult Fellowship</h3>
                        <p class="text-muted">Small groups and Bible studies for spiritual growth</p>
                    </div>
                </article>
                <article class="col-md-6 col-lg-3">
                    <div class="text-center">
                        <div class="ministry-icon bg-danger text-white" aria-hidden="true">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h3 class="h5">Missions</h3>
                        <p class="text-muted">Local and global outreach and service opportunities</p>
                    </div>
                </article>
            </div>

            <div class="text-center mt-5">
                <div class="bg-gradient-primary text-white p-5 rounded">
                    <h3 class="mb-3">Ready to Get Involved?</h3>
                    <p class="mb-4">
                        Whether you're looking to serve, grow in your faith, or just connect with others, 
                        we have a place for you in our church family.
                    </p>
                    <a href="{{ url('/ministries') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-users me-2" aria-hidden="true"></i> Join a Ministry
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" id="events" aria-labelledby="events-heading">
        <div class="container">
            <div class="text-center mb-5">
                <h2 id="events-heading" class="section-title">Upcoming Events</h2>
                <p class="text-muted">Join us for special services, community outreach, and fellowship opportunities</p>
            </div>

            <div class="row g-4">
                @forelse($events as $event)
                <article class="col-md-4">
                    <div class="card event-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-calendar text-primary me-2" aria-hidden="true"></i>
                                <time class="text-muted small" datetime="{{ $event->date->format('Y-m-d') }}">
                                    {{ $event->date->toFormattedDateString() }}
                                </time>
                            </div>
                            <h3 class="card-title h5">
                                <a href="{{ route('events.show', $event->id) }}" class="text-decoration-none stretched-link">
                                    {{ $event->title }}
                                </a>
                            </h3>
                            @if($event->event_time ?? $event->time ?? null)
                            <div class="d-flex align-items-center text-muted mb-3">
                                <i class="fas fa-clock me-2" aria-hidden="true"></i>
                                <span>{{ $event->event_time ?? $event->time }}</span>
                            </div>
                            @endif
                            <p class="card-text">
                                {{ Str::limit($event->description, 100) }}
                            </p>
                            <span class="text-primary fw-medium">
                                Learn More <i class="fas fa-chevron-right ms-1" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </article>
                @empty
                <div class="col-12 text-center" role="status">
                    <p class="text-muted">No upcoming events at the moment.</p>
                </div>
                @endforelse
            </div>

            <div class="text-center mt-4">
                <a href="{{ url('/events') }}" class="btn btn-outline-primary">
                    View All Events <i class="fas fa-arrow-right ms-2" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light" aria-labelledby="testimonials-heading">
        <div class="container">
            <div class="text-center mb-5">
                <h2 id="testimonials-heading" class="section-title">What People Are Saying</h2>
            </div>

            <div class="row g-4">
                <article class="col-md-4">
                    <div class="testimonial-card h-100">
                        <div class="mb-3" aria-label="5 out of 5 stars">
                            <i class="fas fa-star text-warning" aria-hidden="true"></i>
                            <i class="fas fa-star text-warning" aria-hidden="true"></i>
                            <i class="fas fa-star text-warning" aria-hidden="true"></i>
                            <i class="fas fa-star text-warning" aria-hidden="true"></i>
                            <i class="fas fa-star text-warning" aria-hidden="true"></i>
                        </div>
                        <blockquote class="fst-italic mb-3">
                            "This church has become my family. The love and support I've received here has transformed my life."
                        </blockquote>
                        <div class="d-flex align-items-center">
                            <div class="me-3" aria-hidden="true">
                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">S</div>
                            </div>
                            <div>
                                <strong>Sarah Johnson</strong>
                                <p class="mb-0 text-muted small">Member for 5 years</p>
                            </div>
                        </div>
                    </div>
                </article>
                <article class="col-md-4">
                    <div class="testimonial-card h-100">
                        <div class="mb-3" aria-label="5 out of 5 stars">
                            <i class="fas fa-star text-warning" aria-hidden="true"></i>
                            <i class="fas fa-star text-warning" aria-hidden="true"></i>
                            <i class="fas fa-star text-warning" aria-hidden="true"></i>
                            <i class="fas fa-star text-warning" aria-hidden="true"></i>
                            <i class="fas fa-star text-warning" aria-hidden="true"></i>
                        </div>
                        <blockquote class="fst-italic mb-3">
                            "I was nervous about visiting, but everyone made me feel so welcome. The message was exactly what I needed to hear."
                        </blockquote>
                        <div class="d-flex align-items-center">
                            <div class="me-3" aria-hidden="true">
                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">M</div>
                            </div>
                            <div>
                                <strong>Michael Chen</strong>
                                <p class="mb-0 text-muted small">New Visitor</p>
                            </div>
                        </div>
                    </div>
                </article>
                <article class="col-md-4">
                    <div class="testimonial-card h-100">
                        <div class="mb-3" aria-label="5 out of 5 stars">
                            <i class="fas fa-star text-warning" aria-hidden="true"></i>
                            <i class="fas fa-star text-warning" aria-hidden="true"></i>
                            <i class="fas fa-star text-warning" aria-hidden="true"></i>
                            <i class="fas fa-star text-warning" aria-hidden="true"></i>
                            <i class="fas fa-star text-warning" aria-hidden="true"></i>
                        </div>
                        <blockquote class="fst-italic mb-3">
                            "Our mission is simple: Love God, Love People, and Make Disciples. We're so glad you're here!"
                        </blockquote>
                        <div class="d-flex align-items-center">
                            <div class="me-3" aria-hidden="true">
                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">P</div>
                            </div>
                            <div>
                                <strong>Pastor David Williams</strong>
                                <p class="mb-0 text-muted small">Senior Pastor</p>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="py-5 bg-primary text-white" id="contact" aria-labelledby="contact-heading">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <h2 id="contact-heading" class="mb-4">Get in Touch</h2>
                    <p class="lead mb-4">
                        We'd love to hear from you! Whether you have questions, want to visit, or are ready to get involved, our team is here to help.
                    </p>
                    
                    <address class="mb-0">
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-map-marker-alt fs-4 me-3 mt-1" aria-hidden="true"></i>
                            <div>
                                <strong class="d-block">Address</strong>
                                Swarcliffe Community Centre<br>65 Stanks Gardens, Leeds LS14 5LS
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-phone fs-4 me-3 mt-1" aria-hidden="true"></i>
                            <div>
                                <strong class="d-block">Phone</strong>
                                <a href="tel:+447359459090" class="text-white text-decoration-none">+447359459090</a>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-envelope fs-4 me-3 mt-1" aria-hidden="true"></i>
                            <div>
                                <strong class="d-block">Email</strong>
                                <a href="mailto:info@houseofhopeleeds.org" class="text-white text-decoration-none">info@houseofhopeleeds.org</a>
                            </div>
                        </div>
                    </address>
                    
                    <div class="social-icons mt-4" aria-label="Social media links">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fab fa-youtube" aria-hidden="true"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="bg-white bg-opacity-10 p-4 rounded">
                        <h3 class="mb-4">Send us a Message</h3>
                        <a href="{{ url('/contact') }}" class="btn btn-light btn-lg">
                            <i class="fas fa-envelope me-2" aria-hidden="true"></i> Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
