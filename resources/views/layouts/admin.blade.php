<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Church Admin Dashboard</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8fafc;
            margin: 0;
        }
        .sidebar {
            width: 220px;
            background: #1e293b;
            color: white;
            position: fixed;
            top: 0;
            bottom: 0;
            padding-top: 20px;
        }
        .sidebar a {
            color: #cbd5e1;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #334155;
            color: #fff;
        }
        .main {
            margin-left: 220px;
            padding: 20px;
        }
        .logout {
            position: absolute;
            bottom: 20px;
            left: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3 style="text-align:center;">⛪ Admin Panel</h3>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.members.index') }}">Members</a>
        <a href="{{ route('admin.events.index') }}">Events</a>
        <a href="{{ route('admin.sermons.index') }}">Sermons</a>
        <a href="#">Donations</a>
        <a href="#" class="logout"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
    </div>

    <div class="main">
        @yield('content')
    </div>
</body>
</html>
