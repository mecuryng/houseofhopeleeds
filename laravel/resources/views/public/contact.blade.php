@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')

<!-- Hero Section -->
<section class="hero" style="background-image:url('/images/church-bg.png');">
    <div class="container">
        <div class="hero-content">
            <h1 class="display-4 fw-bold mb-3">Contact Us</h1>
            <p class="lead mb-4">We'd love to hear from you! Get in touch with our team.</p>
            <div class="d-flex flex-wrap gap-3">
                <a href="#contact-form" class="btn btn-primary btn-lg px-4">
                    <i class="fas fa-envelope me-2"></i> Send a Message
                </a>
                <a href="#contact-info" class="btn btn-outline-light btn-lg px-4">
                    <i class="fas fa-map-marker-alt me-2"></i> Find Us
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Quick Info Bar -->
<div class="quick-info py-2">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3">
                <i class="fas fa-map-marker-alt me-2"></i>
                <span>Swarcliffe Community Centre, 65 Stanks Gardens, Leeds LS14 5LS</span>
            </div>
            <div class="col-md-3">
                <i class="fas fa-clock me-2"></i>
                <span>Saturday Services: 9:00 AM</span>
            </div>
            <div class="col-md-3">
                <i class="fas fa-phone me-2"></i>
                <span>+447359459090</span>
            </div>
            <div class="col-md-3">
                <i class="fas fa-envelope me-2"></i>
                <span>info@houseofhopeleeds.org</span>
            </div>
        </div>
    </div>
</div>

<!-- Contact Section -->
<section class="py-5 bg-light" id="contact">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6" id="contact-info">
                <h2 class="mb-4">Get in Touch</h2>
                <p class="lead mb-4">
                    Whether you have questions, want to visit, or are ready to get involved, our team is here to help.
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

            <div class="col-lg-6" id="contact-form">
                <div class="bg-white p-4 rounded shadow">
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
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="How can we help?">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Your message here..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-paper-plane me-2"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection