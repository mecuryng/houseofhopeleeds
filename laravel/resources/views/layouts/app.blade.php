<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'House of Hope') }} - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- <style>
        body { background-color: #f9fafb; color: #111827; }
        nav { background-color: #1e293b; }
        nav a { color: white; margin-right: 15px; text-decoration: none; }
        footer { background: #1e293b; color: #f8fafc; text-align: center; padding: 20px; margin-top: 40px; }
        .hero { background: url('/images/church-bg.jpg') center/cover no-repeat; color: white; text-align: center; padding: 100px 20px; }
        /* Clickable card hover effect */
        .clickable-card {
            transition: box-shadow .18s ease, transform .18s ease;
        }
        .clickable-card:hover {
            box-shadow: 0 10px 20px rgba(2,6,23,0.08);
            transform: translateY(-4px);
            text-decoration: none;
        }
    </style> --}}
    @vite(['resources/css/app.css', 'resources/css/church.css'])
</head>
<body>

    @include('partials.nav')

    {{-- Main Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @vite([ 'resources/js/app.js', 'resources/js/church.js'])
    @stack('scripts')
</body>
</html>
