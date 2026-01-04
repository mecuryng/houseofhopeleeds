<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Church Admin Dashboard')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/church.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <style>
        .admin-sidebar {
            width: 280px;
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            color: white;
            position: fixed;
            top: 0;
            bottom: 0;
            padding: 1.5rem 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        .admin-sidebar .sidebar-header {
            padding: 0 1.5rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 1rem;
            text-align: center;
        }
        .admin-sidebar .sidebar-header .logo {
            width: 60px;
            height: 60px;
            margin-bottom: 0.5rem;
        }
        .admin-sidebar .sidebar-header h3 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
        }
        .admin-sidebar a {
            color: #cbd5e1;
            display: block;
            padding: 0.75rem 1.5rem;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        .admin-sidebar a:hover {
            background: rgba(59, 130, 246, 0.1);
            color: #fff;
            border-left-color: #3b82f6;
            padding-left: 2rem;
        }
        .admin-main {
            margin-left: 280px;
            padding: 2rem;
            background: #f8fafc;
            min-height: 100vh;
        }
        .admin-header {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }
        .admin-header h1 {
            margin: 0;
            color: #1e293b;
            font-weight: 700;
        }
        .admin-table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .admin-table th {
            background: #f8fafc;
            color: #374151;
            font-weight: 600;
            padding: 1rem;
            border-bottom: 2px solid #e5e7eb;
        }
        .admin-table td {
            padding: 1rem;
            border-bottom: 1px solid #f3f4f6;
        }
        .admin-table tr:hover {
            background: #f9fafb;
        }
        .admin-btn-primary {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s ease;
        }
        .admin-btn-primary:hover {
            background: #2563eb;
            color: white;
        }
        .admin-btn-danger {
            background: #ef4444;
            color: white;
            border: none;
            padding: 0.25rem 0.75rem;
            border-radius: 4px;
            font-size: 0.875rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .admin-btn-danger:hover {
            background: #dc2626;
        }
        .admin-alert {
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
        }
        .admin-alert-success {
            background: #dcfce7;
            border: 1px solid #bbf7d0;
            color: #166534;
        }
        .logout-btn {
            position: absolute;
            bottom: 1.5rem;
            left: 1.5rem;
            right: 1.5rem;
        }
        @media (max-width: 768px) {
            .admin-sidebar {
                width: 100%;
                position: relative;
            }
            .admin-main {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="admin-sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('Logo.png') }}" alt="House of Hope" class="logo">
            <h3>Admin Panel</h3>
        </div>
        <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
        <a href="{{ route('admin.users.index') }}">👤 Users</a>
        <a href="{{ route('admin.members.index') }}">👥 Members</a>
        <a href="{{ route('admin.events.index') }}">📅 Events</a>
        <a href="{{ route('admin.sermons.index') }}">📖 Sermons</a>
        <a href="{{ route('admin.sermon-comments.index') }}">💬 Sermon Comments</a>
        <a href="{{ route('admin.rsvps.index') }}">✅ RSVPs</a>
        <a href="{{ route('admin.prayer-requests.index') }}">🙏 Prayer Requests</a>
        <a href="#">💰 Donations</a>

        <div class="logout-btn">
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                🚪 Logout
            </a>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
    </div>

    <div class="admin-main">
        @yield('content')
    </div>
</body>
</html>
