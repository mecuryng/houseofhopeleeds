<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Church Website') }} - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f9fafb; color: #111827; }
        nav { background-color: #1e293b; }
        nav a { color: white; margin-right: 15px; text-decoration: none; }
        footer { background: #1e293b; color: #f8fafc; text-align: center; padding: 20px; margin-top: 40px; }
        .hero { background: url('/images/church-bg.jpg') center/cover no-repeat; color: white; text-align: center; padding: 100px 20px; }
    </style>
</head>
<body>

    {{-- Header Navigation --}}
    <nav class="p-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h3 class="text-white">Church Website</h3>
            <div>
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ url('/about') }}">About</a>
                <a href="{{ url('/events') }}">Events</a>
                <a href="{{ url('/sermons') }}">Sermons</a>
                <a href="{{ url('/donate') }}">Give</a>
            </div>
        </div>
    </nav>

    {{-- Main Page Content --}}
    <main class="container my-5">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer>
        <p>&copy; {{ date('Y') }} {{ config('app.name', 'Church Website') }}. All rights reserved.</p>
        <p>Follow us on 
            <a href="#" style="color:#facc15;">Facebook</a> | 
            <a href="#" style="color:#facc15;">YouTube</a>
        </p>
    </footer>

</body>
</html>
