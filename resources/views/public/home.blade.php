@extends('layouts.app')

@section('title', 'Welcome to House of Hope Church')

@section('content')

<!-- Hero Section -->
    <section class="hero" style="background-image:url('/images/church-bg.png');">
        <div class="container">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-3">Welcome to House of Hope Church Leeds</h1>
                <p class="lead mb-4">A place where you can belong, believe, and become all that God created you to be.</p>
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

    <!-- Quick Info Bar -->
    <div class="quick-info py-2">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    <span>123 Faith Street, Hope City, HC 12345</span>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-clock me-2"></i>
                    <span>Saturday Services: 9:00 AM </span>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-phone me-2"></i>
                    <span>(555) 123-4567</span>
                </div>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <section class="py-5 bg-light" id="about">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Our Story & Mission</h2>
                <p class="text-muted">Discover who we are and what we believe</p>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="position-relative">
                        <img src="https://placehold.co/600x400/1e40af/white?text=Our+Church+Building" alt="Church building" class="img-fluid rounded shadow">
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
                        Grace Community Church was founded in 1985 with a simple vision: to be a place where people can experience God's love and grow in their faith journey.
                    </p>
                    <p class="mb-4">
                        Today, we are a diverse community of believers from all walks of life, united by our love for Christ and commitment to serving others.
                    </p>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="fas fa-heart text-danger fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="h6 fw-bold">Love God</h5>
                                    <p class="mb-0">Worship and devotion to our Creator</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="fas fa-users text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="h6 fw-bold">Love People</h5>
                                    <p class="mb-0">Community and fellowship</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="fas fa-star text-warning fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="h6 fw-bold">Make Disciples</h5>
                                    <p class="mb-0">Share the gospel and grow together</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="fas fa-hands-helping text-success fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="h6 fw-bold">Serve Others</h5>
                                    <p class="mb-0">Local and global missions</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-5" id="services">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Worship Services</h2>
                <p class="text-muted">Experience vibrant worship, biblical teaching, and genuine community</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card service-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-sun text-warning fs-2 me-3"></i>
                                <h3 class="h4 mb-0">Sunday Services</h3>
                            </div>
                            <ul class="list-unstyled">
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-clock text-muted me-2"></i>
                                    <span><strong>9:00 AM</strong> - Traditional Worship</span>
                                </li>
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-clock text-muted me-2"></i>
                                    <span><strong>11:00 AM</strong> - Contemporary Worship</span>
                                </li>
                            </ul>
                            <p class="text-muted">
                                Join us for inspiring worship and biblical teaching in a welcoming environment.
                            </p>
                            <div class="d-flex flex-wrap gap-2 mt-3">
                                <span class="badge bg-primary">All Ages Welcome</span>
                                <span class="badge bg-success">Nursery Available</span>
                                <span class="badge bg-info">Live Streaming</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card service-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-moon text-info fs-2 me-3"></i>
                                <h3 class="h4 mb-0">Midweek Services</h3>
                            </div>
                            <ul class="list-unstyled">
                                <li class="d-flex align-items-center mb-2">
                                    <i class="fas fa-clock text-muted me-2"></i>
                                    <span><strong>Wednesday 6:30 PM</strong> - Bible Study & Prayer</span>
                                </li>
                            </ul>
                            <p class="text-muted">
                                Midweek fellowship and spiritual growth through small group discussions and prayer.
                            </p>
                            <div class="d-flex flex-wrap gap-2 mt-3">
                                <span class="badge bg-secondary">Adults</span>
                                <span class="badge bg-success">Youth Group</span>
                                <span class="badge bg-warning">Children's Program</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <div class="bg-primary text-white p-4 rounded">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-play-circle fs-1 me-3"></i>
                        <div>
                            <h4 class="mb-1">Watch Our Latest Sermon</h4>
                            {{-- <p class="mb-0">"Finding Hope in Difficult Times"</p> --}}
                            
                            @forelse($sermons as $sermon)
                                
                                
                                <a href="{{ route('sermons.show', $sermon->id) }}"  aria-label="View sermon {{ $sermon->title }}"><p class = "mb-0">{{ $sermon->title }}</p></a>         
                            @empty
                                <p>No sermons available.</p>
                            @endforelse
                        </div>
                        
                    </div>
                </div>
            </div>
        
            
        </div>
    </section>
    
        
    
     <!-- Ministries Section -->
    <section class="py-5 bg-light" id="ministries">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Our Ministries</h2>
                <p class="text-muted">Grow in faith and serve others through our diverse ministry opportunities</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="text-center">
                        <div class="ministry-icon bg-primary text-white">
                            <i class="fas fa-child"></i>
                        </div>
                        <h4 class="h5">Children's Ministry</h4>
                        <p class="text-muted">Fun, safe, and engaging programs for ages 0-12</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="text-center">
                        <div class="ministry-icon bg-success text-white">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h4 class="h5">Youth Group</h4>
                        <p class="text-muted">Dynamic programs for middle and high school students</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="text-center">
                        <div class="ministry-icon bg-info text-white">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="h5">Adult Fellowship</h4>
                        <p class="text-muted">Small groups and Bible studies for spiritual growth</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="text-center">
                        <div class="ministry-icon bg-danger text-white">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h4 class="h5">Missions</h4>
                        <p class="text-muted">Local and global outreach and service opportunities</p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <div class="bg-gradient-primary text-white p-5 rounded">
                    <h3 class="mb-3">Ready to Get Involved?</h3>
                    <p class="mb-4">
                        Whether you're looking to serve, grow in your faith, or just connect with others, 
                        we have a place for you in our church family.
                    </p>
                    <a href="{{ url('/ministries') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-users me-2"></i> Join a Ministry
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section class="py-5" id="events">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Upcoming Events</h2>
                <p class="text-muted">Join us for special services, community outreach, and fellowship opportunities</p>
            </div>


            

            <div class="row g-4">
                @forelse($events as $event)
                <div class="col-md-4">
                    <div class="card event-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-calendar text-primary me-2"></i>
                                <span class="text-muted small">{{ \Carbon\Carbon::parse($event->event_date)->toFormattedDateString() }}</span>
                            </div>
                            <h4 class="card-title">{{ $event->title }}</h4>
                            <div class="d-flex align-items-center text-muted mb-3">
                                <i class="fas fa-clock me-2"></i>
                                <span>{{ $event->event_time }}</span>
                            </div>
                            <p class="card-text">
                                S{{ Str::limit($event->description, 100) }}
                            </p>
                            <a href="{{ route('events.show', $event->id) }}" class="text-primary fw-medium">
                                Learn More <i class="fas fa-chevron-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                    <p>No Upcomming Event...</p>
                @endforelse
                {{-- <div class="col-md-4">
                    <div class="card event-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-calendar text-primary me-2"></i>
                                <span class="text-muted small">January 15, 2026</span>
                            </div>
                            <h4 class="card-title">Community Dinner</h4>
                            <div class="d-flex align-items-center text-muted mb-3">
                                <i class="fas fa-clock me-2"></i>
                                <span>6:00 PM</span>
                            </div>
                            <p class="card-text">
                                Free meal and fellowship for the entire community
                            </p>
                            <a href="#" class="text-primary fw-medium">
                                Learn More <i class="fas fa-chevron-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card event-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-calendar text-primary me-2"></i>
                                <span class="text-muted small">February 7, 2026</span>
                            </div>
                            <h4 class="card-title">Baptism Sunday</h4>
                            <div class="d-flex align-items-center text-muted mb-3">
                                <i class="fas fa-clock me-2"></i>
                                <span>11:00 AM</span>
                            </div>
                            <p class="card-text">
                                Celebrating new believers stepping into faith
                            </p>
                            <a href="#" class="text-primary fw-medium">
                                Learn More <i class="fas fa-chevron-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
 --}}
            <div class="text-center mt-4">
                <a href="{{ url('/events') }}" class="btn btn-outline-primary">
                    View All Events <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">What People Are Saying</h2>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <blockquote class="fst-italic mb-3">
                            "This church has become my family. The love and support I've received here has transformed my life."
                        </blockquote>
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    S
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-0">Sarah Johnson</h5>
                                <p class="mb-0 text-muted small">Member for 5 years</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <blockquote class="fst-italic mb-3">
                            "I was nervous about visiting, but everyone made me feel so welcome. The message was exactly what I needed to hear."
                        </blockquote>
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    M
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-0">Michael Chen</h5>
                                <p class="mb-0 text-muted small">New Visitor</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <blockquote class="fst-italic mb-3">
                            "Our mission is simple: Love God, Love People, and Make Disciples. We're so glad you're here!"
                        </blockquote>
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    P
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-0">Pastor David Williams</h5>
                                <p class="mb-0 text-muted small">Senior Pastor</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-5 bg-primary text-white" id="contact">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <h2 class="mb-4">Get in Touch</h2>
                    <p class="lead mb-4">
                        We'd love to hear from you! Whether you have questions, want to visit, or are ready to get involved, our team is here to help.
                    </p>
                    
                    <div class="d-flex align-items-start mb-3">
                        <i class="fas fa-map-marker-alt fs-4 me-3 mt-1"></i>
                        <div>
                            <h5 class="h6">Address</h5>
                            <p class="mb-0">123 Faith Street, Hope City, HC 12345</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                        <i class="fas fa-phone fs-4 me-3 mt-1"></i>
                        <div>
                            <h5 class="h6">Phone</h5>
                            <p class="mb-0">(555) 123-4567</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                        <i class="fas fa-envelope fs-4 me-3 mt-1"></i>
                        <div>
                            <h5 class="h6">Email</h5>
                            <p class="mb-0">info@houseofhopeleeds.org</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mb-4">
                        <i class="fas fa-clock fs-4 me-3 mt-1"></i>
                        <div>
                            <h5 class="h6">Office Hours</h5>
                            <p class="mb-0">Monday-Friday: 9am-5pm</p>
                        </div>
                    </div>
                    
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="bg-white bg-opacity-10 p-4 rounded">
                        <h3 class="mb-4">Send us a Message</h3>
                        <a href="{{ url('/contact') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-envelope me-2"></i> Contact Us
                </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    




@endsection
