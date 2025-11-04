@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-4xl font-bold mb-8 text-center">About House of Hope Leeds</h1>
        
        <div class="prose lg:prose-lg mx-auto">
            <h2>Our Vision</h2>
            <p>At House of Hope Leeds, we envision a community where faith, hope, and love transform lives. Our mission is to spread the message of hope and salvation while serving our community with compassion and dedication.</p>

            <h2>Our Values</h2>
            <ul>
                <li>Faith-centered worship and teaching</li>
                <li>Community service and outreach</li>
                <li>Inclusive and welcoming environment</li>
                <li>Family-oriented ministry</li>
                <li>Spiritual growth and discipleship</li>
            </ul>

            <h2>Service Times</h2>
            <p>Join us for worship and fellowship:</p>
            <ul>
                <li>Sunday Service: 10:00 AM</li>
                <li>Wednesday Bible Study: 7:00 PM</li>
                <li>Youth Ministry: Fridays at 6:30 PM</li>
            </ul>

            <h2>Location</h2>
            <p>We are conveniently located in Leeds city centre. Our address is:</p>
            <p>123 Hope Street<br>
            Leeds, LS1 1AB<br>
            United Kingdom</p>

            <h2>Get Involved</h2>
            <p>There are many ways to get involved in our church community:</p>
            <ul>
                <li>Join our worship team</li>
                <li>Volunteer in community outreach programs</li>
                <li>Participate in Bible study groups</li>
                <li>Support our mission work</li>
            </ul>
        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('events.index') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors mr-4">
                Upcoming Events
            </a>
            <a href="{{ route('sermons.index') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                Watch Sermons
            </a>
        </div>
    </div>
</div>
@endsection