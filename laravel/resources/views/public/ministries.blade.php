@extends('layouts.app')

@section('title', 'Our Ministries')

@section('content')

<!-- Hero Section -->
<section class="hero" style="background-image:url('/images/church-bg.png') ;">
    <div class="container">
        <div class="hero-content">
            <h1 class="display-4 fw-bold mb-3">Our Ministries</h1>
            <p class="lead mb-4">Grow in faith and serve others through our diverse ministry opportunities</p>
            <div class="d-flex flex-wrap gap-5 justify-content-center">
                <a href="{{ url('/about') }}" class="btn btn-primary btn-lg px-4">
                    <i class="fas fa-info-circle me-2"></i> Learn About Us
                </a>
                <a href="{{ url('/donate') }}" class="btn btn-outline-light btn-lg px-4">
                    <i class="fas fa-heart me-2"></i> Support Our Work
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Ministries Section -->
<section class="py-5" id="ministries">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Join a Ministry</h2>
            <p class="text-muted">Discover how you can get involved and make a difference in our church and community</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="ministry-card card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="ministry-icon bg-primary text-white me-3">
                                <i class="fas fa-child"></i>
                            </div>
                            <h3 class="h4 mb-0">Children's Ministry</h3>
                        </div>
                        <p class="card-text mb-4">
                            Our Children's Ministry provides fun, safe, and engaging programs for kids ages 0-12.
                            Through age-appropriate lessons, games, and activities, we help children learn about God's love,
                            develop friendships, and grow in their faith.
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-primary">Ages 0-12</span>
                            <span class="badge bg-success">Nursery Available</span>
                            <span class="badge bg-info">Weekly Programs</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ministry-card card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="ministry-icon bg-success text-white me-3">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <h3 class="h4 mb-0">Youth Group</h3>
                        </div>
                        <p class="card-text mb-4">
                            Our Youth Group offers dynamic programs for middle and high school students.
                            Through Bible studies, outreach activities, and fellowship opportunities,
                            teens can explore their faith, build lasting friendships, and discover their purpose.
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-success">Grades 6-12</span>
                            <span class="badge bg-warning">Weekly Meetings</span>
                            <span class="badge bg-danger">Mission Trips</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ministry-card card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="ministry-icon bg-info text-white me-3">
                                <i class="fas fa-users"></i>
                            </div>
                            <h3 class="h4 mb-0">Adult Fellowship</h3>
                        </div>
                        <p class="card-text mb-4">
                            Our Adult Fellowship groups provide opportunities for spiritual growth through
                            small group Bible studies, prayer meetings, and community service projects.
                            Whether you're new to faith or a lifelong believer, there's a place for you here.
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-info">All Ages</span>
                            <span class="badge bg-secondary">Small Groups</span>
                            <span class="badge bg-primary">Bible Study</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ministry-card card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="ministry-icon bg-danger text-white me-3">
                                <i class="fas fa-hands-helping"></i>
                            </div>
                            <h3 class="h4 mb-0">Missions</h3>
                        </div>
                        <p class="card-text mb-4">
                            Our Missions Ministry focuses on local and global outreach, serving our community
                            and spreading God's love around the world. From feeding the hungry to supporting
                            international mission work, we believe in being the hands and feet of Jesus.
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-danger">Local Outreach</span>
                            <span class="badge bg-success">Global Missions</span>
                            <span class="badge bg-warning">Service Projects</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <div class="bg-gradient-primary text-white p-5 rounded">
                <h3 class="mb-3">Ready to Get Involved?</h3>
                <p class="mb-4">
                    Whether you're looking to serve, grow in your faith, or just connect with others,
                    we have a place for you in our church family. Contact us today to learn more about joining a ministry.
                </p>
                <a href="{{ url('/contact') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-envelope me-2"></i> Contact Us
                </a>
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
                    Have questions about our ministries? We'd love to hear from you!
                </p>

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
            </div>

            <div class="col-lg-6">
                <div class="bg-white bg-opacity-10 p-4 rounded">
                    <h3 class="mb-4">Send us a Message</h3>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="John Smith">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="john@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number (optional)</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="(555) 123-4567">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="4" placeholder="Tell us how you'd like to get involved..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-light w-100">
                            <i class="fas fa-paper-plane me-2"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection